<?php
  session_start();
  session_unset();
  session_destroy();
  session_write_close();
  setcookie(session_name(),'',0,'/');
  if (session_status() == PHP_SESSION_NONE) {
    echo 1;
  } else {
    echo 0;
  }
?>