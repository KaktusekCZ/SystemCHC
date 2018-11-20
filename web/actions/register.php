<?php

require(__DIR__ . '/connectDB.php');

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$name = mysqli_real_escape_string($mysqli, $_POST['name']);
$password = mysqli_real_escape_string($mysqli, $_POST['password']);
$password_re = mysqli_real_escape_string($mysqli, $_POST['password_re']);
$groupid = mysqli_real_escape_string($mysqli, $_POST["groupid"]);
$usertype = mysqli_real_escape_string($mysqli, $_POST["usertype"]);
$user_check = "SELECT * FROM chc_users WHERE username ='" . $username . "'";
$result = mysqli_query($mysqli, $user_check);
$user = mysqli_fetch_assoc($result);
$teacher_mail = mysqli_real_escape_string($mysqli, $_POST["email_teacher"]);
$teacher_mail_hash = md5(mysqli_real_escape_string($mysqli, $_POST["email_teacher"]));
if ($usertype == "ucitel") {
    $user_type = 2;
} else {
    $user_type = 1;
}
if ($user) {
    echo 2;
} else if ($password_re == $password) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO chc_users (type, username, name, password, groupID) VALUES ($user_type, '" . $username . "', '" . $name . "', '" . $password_hash . "', '" . $groupid . "')";
    mysqli_query($mysqli, $query);
    if ($user_type == 2) {
        $res = $mysqli->query("SELECT * FROM chc_users WHERE username ='" . $username . "'");
        $row = $res->fetch_assoc();
        $id = $row['id'];
        $query = "INSERT INTO chc_teacher (teacher_id, hash, email) VALUES ($id, '" . $teacher_mail_hash . "', '" . $teacher_mail . "')";
        mysqli_query($mysqli, $query);
    }
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['name'] = $name;
    if (!empty($teacher_mail)) {
        require('../phpmailer/index.php');
        send_mail($teacher_mail, $teacher_mail_hash);
        ob_end_clean();
        echo 4;
    } else {
        echo 1;
    }
} else if ($password_re != $password) {
    echo 3;
}
?>