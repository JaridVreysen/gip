<?php
header("Content-Type: application/json");

$counts = [
    "1 Ster"    => 0,
    "2 Sterren" => 0,
    "3 Sterren" => 0,
    "4 Sterren" => 0,
];

$myfile = fopen("ratings.txt", "r");
if ($myfile) {
    while (!feof($myfile)) {
        $line = fgets($myfile);
        if (trim($line) === "") continue;
        $data = explode('|', $line);
        if (count($data) < 2) continue;
        $stars = trim($data[1]);
        if (isset($counts[$stars])) {
            $counts[$stars]++;
        }
    }
    fclose($myfile);
}

echo json_encode(array_values($counts));
?>