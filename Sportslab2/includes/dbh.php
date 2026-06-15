<?php
$dbServer = '160.153.132.203';
$dbUser = 'gip_promotion';
$dbPassword = '8l/Y/0Aud!LZwc*+US_2';
$dbName = 'gip_2026_promotion';
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);

function uuidv4() {
    $data = random_bytes(16);
    
    // Set version to 0100 (UUID v4)
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
    // Set bits 6-7 to 10 (RFC 4122 variant)
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}