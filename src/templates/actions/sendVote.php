<?php
  require(__DIR__.'/connectDB.php');
  session_start();
  $id = $_SESSION['id'];
  $data = $_POST;
  if (isset($data['form']['summary'])) {
      $summary = $data['form']['summary'];
  } else {
      $summary = -1;
  }
  if (isset($data['form']['satisfy'])) {
      $satisfy = $data['form']['satisfy'];
  } else {
      $satisfy = -1;
  }
  $eventID = $data['eventid'];
  $dt = date('Y-m-d H:i:s.u', $data['time']);
  $mysqli->query("INSERT INTO chc_votes (eventID, date, studentID, summary, satisfy) VALUES ('$eventID', '$dt', '$id', '$summary', '$satisfy')");
  echo 1;
  ?>
