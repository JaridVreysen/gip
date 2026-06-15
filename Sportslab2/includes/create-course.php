<?php
session_start();
include './dbh.php';

header('Content-Type: application/json');
$response = [];

// var_dump($_POST);
// var_dump($_POST['fiche_ids']);

// Haal de fiche IDs op
$ficheIdsString = $_POST['fiche_ids'] ?? '';
$ficheIds = explode(',', $ficheIdsString);

// Validatie
if (empty($ficheIds) || $ficheIds[0] === '') {
    $response['error'] = 'Geen fiches geselecteerd';
    echo json_encode($response);
    exit();
}

$userId = $_SESSION['id'];
$title = $_POST['courseTitle'];
$introduction = $_POST['description'];
$niveau = $_POST['niveau'];
$picture = $_FILES['picture'];
$sql = "SELECT `organisation` FROM `user` WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

$organisation = $user['organisation'] ?? null;


$maxSize = 10 * 1024 * 1024; //10 MB
if ($picture['size'] > $maxSize) {
  $response['error'] = 'Te groot bestand';
  echo json_encode($response);
  exit();
}
//get the extension
$extension = strtolower(pathinfo(basename($picture['name']), PATHINFO_EXTENSION));
//path
$pictureId = uuidv4();
$shortPath = $pictureId . '.' . $extension;
$targetPath = '../media/' . $pictureId . '.' . $extension;
move_uploaded_file($picture['tmp_name'], $targetPath);





// Genereer een unieke ID voor de course
$courseId = uuidv4();

// Optioneel: course titel en beschrijving (als je die hebt)
// $courseTitle = $_POST['courseTitle'] ?? 'Nieuwe Course';
// $courseDescription = $_POST['courseDescription'] ?? '';

// Maak de course aan
$sql = "INSERT INTO `course`(`id`, `authorId`, `name`, `introduction`, `niveau`, `path`, `extension`, `picturename`, `organisationId`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$statement = $conn->prepare($sql);
$statement->bind_param('sssssssss', $courseId, $userId, $title, $introduction, $niveau, $shortPath, $extension, $picture['name'], $organisation);

if ($statement->execute()) {
    // Koppel de fiches aan de course
    $sqlLink = "INSERT INTO `course_fiche`(`id`, `courseId`, `ficheId`, `position`) VALUES (?, ?, ?, ?)";
    $stmtLink = $conn->prepare($sqlLink);
    
    foreach ($ficheIds as $index => $ficheId) {
        $course_ficheId = uuidv4();
        $sortOrder = $index + 1;
        $stmtLink->bind_param('sssi',$course_ficheId, $courseId, $ficheId, $sortOrder);
        $stmtLink->execute();
    }
    
    $response['ok'] = true;
    $response['id'] = $courseId;
    $response['message'] = 'Course succesvol aangemaakt';
} else {
    $response['error'] = 'Database error: ' . $conn->error;
}

echo json_encode($response);
?>