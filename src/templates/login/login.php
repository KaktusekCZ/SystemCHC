<?php
  $username = $_POST['username'];
  $password = $_POST['password'];

  require(__DIR__.'/../config.php');
  $db_database = 'chcsystem';

  $mysqli = new mysqli($db_servername, $db_username, $db_password, $db_database);
  if ($mysqli->connect_errno) {
      echo "Nepodařilo se připojit k databázi: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }

  $username = $mysqli->real_escape_string($username);
  $password = $mysqli->real_escape_string($password);

  $res = $mysqli->query("SELECT * FROM chc_users WHERE username ='".$username."'");
  $row = $res->fetch_assoc();
  $hash = $row['password'];

  $valid = password_verify($password, $hash);
    if ( $valid ) {
     if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
       $newHash = password_hash($password, PASSWORD_DEFAULT);
       $mysqli->query("UPDATE chc_users SET password = '".$newHash."' WHERE username = '".$username."'");
     }
      session_start();
      $_SESSION['username'] = $username;
      echo 1;
    } else {
     echo 0;
    }


?>
