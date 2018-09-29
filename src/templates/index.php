<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login/");
  die();
} else {
  header("Location: admin/");
  die();
}
?>
