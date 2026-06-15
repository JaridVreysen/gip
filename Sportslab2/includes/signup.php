    <?php
    session_start();
    include './dbh.php';
    $response = array();
    $html = '';
    $email = $_POST['email'];
    $firstname = $_POST['FirstName'];
    $lastname = $_POST['LastName'];
    $user = $_POST['UserName'];
    $password1 = $_POST['Password1'];
    $password2 = $_POST['Password2'];

    //check if user exists
    $sql = "SELECT `id` FROM `user` WHERE `username` = ? LIMIT 1";

    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $user);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();

    $sql2 = "SELECT `id` FROM `user` WHERE `email` = ? LIMIT 1";
    $statement = $conn->prepare($sql2);
    $statement->bind_param('s', $email);
    $statement->execute();
    $result = $statement->get_result();
    $row2 = $result->fetch_assoc();

    if ($row) {
        //user exists
        $response['error'] = 'Gebruikersnaam bestaat al.';
        echo json_encode($response);
        exit();
    } else if ($row2){
        //email exists
        $response['error'] = 'email bestaat al.';
        echo json_encode($response);
        exit();
    } else if (empty($_POST['termsAccepted']) || $_POST['termsAccepted'] !== 'true') {
    $response['error'] = 'You must agree to the terms of service.';
    echo json_encode($response);
    exit();
    }

    //add user
    $password = password_hash($password1, PASSWORD_DEFAULT);
    $id = uuidv4();
    $sql = "INSERT INTO `user`(`id`,`firstname`,`lastname`,`username`,`password`,`email`, `terms_accepted`, `terms_accepted_at`) VALUES (?,?,?,?,?,?,1,NOW())";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ssssss', $id, $firstname, $lastname, $user, $password, $email);
    $statement->execute();

    // user automatisch inloggen
    session_regenerate_id(true);
    $_SESSION['id'] = $id;
    $_SESSION['user'] = $user;
    $_SESSION['email'] = $email;

    $response['html'] = $html;
    echo json_encode($response);
