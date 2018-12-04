<?php
$group = $mysqli->query("SELECT * FROM chc_groups WHERE id ='".$accRow["groupID"]."'");
$groupRow = $group->fetch_assoc();
?>
