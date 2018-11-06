<?php
  require(__DIR__.'/connectDB.php');
  session_start();
  $id = $_SESSION['id'];
  $data = $_POST;

  $time = (int) substr($data['time'], 0, -3);

  $summary = $data['form']['summary'];
  $satisfy = $data['form']['satisfy']
  $eventID = $data['eventid'];
  $dt = new DateTime('@'.$time);
  echo $dt->format('Y-m-d H:i:s');
  $mysqli->query("INSERT INTO chc_votes (eventID, date, studentID, summary, satisfy) VALUES ('$eventID', '$dt', '$id', '$summary', '$satisfy')");?>
