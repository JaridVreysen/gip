<?php
session_start();
include './dbh.php';

header('Content-Type: application/json');
$response = [];

$ficheTitle = $_POST['ficheTitle'];
$niveau = $_POST['niveau'];
$execute = $_POST['execute'];
$muscles = $_POST['muscles'];
$exercise = $_POST['exercise'];
$userId = $_SESSION['id'];
$time = $_POST['time'];

var_dump('ok');
$coverPicture = $_FILES['coverPicture'];
$musclePicture = $_FILES['musclePicture'];
$exercisePicture = $_FILES['exercisePicture'];
var_dump($_FILES);
var_dump($coverPicture);
var_dump($musclePicture);
var_dump($exercisePicture);
$maxSize = 10 * 1024 * 1024; //10 MB
if ($coverPicture['size'] > $maxSize || $musclePicture['size'] > $maxSize || $exercisePicture['size'] > $maxSize) {
  $response['error'] = 'Te groot bestand';
  echo json_encode($response);
  exit();
}

$id = uuidv4();
$cId = uuidv4();
$mId = uuidv4();
$eId = uuidv4();

//get the extension
$coverExt = strtolower(pathinfo(basename($coverPicture['name']), PATHINFO_EXTENSION));
$muscleExt = strtolower(pathinfo(basename($musclePicture['name']), PATHINFO_EXTENSION));
$exerciseExt = strtolower(pathinfo(basename($exercisePicture['name']), PATHINFO_EXTENSION));

$cShortPath = $cId . '.' . $coverExt;
$mShortPath = $mId . '.' . $muscleExt;
$eShortPath = $eId . '.' . $exerciseExt;

$cTargetPath = '../media/' . $cId . '.' . $coverExt;
$mTargetPath = '../media/' . $mId . '.' . $muscleExt;
$eTargetPath = '../media/' . $eId . '.' . $exerciseExt;
move_uploaded_file($coverPicture['tmp_name'], $cTargetPath);
move_uploaded_file($musclePicture['tmp_name'], $mTargetPath);
move_uploaded_file($exercisePicture['tmp_name'], $eTargetPath);


$sql = "INSERT INTO `fiche`(`id`, `title`, `niveau`, `excecute`, `muscles`, `exercise`, `cName`, `cPath`, `cExtension`, `mName`, `mPath`, `mExtension`, `eName`, `ePath`, `eExtension`, `authorId`,`time`)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$statement = $conn->prepare($sql);
$statement->bind_param(
  'sssssssssssssssss',
  $id,
  $ficheTitle,
  $niveau,
  $execute,
  $muscles,
  $exercise,
  $coverPicture['name'],
  $cShortPath,
  $coverExt,
  $musclePicture['name'],
  $mTargetPath,
  $muscleExt,
  $exercisePicture['name'],
  $eTargetPath,
  $exerciseExt,
  $userId,
  $time
);
$statement->execute();

$response['ok'] = true;
$response['id'] = $id;
echo json_encode($response);
