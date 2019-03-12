<?php
if ($accRow["type"] == 1) {
    $query = "SELECT * FROM chc_votes WHERE studentID ='".$_SESSION["id"]."'";
}
  echo '<script>console.log('.json_encode($_SESSION["id"]).')</script>';
$votedEvent = $mysqli->query($query);
while($votedEventRow = $votedEvent->fetch_assoc()){
    $votedEvents[] = $votedEventRow;
}
?>