<?php
require(__DIR__ . '/connectDB.php');
$query = "DELETE FROM chc_users WHERE id='" . $_POST["delete"] . "'";
mysqli_query($mysqli, $query);
echo 1;