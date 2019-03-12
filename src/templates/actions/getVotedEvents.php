<?php

if ($accRow["type"] == 1) {
    $query = "SELECT * FROM chc_votes WHERE studentID ='".$accRow["id"]."'";
}

$votedEvent = $mysqli->query($query);
while($votedEventRow = $votedEvent->fetch_assoc()){
    $votedEvents[] = $votedEventRow;
}
?>
