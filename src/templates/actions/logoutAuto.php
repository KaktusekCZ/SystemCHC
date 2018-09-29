<?php
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2700)) {
  session_start();
  session_unset();
  session_destroy();
  session_write_close();
  setcookie(session_name(),'',0,'/');
  header("Location: ../login/?status=logoutAuto");
  die();
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
