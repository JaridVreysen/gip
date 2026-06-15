<?php
session_start();
include './dbh.php';
$response = array();
$html = '';

// Haal data uit POST
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$length = $_POST['length'];
$weight = $_POST['weight'];
$about = $_POST['about'];
$organisation = $_POST['organisation'];
$profilePicture = $_POST['profilePicture'];


if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    $sql = "UPDATE `user`
            SET `firstname` = ?,
                `lastname` = ?,
                `age` = ?,
                `weight` = ?,
                `length` = ?,
                `gender` = ?,
                `about` = ?,
                `profilePicture` = ?
            WHERE `id` = ?";

    $statement = $conn->prepare($sql);

    $statement->bind_param(
        "sssssssss",
        $firstName,
        $lastName,  
        $age,
        $weight,
        $length,
        $gender,
        $about,
        $profilePicture,
        $userId
    );
    
    if ($statement->execute()) {
        $response['message'] = 'Course succesvol aangemaakt';
    } else {
        $response['error'] = 'Database error: ' . $conn->error;
    }

}


$response['html'] = $html;
echo json_encode($response); 