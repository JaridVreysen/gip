import RPi.GPIO as GPIO
import time
import tkinter as tk
import os
import random

# =====================
# GPIO
# =====================
BUTTON_PIN = 17
HIGHSCORE_FILE = "highscores.txt"
MAX_HIGHSCORES = 200  # cap to prevent unbounded growth

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(BUTTON_PIN, GPIO.IN, pull_up_down=GPIO.PUD_UP)
time.sleep(0.5)

# =====================
# MOEILIJKHEID
# =====================
DIFFICULTIES = {
    "EASY":   {"target": 10.0, "glitch_interval": 400},
    "NORMAL": {"target": 10.0, "glitch_interval": 150},
    "HARD":   {"target": None, "glitch_interval": 80},  # None = willekeurig 8–12s
}
current_difficulty = "NORMAL"
current_target = 10.0  # wordt ingesteld bij start van een ronde

# =====================
# GAME STATE
# =====================
running = False
waiting_for_result = False
waiting_for_scoreboard = False
start_time = 0
highscores = []
button_pressed_time = None
LONG_PRESS_TIME = 3.0
SHORT_PRESS_MAX = 1.0  # named constant for clarity

player_name = ""
ready_to_play = False
showing_scores = False
entering_name = True

keyboard_buttons = []

# =====================
# GLITCH
# =====================
glitch_texts = [
    "SYNC LOST", "TIME ERROR", "SIGNAL NOISE", "???",
    "DESYNC", "FRAME DROP", "▒▒▒▒▒▒", "010101"
]
colors = ["red", "green", "cyan", "magenta", "yellow", "white"]

# =====================
# DIEREN
# =====================
def get_title(delta):
    d = abs(delta)
    if d <= 0.10:
        return "VALK", "white"
    elif d <= 0.25:
        return "PANTER", "magenta"
    elif d <= 0.50:
        return "WOLF", "cyan"
    elif d <= 1.00:
        return "ZWIJN", "yellow"
    else:
        return "SCHILDPAD", "green"

# =====================
# HIGHSCORES
# =====================
def load_highscores():
    global highscores
    highscores = []
    if os.path.exists(HIGHSCORE_FILE):
        try:
            with open(HIGHSCORE_FILE) as f:
                for line in f:
                    parts = line.strip().split(";")
                    if len(parts) == 3:
                        name, delta, diff = parts
                        try:
                            highscores.append((name, float(delta), diff))
                        except ValueError:
                            pass
                    elif len(parts) == 2:
                        name, delta = parts
                        try:
                            highscores.append((name, float(delta), "NORMAL"))
                        except ValueError:
                            pass
        except OSError:
            highscores = []

def save_highscores():
    # Trim to cap before saving
    global highscores
    if len(highscores) > MAX_HIGHSCORES:
        # Keep the best (by abs delta) across all entries
        highscores = sorted(highscores, key=lambda x: abs(x[1]))[:MAX_HIGHSCORES]
    try:
        with open(HIGHSCORE_FILE, "w") as f:
            for n, d, diff in highscores:
                f.write(f"{n};{d:.4f};{diff}\n")
    except OSError as e:
        print(f"[WARN] Could not save highscores: {e}")

# =====================
# TKINTER
# =====================
root = tk.Tk()
root.configure(bg="black")
root.attributes("-fullscreen", True)

# Clean up GPIO if the window is closed by any means
def on_closing():
    GPIO.cleanup()
    root.destroy()

root.protocol("WM_DELETE_WINDOW", on_closing)

# =====================
# LABELS
# =====================
label = tk.Label(root, font=("Courier", 28), fg="white", bg="black", justify="center")
label.place(relx=0.5, rely=0.5, anchor="center")

result_label = tk.Label(root, font=("Courier", 16), fg="green", bg="black")
result_label.place(relx=0.5, rely=0.62, anchor="center")

instruction_label = tk.Label(root, font=("Courier", 20), fg="white", bg="black", justify="center")
instruction_label.place(relx=0.5, rely=0.02, anchor="n")

highscore_label = tk.Label(root, font=("Courier", 13), fg="cyan", bg="black", justify="center")
highscore_label.place(relx=0.5, rely=0.12, anchor="n")

name_label = tk.Label(root, font=("Courier", 20), fg="yellow", bg="black")
name_label.place(relx=0.5, rely=0.36, anchor="center")

# Label om de doeltijd te tonen bij HARD (bovenaan, klein)
target_label = tk.Label(root, font=("Courier", 14), fg="#ff4444", bg="black")
target_label.place(relx=0.5, rely=0.92, anchor="center")

# =====================
# HULP
# =====================
def clear_text():
    label.config(text="")
    result_label.config(text="")
    instruction_label.config(text="")
    highscore_label.config(text="")
    name_label.config(text="")
    target_label.config(text="")

def clear_keyboard():
    for b in keyboard_buttons:
        b.destroy()
    keyboard_buttons.clear()

replay_buttons = []
difficulty_buttons = []

def clear_replay_buttons():
    for b in replay_buttons:
        b.destroy()
    replay_buttons.clear()

def clear_difficulty_buttons():
    for b in difficulty_buttons:
        b.destroy()
    difficulty_buttons.clear()

# =====================
# STARTSCHERM
# =====================
def show_start_screen():
    global player_name, entering_name, ready_to_play, showing_scores
    global waiting_for_result, waiting_for_scoreboard, running
    player_name = ""
    entering_name = True
    ready_to_play = False
    showing_scores = False
    waiting_for_result = False
    waiting_for_scoreboard = False
    running = False
    # Clean up any leftover widgets
    clear_keyboard()
    clear_replay_buttons()
    clear_difficulty_buttons()
    clear_text()
    label.config(text="GLITCH // TIMING", fg="cyan")
    instruction_label.config(
        text="Druk zo dicht mogelijk bij 10s\nEr is GEEN zichtbare timer!",
        fg="yellow"
    )
    name_label.config(text="Druk op de knop om verder te gaan", fg="white")

def show_keyboard_screen():
    clear_text()
    clear_keyboard()  # clear any stale keyboard widgets before drawing new ones
    instruction_label.config(text="VUL JE NAAM IN", fg="white")
    show_keyboard()

# =====================
# MOEILIJKHEIDSSCHERM
# =====================
def show_difficulty_screen():
    clear_text()
    clear_keyboard()
    clear_difficulty_buttons()  # prevent duplicate buttons if called more than once

    instruction_label.config(text="KIES JE MOEILIJKHEID", fg="white")

    styles = {
        "EASY":   ("#004400", "lime",   "Rustige afleiding\nDoeltijd: 10s"),
        "NORMAL": ("#444400", "yellow", "Normale afleiding\nDoeltijd: 10s"),
        "HARD":   ("#440000", "red",    "Maximale afleiding\nWillekeurige doeltijd (8-12s)"),
    }

    positions = [0.2, 0.5, 0.8]
    for (diff, pos) in zip(DIFFICULTIES.keys(), positions):
        bg, fg, desc = styles[diff]
        frame_label = tk.Label(
            root,
            text=desc,
            font=("Courier", 10),
            fg=fg,
            bg="black",
            justify="center"
        )
        frame_label.place(relx=pos, rely=0.72, anchor="center")
        difficulty_buttons.append(frame_label)

        b = tk.Button(
            root,
            text=diff,
            font=("Courier", 14, "bold"),
            width=8, height=2,
            bg=bg, fg=fg,
            activebackground=bg,
            bd=0,
            command=lambda d=diff: on_difficulty_chosen(d)
        )
        b.place(relx=pos, rely=0.55, anchor="center")
        difficulty_buttons.append(b)

def on_difficulty_chosen(diff):
    global current_difficulty, ready_to_play, entering_name, showing_scores
    global waiting_for_result, waiting_for_scoreboard
    current_difficulty = diff
    clear_difficulty_buttons()
    clear_text()
    entering_name = False
    ready_to_play = True
    showing_scores = False
    waiting_for_result = False       # FIX: reset these so the button works correctly
    waiting_for_scoreboard = False   # FIX: after coming back from scoreboard

    label.config(text="DRUK OP DE\nKNOP OM TE\nSTARTEN", fg="white")

# =====================
# OPNIEUW SPELEN
# =====================
def show_replay_screen():
    clear_text()
    clear_replay_buttons()

    label.config(text=f"Nog een keer\nspelen,\n{player_name}?", fg="white")

    ja = tk.Button(
        root,
        text="JA",
        font=("Courier", 14, "bold"),
        width=8,
        height=2,
        bg="#004400",
        fg="lime",
        activebackground="#006600",
        bd=0,
        command=on_replay_yes
    )
    ja.place(relx=0.28, rely=0.65, anchor="center")
    replay_buttons.append(ja)

    nee = tk.Button(
        root,
        text="NEE",
        font=("Courier", 14, "bold"),
        width=8,
        height=2,
        bg="#440000",
        fg="red",
        activebackground="#660000",
        bd=0,
        command=on_replay_no
    )
    nee.place(relx=0.72, rely=0.65, anchor="center")
    replay_buttons.append(nee)

def on_replay_yes():
    global ready_to_play, entering_name, showing_scores
    clear_replay_buttons()
    clear_text()
    entering_name = False
    ready_to_play = False
    showing_scores = False
    show_difficulty_screen()

def on_replay_no():
    clear_replay_buttons()
    show_start_screen()

# =====================
# TOETSENBORD
# =====================
def show_keyboard():
    rows = ["AZERTYUIOP", "QSDFGHJKLM", "WXCVBN"]

    key_bg = "#222222"
    key_fg = "#00ffff"
    key_active = "#444444"
    special_bg = "#444400"
    font_key = ("Courier", 11, "bold")

    def add_char(c):
        global player_name
        if len(player_name) < 10:
            player_name += c
            name_label.config(text=player_name)

    def backspace():
        global player_name
        player_name = player_name[:-1]
        name_label.config(text=player_name)

    def confirm():
        if not player_name:
            return
        clear_keyboard()
        name_label.config(text="")
        instruction_label.config(text="")
        show_difficulty_screen()

    for r, row in enumerate(rows):
        for c, ch in enumerate(row):
            b = tk.Button(
                root,
                text=ch,
                font=font_key,
                width=2,
                height=1,
                bg=key_bg,
                fg=key_fg,
                activebackground=key_active,
                activeforeground="white",
                bd=0,
                relief="flat",
                command=lambda ch=ch: add_char(ch)
            )
            b.place(
                relx=0.5 + (c - len(row)/2) * 0.088,
                rely=0.44 + r * 0.16
            )
            keyboard_buttons.append(b)

    back = tk.Button(
        root,
        text="⌫",
        font=("Courier", 10, "bold"),
        width=3,
        height=1,
        bg="#440000",
        fg="white",
        activebackground="#660000",
        bd=0,
        command=backspace
    )
    back.place(relx=0.25, rely=0.84)
    keyboard_buttons.append(back)

    enter = tk.Button(
        root,
        text="ENTER",
        font=("Courier", 10, "bold"),
        width=8,
        height=1,
        bg=special_bg,
        fg="yellow",
        activebackground="#666600",
        bd=0,
        command=confirm
    )
    enter.place(relx=0.5, rely=0.84, anchor="n")
    keyboard_buttons.append(enter)

# =====================
# GAME
# =====================
def glitch_loop():
    # FIX: guard re-checked at the time of execution, not just at scheduling time,
    # so any already-queued callbacks will simply do nothing and stop rescheduling.
    if running:
        interval = DIFFICULTIES[current_difficulty]["glitch_interval"]
        label.config(text=random.choice(glitch_texts),
                     fg=random.choice(colors))
        root.after(interval, glitch_loop)

def start_stop():
    global running, start_time, ready_to_play, showing_scores
    global waiting_for_result, waiting_for_scoreboard, current_target

    # --- Name-entry screen: button advances to keyboard ---
    if entering_name:
        # Only react if we're on the "press button to continue" prompt
        if name_label.cget("text") == "Druk op de knop om verder te gaan":
            name_label.config(text="")
            show_keyboard_screen()
        # Otherwise the keyboard is showing — ignore the button entirely
        return

    # --- Guards ---
    if waiting_for_result:
        return

    if waiting_for_scoreboard:
        waiting_for_scoreboard = False
        show_replay_screen()
        return

    # --- Start a round ---
    if not running and ready_to_play and not showing_scores:
        running = True
        start_time = time.time()

        target_setting = DIFFICULTIES[current_difficulty]["target"]
        if target_setting is None:
            current_target = random.uniform(8.0, 12.0)
            target_label.config(text=f"DOELTIJD: {current_target:.1f}s", fg="#ff4444")
        else:
            current_target = target_setting
            target_label.config(text="")

        instruction_label.config(text="")
        label.config(text="")
        glitch_loop()

    # --- Stop a round ---
    elif running:
        running = False          # glitch_loop will stop itself on the next scheduled tick
        waiting_for_result = True
        target_label.config(text="")

        elapsed = time.time() - start_time
        delta = elapsed - current_target
        dier, kleur = get_title(delta)

        label.config(text=dier, fg=kleur)
        result_label.config(
            text=f"{'+' if delta >= 0 else '-'}{abs(delta):.4f}s"
        )

        highscores.append((player_name, delta, current_difficulty))
        save_highscores()

        root.after(1500, show_scoreboard)

def show_scoreboard():
    global showing_scores, waiting_for_result, waiting_for_scoreboard
    showing_scores = True
    waiting_for_result = False
    waiting_for_scoreboard = True

    clear_text()

    filtered = [s for s in highscores if s[2] == current_difficulty]
    sorted_scores = sorted(filtered, key=lambda x: abs(x[1]))
    top5 = sorted_scores[:5]

    # FIX: track rank by index of the last appended entry, not by value matching.
    # We stored the last entry as the final element of highscores; find its position
    # in the per-difficulty sorted list using object identity (index in original list).
    last_global_index = len(highscores) - 1
    last_entry = highscores[last_global_index]

    # Find which element in `filtered` corresponds to the very last append.
    # Because multiple entries can share identical values, we compare by position
    # in the original highscores list.
    rank = None
    filtered_with_idx = [(i, s) for i, s in enumerate(highscores) if s[2] == current_difficulty]
    sorted_with_idx = sorted(filtered_with_idx, key=lambda x: abs(x[1][1]))
    for rank_pos, (orig_idx, _) in enumerate(sorted_with_idx, start=1):
        if orig_idx == last_global_index:
            rank = rank_pos
            break

    total = len(sorted_scores)
    ranking_text = f"[{current_difficulty}] RANKING: {rank} van {total}\n\n" if rank else f"[{current_difficulty}]\n\n"

    text = ranking_text
    for n, d, diff in top5:
        dier, _ = get_title(d)
        text += f"{dier}\n{n} — {'+' if d >= 0 else '-'}{abs(d):.4f}s\n\n"

    highscore_label.config(text=text)
    instruction_label.config(text="Druk op de knop om verder te gaan", fg="white")

# =====================
# BUTTON POLLING
# =====================
def check_button():
    global button_pressed_time

    if GPIO.input(BUTTON_PIN) == GPIO.LOW:
        # Button is held down
        if button_pressed_time is None:
            button_pressed_time = time.time()
        elif time.time() - button_pressed_time > LONG_PRESS_TIME:
            exit_program()
            return  # don't reschedule after exit
    else:
        # Button released
        if button_pressed_time is not None:
            held = time.time() - button_pressed_time
            if held < SHORT_PRESS_MAX:
                start_stop()
        button_pressed_time = None

    root.after(50, check_button)

def exit_program():
    clear_text()
    label.config(text="AFSLUITEN…", fg="red")
    root.update()
    GPIO.cleanup()
    root.destroy()

# =====================
# START
# =====================
load_highscores()
show_start_screen()
check_button()
root.mainloop()
