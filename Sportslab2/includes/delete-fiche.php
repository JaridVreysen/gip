<?php
session_start();
include './dbh.php';

$id = $_POST['id'];

$sql = "DELETE FROM `fiche` WHERE id = ?";

$statement = $conn->prepare($sql);
$statement->bind_param("s", $id);
$statement->execute();
$result = $statement->get_result();

$response['ok'] = true;
$response['id'] = $id;
echo json_encode($response);
