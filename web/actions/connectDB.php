<?php
require(__DIR__.'/../config.php');
$db_database = 'chcsystem';
$mysqli = new mysqli($db_servername, $db_username, $db_password, $db_database);
if ($mysqli->connect_errno) {
    echo "Nepodařilo se připojit k databázi: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$mysqli->query("set names 'utf8'");
header("Content-Type: text/html;charset=UTF-8");
?>