<?php
require(__DIR__ . '/connectDB.php');
die("sdfsdf");
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$name = mysqli_real_escape_string($mysqli, $_POST['name']);
$password = mysqli_real_escape_string($mysqli,$_POST['password']);
$password_re = mysqli_real_escape_string($mysqli,$_POST['password_re']);

$user_check = "SELECT * FROM chc_users WHERE username='$username' LIMIT 1";
$result = mysqli_query($mysqli, $user_check);
$user = mysqli_fetch_assoc($result);

if ($user) {
    echo 2;
}else if ($password_re == $password){
    $password_hash = $password_hash($password);
    $query =  "INSERT INTO chc_users (username, name, password) VALUES ('$username', '$name', '$password_hash')";
    mysqli_query($mysqli, $query);
    echo 1;
}else{
    echo 0;
}
?>