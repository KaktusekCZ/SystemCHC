<?php
if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    require(__DIR__ . '/connectDB.php');
    $res = $mysqli->query("SELECT * FROM chc_users WHERE username ='" . $_COOKIE["username"] . "' ");
    $row = $res->fetch_assoc();
    $_SESSION['username'] = $row["username"];
    $_SESSION['name'] = $row["name"];
    $_SESSION['type'] = $row["type"];
    $_SESSION['id'] = $row["id"];
}