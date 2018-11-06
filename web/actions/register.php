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
$user_type;
if ($usertype == "ucitel") {
    $user_type = 2;
} else {
    $user_type = 1;
}
if ($user) {
    echo 2;
} else if ($password_re == $password) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO chc_users (type, username, name, password, groupID, teacher_email) VALUES ($user_type, '" . $username . "', '" . $name . "', '" . $password_hash . "', '" . $groupid . "', '" . $teacher_mail . "')";
    mysqli_query($mysqli, $query);
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['name'] = $name;
    if(!empty($teacher_mail)){
        require('../phpmailer/index.php');
        send_mail($teacher_mail);
    }
    echo 1;
} else if ($password_re != $password) {
    echo 3;
}
?>