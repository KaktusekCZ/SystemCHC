<?php
require(__DIR__ . '/connectDB.php');

$username = $_POST['username'];
$password = $_POST['password'];

$username = $mysqli->real_escape_string($username);
$password = $mysqli->real_escape_string($password);
$res = $mysqli->query("SELECT * FROM chc_users INNER JOIN chc_teacher ON chc_users.id = chc_teacher.teacher_id WHERE username ='" . $username . "'");
$row = $res->fetch_assoc();
die(var_dump($row));
$hash = $row['password'];
$verify = $row['verify'];
$email = $row['email'];
$name = $row['name'];
$type = $row['type'];
$id = $row['id'];

$valid = password_verify($password, $hash);
if ($verify == "0" && !empty($email)) {
    echo 2;
} else if ($valid) {
    if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
        $newHash = password_hash($password, PASSWORD_DEFAULT);
        $mysqli->query("UPDATE chc_users SET password = '" . $newHash . "' WHERE username = '" . $username . "'");
    }
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['name'] = $name;
    $_SESSION['type'] = $type;
    $_SESSION['id'] = $id;
    echo 1;
} else {
    echo 0;
}


?>
