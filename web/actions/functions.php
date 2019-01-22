<?php
function getAccountType($type){
  switch ($type) {
    case 3:
      return 'Administrátor';
      break;
    case 2:
      return 'Učitel';
      break;
    case 1:
      return 'Student';
      break;
    default:
      return 'Unknown type';
      break;
  }
}
function getAccountGrade($group){
  $toReturn = $group["grade"].". ročník ";
  switch ($group["groupID"]) {
    case 1:
      $toReturn .= 'VMA';
      break;
    case 2:
      $toReturn .= 'GD';
      break;
    case 3:
      $toReturn .= 'MT';
      break;
    default:
      $toReturn = 'všechny ročníky';
      break;
  }
  return $toReturn;
}
function resultToArray($result) {
    $rows = array();
//    while($row = $result->fetch_assoc() !== null) {
//        $rows[] = $row;
//    }
    return $rows;
}
function getTeacherName($mysqli, $teacherID){
  $name = $mysqli->query("SELECT name FROM chc_users WHERE id ='".$teacherID."'");
  $nameString = $name->fetch_assoc();
  return $nameString["name"];
}
function checkExpiredEvents($mysqli){
    if ($events = $mysqli->query("SELECT created FROM chc_events")) {
        while ($obj = $events->fetch_object()) {
            $timestamp = strtotime($obj->created);
            $currentTimestamp = time();

            if(($currentTimestamp - $timestamp) > 86400){
                $mysqli->query("UPDATE chc_events SET expired = 1 WHERE created = '".$obj->created."'");
            }
        }
    }
}
?>