<?php
session_start();
include './dbh.php';

$response = array();
$html = '';

// Haal data uit POST
$login = $_POST['UserName'];
$password = $_POST['Password'];
// Controleer of gebruiker bestaat
$sql = "SELECT * FROM `user`
WHERE `username` = ? OR `email` = ? LIMIT 1";
$statement = $conn->prepare($sql);
$statement->bind_param('ss', $login, $login);
$statement->execute();
$result = $statement->get_result();
$row = $result->fetch_assoc();

// Gebruiker niet gevonden
if (!$row) {
    $response['error'] = 'Gebruikersnaam of email niet gevonden.';
    echo json_encode($response);
    exit();
}

// Wachtwoord niet correct
if (!password_verify($password, $row['password'])) {
    $response['error'] = 'Wachtwoord onjuist.';
    echo json_encode($response);
    exit();
}

$_SESSION['id'] = $row['id'];
$_SESSION['user'] = $row['username'];
$_SESSION['firstname'] = $row['firstname'];
$_SESSION['lastname'] = $row['lastname'];
$_SESSION['email'] = $row['email'];
$_SESSION['profilePicture'] = $row['profilePicture'];

$response['html'] = $html;
echo json_encode($response);
