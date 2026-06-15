<?php
session_start();
include './dbh.php';

var_dump($_FILES);

$file = $_FILES['file'];

$maxSize= 10*1024*1024; //10 MB
if ($file['size']> $maxSize) {
    $response['error'] = 'Te groot bestand';
    echo json_encode($response);
    exit();
}

//enkel afbeelding toelaten...


//get the extension
$ext = strtolower(pathinfo(basename($file['name']), PATHINFO_EXTENSION));

$userId = $_SESSION['id'];
$shortPath = $userId . '.' . $ext;
$targetPath = '../media/'. $userId . '.' . $ext;
move_uploaded_file($file['tmp_name'], $targetPath); 


//toevoegen databank
$sql = "UPDATE user SET path = ?, name = ?, extension = ? WHERE id = ?";
$statement = $conn->prepare($sql);
$statement->bind_param('sssi', $shortPath, $file['name'], $ext, $userId);
$statement->execute();





