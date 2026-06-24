#include <FastLED.h>

#define LED_PIN       6
#define NUM_LEDS      300
#define LEDS_PER_SIDE 75
#define BRIGHTNESS    80

#define BTN_BOVEN   2
#define BTN_RECHTS  3
#define BTN_ONDER   4
#define BTN_LINKS   5

#define BUZZER_PIN  8

#define BOVEN   0
#define RECHTS  1
#define ONDER   2
#define LINKS   3

#define MAX_ROUNDS   20
#define SHOW_DELAY   600
#define PAUSE_DELAY  300

CRGB leds[NUM_LEDS];

const CRGB kleur[4] = {
  CRGB::Red,
  CRGB::Yellow,
  CRGB::Blue,
  CRGB::Green
};

const int toon[4] = { 262, 440, 698, 1175 };
const uint8_t knop[4] = { BTN_BOVEN, BTN_RECHTS, BTN_ONDER, BTN_LINKS };

uint8_t reeks[MAX_ROUNDS];
uint8_t ronde = 0;

void zetZijdeAan(uint8_t richting, CRGB c) {
  FastLED.clear();
  int start = richting * LEDS_PER_SIDE;
  for (int i = start; i < start + LEDS_PER_SIDE; i++) leds[i] = c;
  FastLED.show();
}

void allesUit() {
  FastLED.clear();
  FastLED.show();
  // geen noTone hier, zodat loslaten knop geen geluid maakt
}

void knipperRood() {
  for (uint8_t k = 0; k < 3; k++) {
    fill_solid(leds, NUM_LEDS, CRGB::Red);
    FastLED.show();
    tone(BUZZER_PIN, 150);
    delay(300);
    noTone(BUZZER_PIN);
    FastLED.clear();
    FastLED.show();
    delay(200);
  }
}

// Toon reeks: LED + geluid
void speelKleur(uint8_t richting) {
  zetZijdeAan(richting, kleur[richting]);
  tone(BUZZER_PIN, toon[richting]);
  delay(SHOW_DELAY);
  noTone(BUZZER_PIN);
  allesUit();
  delay(PAUSE_DELAY);
}

uint8_t wachtInvoer() {
  // Wacht tot alle knoppen losgelaten zijn
  bool nogIngedrukt = true;
  while (nogIngedrukt) {
    nogIngedrukt = false;
    for (uint8_t i = 0; i < 4; i++) {
      if (digitalRead(knop[i]) == LOW) nogIngedrukt = true;
    }
    delay(10);
  }

  while (true) {
    for (uint8_t i = 0; i < 4; i++) {
      if (digitalRead(knop[i]) == LOW) {
        delay(50); // debounce
        // 1. LED aan
        zetZijdeAan(i, kleur[i]);
        // 2. Geluid aan
        tone(BUZZER_PIN, toon[i]);
        delay(300);
        // 3. Geluid uit — VOOR het loslaten
        noTone(BUZZER_PIN);
        // 4. Wacht op loslaten — buzzer is al stil, geen geluid mogelijk
        while (digitalRead(knop[i]) == LOW) delay(10);
        // 5. LED uit
        allesUit();
        return i;
      }
    }
    delay(10);
  }
}

void toonReeks() {
  delay(800);
  for (uint8_t i = 0; i <= ronde; i++) {
    speelKleur(reeks[i]);
  }
}

void gewonnen() {
  for (uint8_t d = 0; d < 4; d++) {
    zetZijdeAan(d, kleur[d]);
    tone(BUZZER_PIN, toon[d]);
    delay(300);
    noTone(BUZZER_PIN);
    allesUit();
    delay(100);
  }
  delay(2000);
}

void setup() {
  FastLED.addLeds<WS2812B, LED_PIN, GRB>(leds, NUM_LEDS);
  FastLED.setBrightness(BRIGHTNESS);
  pinMode(BTN_BOVEN,  INPUT_PULLUP);
  pinMode(BTN_RECHTS, INPUT_PULLUP);
  pinMode(BTN_ONDER,  INPUT_PULLUP);
  pinMode(BTN_LINKS,  INPUT_PULLUP);
  pinMode(BUZZER_PIN, OUTPUT);
  randomSeed(analogRead(A2));
  allesUit();
  delay(1000);
}

void loop() {
  reeks[ronde] = random(4);
  toonReeks();

  for (uint8_t i = 0; i <= ronde; i++) {
    uint8_t invoer = wachtInvoer();
    if (invoer != reeks[i]) {
      knipperRood();
      ronde = 0;
      delay(1000);
      return;
    }
  }

  ronde++;
  if (ronde >= MAX_ROUNDS) {
    gewonnen();
    ronde = 0;
  }
}
