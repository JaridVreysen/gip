#include <FastLED.h>

#define LED_PIN       6
#define NUM_LEDS      300
#define LEDS_PER_SIDE 75
#define BRIGHTNESS    80

#define JOY_X   A0
#define JOY_Y   A1
#define JOY_SW  2

#define BOVEN   0
#define RECHTS  1
#define ONDER   2
#define LINKS   3

#define MAX_ROUNDS   20
#define SHOW_DELAY   600
#define PAUSE_DELAY  300
#define JOY_THRESH   400

CRGB leds[NUM_LEDS];

const CRGB kleur[4] = {
  CRGB::Red,
  CRGB::Yellow,
  CRGB::Blue,
  CRGB::Green
};

uint8_t reeks[MAX_ROUNDS];
uint8_t ronde = 0;

void zetZijdeAan(uint8_t richting, CRGB c) {
  int start = richting * LEDS_PER_SIDE;
  for (int i = start; i < start + LEDS_PER_SIDE; i++) leds[i] = c;
  FastLED.show();
}

void allesUit() {
  FastLED.clear(); FastLED.show();
}

void knipperRood() {
  for (uint8_t k = 0; k < 3; k++) {
    fill_solid(leds, NUM_LEDS, CRGB::Red);
    FastLED.show(); delay(300);
    allesUit(); delay(200);
  }
}

uint8_t leesRichting() {
  int x = analogRead(JOY_X);
  int y = analogRead(JOY_Y);
  if (y < JOY_THRESH)          return BOVEN;
  if (x > 1023 - JOY_THRESH)   return RECHTS;
  if (y > 1023 - JOY_THRESH)   return ONDER;
  if (x < JOY_THRESH)          return LINKS;
  return 255;
}

uint8_t wachtInvoer() {
  // Wacht eerst tot joystick terug in het midden is
  while (leesRichting() != 255) delay(20);

  uint8_t geselecteerd = 255;
  while (true) {
    uint8_t r = leesRichting();
    if (r != 255) {
      zetZijdeAan(r, kleur[r]);
      geselecteerd = r;
    } else {
      allesUit();
      geselecteerd = 255;
    }
    if (geselecteerd != 255 && digitalRead(JOY_SW) == LOW) {
      delay(50);
      while (digitalRead(JOY_SW) == LOW);
      allesUit();
      return geselecteerd;
    }
    delay(20);
  }
}

void toonReeks() {
  delay(800);
  for (uint8_t i = 0; i <= ronde; i++) {
    zetZijdeAan(reeks[i], kleur[reeks[i]]);
    delay(SHOW_DELAY);
    allesUit();
    delay(PAUSE_DELAY);
  }
};
void gewonnen() {
  for (uint8_t d = 0; d < 4; d++) {
    zetZijdeAan(d, kleur[d]); delay(200);
  }
  delay(2000); allesUit();
};
void setup() {
  FastLED.addLeds<WS2812B, LED_PIN, GRB>(leds, NUM_LEDS);
  FastLED.setBrightness(BRIGHTNESS);
  pinMode(JOY_SW, INPUT_PULLUP);
  randomSeed(analogRead(A2));
  allesUit();
  delay(1000);
};

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
    zetZijdeAan(reeks[i], kleur[reeks[i]]);
    delay(200); allesUit(); delay(150);
  }

  ronde++;
  if (ronde >= MAX_ROUNDS) {
    gewonnen();
    ronde = 0;
  }
}