<?php
$acc = $mysqli->query("SELECT * FROM chc_users WHERE username ='".$_SESSION["username"]."'");
$accRow = $acc->fetch_assoc();
?>
