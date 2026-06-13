<?php
header("Content-Type: application/json");

// Alleen POST accepteren, het moet POST zijn.
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Methode niet toegestaan"]);
    exit;
}
//Eerst de ruwe json file lezen en dan decoden naar php.
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// Validatie: rating moet aanwezig zijn en een tekst zijn, anders error.
if (!isset($data["rating"]) || !is_string($data["rating"])) {
    http_response_code(400);
    echo json_encode(["error" => "Ongeldige data"]);
    exit;
}

// Alleen toegestaande waardes opslaan, 'niks' moet niet als waarde opgeslaan worden want anders staat het bestand vol met 'niks' en dan is er soms een ster
$allowed = ["1 Ster", "2 Sterren","3 Sterren","4 Sterren"];
//Volgende (in commentaar) kun je gebruiken als je alleen de cijfers nodig hebt en niet de sterren, bv. voor een grafiek ofzo.
// $sterren_map = [
//     "1 Ster"    => "1",
//     "4 Sterren" => "4",
// ];
$rating = trim($data["rating"]);

if (!in_array($rating, $allowed)) {
    http_response_code(400);
    echo json_encode(["error" => "Ongeldige rating: " . $rating]);
    exit;
}

// Opslaan met tijdstempel in het formaat: jaar-maand-dag uur:minuut:seconde. (Zelfde formaat als MySQL)
$timestamp = date("Y-m-d H:i:s");
$line = $timestamp . " | " . $rating . PHP_EOL; // Plakt het aan elkaar: "tijd | rating"
$result = file_put_contents("ratings.txt", $line, FILE_APPEND | LOCK_EX); // In het tekstbestand toevoegen (onderaan). Bestand wordt vergrendelt tijdens het schrijven zodat je niet 2 dingen tegelijk kunt toevoegen want anders gaat het kapot.

// Als je het niet kunt opslaan dan wordt er een error getoond "Kan niet opslaan". Dit zie je dan in de console.
if ($result === false) {
    http_response_code(500);
    echo json_encode(["error" => "Kan niet opslaan"]);
    exit;
}
// Als alles is gelukt dan wordt er getoond dat het OK is en staat er "saved 4 sterren" als je 4 sterren hebt gegeven.
echo json_encode(["status" => "OK", "saved" => $rating]);
?>
