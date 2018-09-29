<?php
function getAccountType($type){
  switch ($type) {
    case 3:
      echo 'Administrátor';
      break;
    case 2:
      echo 'Učitel';
      break;
    case 1:
      echo 'Student';
      break;
    default:
      echo 'Unknown type';
      break;
  }
}
?>