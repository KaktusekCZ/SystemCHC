<?php
  require(__DIR__.'/connectDB.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = $mysqli->real_escape_string($username);
  $password = $mysqli->real_escape_string($password);

  $res = $mysqli->query("SELECT * FROM chc_users WHERE username ='".$username."'");
  $row = $res->fetch_assoc();
  $hash = $row['password'];
  $name = $row['name'];
  $type = $row['type'];
  $id = $row['id'];

  $valid = password_verify($password, $hash);
    if ( $valid ) {
     if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
       $newHash = password_hash($password, PASSWORD_DEFAULT);
       $mysqli->query("UPDATE chc_users SET password = '".$newHash."' WHERE username = '".$username."'");
     }
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['name'] = $name;
      $_SESSION['type'] = $type;
      $_SESSION['id'] = $id;
      echo 1;
    } else {
     echo 0;
    }


?>