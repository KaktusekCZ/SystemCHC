<?php
require(__DIR__ . '/connectDB.php');
$username = $_POST["username"];
$groupID = $_POST["groupid"];
$id = $_POST["userId"];
//if (isset($_POST["password"])) {
//    $password = $_POST["password"];
//    $password = $mysqli->real_escape_string($password);
//}
if (!empty($username) && !empty($groupID)) {
    $query = "UPDATE chc_users SET name = '" . $username . "', groupID = '" . $groupID . "' WHERE id = '" . $id . "'";
    mysqli_query($mysqli, $query);
    echo 1;
}