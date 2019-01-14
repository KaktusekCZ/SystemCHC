<?php
require('../actions/connectDB.php');
$hash = $_GET['code'];
$res = $mysqli->query("SELECT * FROM chc_teacher WHERE hash = '" . $hash . "'");
$row = $res->fetch_assoc();
$row_hash = $row['hash'];
$valid = strcmp($row_hash, $hash);
if (!$valid) {
    $mysqli->query("UPDATE chc_teacher SET verify = 1 WHERE hash = '" . $hash . "'");
    header('Location: ../login/?status=goodVerify');
} else {
    header('Location: ../login/?status=badVerify');
}
?>
<!DOCTYPE html>
<html>

    <head>
    </head>

    <body>
    </body>

</html>