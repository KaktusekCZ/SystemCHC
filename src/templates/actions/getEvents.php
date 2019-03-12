<?php
if ($accRow["type"] == 3) {
    $query = "SELECT * FROM chc_events";
} else if ($accRow["type"] == 2) {
    $query = "SELECT * FROM chc_events WHERE teacherID ='".$accRow["id"]."'";
} else {
    $query = "SELECT * FROM chc_events WHERE groupID ='".$accRow["groupID"]."' ORDER BY created DESC";
}
$event = $mysqli->query($query);
while($eventRow = $event->fetch_assoc()){
    $events[] = $eventRow;
}

?>
