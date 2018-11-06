<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header("Location: ../login/?status=loginNeeded");
    die();
  }

  require(__DIR__.'/../actions/connectDB.php');
  require(__DIR__.'/../actions/logoutAuto.php');
  require(__DIR__.'/../actions/functions.php');

  $acc = $mysqli->query("SELECT * FROM chc_users WHERE username ='".$_SESSION["username"]."'");
  $accRow = $acc->fetch_assoc();

  $group = $mysqli->query("SELECT * FROM chc_groups WHERE id ='".$accRow["groupID"]."'");
  $groupRow = $group->fetch_assoc();

  if ($accRow["type"] == 3) {
    $query = "SELECT * FROM chc_events";
  } else if ($accRow["type"] == 2) {
    $query = "SELECT * FROM chc_events WHERE teacherID ='".$accRow["id"]."'";
  } else {
    $query = "SELECT * FROM chc_events WHERE groupID ='".$accRow["groupID"]."' ORDER BY created DESC";
  }
  $event = $mysqli->query($query);
  $events = resultToArray($event);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>CHC | Administrace</title>
    <link href="http://gulpjs.com/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="../bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="../icons/fontawesome/all.min.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="admin">
      <div class="row no-gutters">
        <div class="admin__menu col-2">
          <div class="admin__logo">Hodnocení učitelů CHC</div>
          <ul>
            <?php if($accRow["type"] == 1) : ?>
              <a href="#"><li class="active"><span>Hodnotit</span><i class="fas fa-plus"></i></li></a>
              <a href="#"><li><span>Mé hodnocení</span><i class="fas fa-list-ul"></i></li></a>
            <?php elseif($accRow["type"] == 2) : ?>
              <div class="aaa">
                Menu Ucitele
              </div>
            <?php elseif($accRow["type"] == 3) : ?>
              <div class="aaa">
                Menu Admina
              </div>
            <?php endif; ?>
          </ul>
        </div>
        <div class="admin__content col-10">
          <?php
          include(__DIR__.'/../actions/loginStatus.php');
          ?>
          <div class="admin__bar">
            <div class="admin__bar__status">
              <?php echo '<div class="admin__bar__item admin__bar__item--type"><span class="header"><i class="fas fa-user"></i> Typ účtu</span>'.getAccountType($accRow["type"]).'</div>'?>
              <?php if($accRow["type"] == 1) : ?>
                <?php echo'<div class="admin__bar__item admin__bar__item--grade"><span class="header"><i class="fas fa-users"></i> Třída</span>'.getAccountGrade($groupRow).'</div>'?>
              <?php endif; ?>
              <?php echo'<div class="admin__bar__item admin__bar__item--name"><span class="header"><i class="fas fa-user"></i> Přihlášen</span><span class="name">'.$accRow["name"].'</span></div>'?>
              <div class="admin__bar__item admin__bar__item--logout js-admin-logout">Odhlásit se <i class="fas fa-sign-out-alt"></i></div>
            </div>
          </div>

          <div class="admin__votes">
            <?php echo '<h1 class="admin__votes__title">Možnosti hodnocení pro '.getAccountGrade($groupRow).'</h1>'?>
            <ul class="nav nav-tabs" id="votes" role="tablist">
              <li class="nav-item"><a class="nav-link active" id="votesAvailable-tab" data-toggle="tab" href="#votesAvailable" role="tab" aria-controls="votesAvailable" aria-selected="true">Dostupné hodnocení</a></li>
              <li class="nav-item"><a class="nav-link" id="votesFinished-tab" data-toggle="tab" href="#votesFinished" role="tab" aria-controls="votesFinished" aria-selected="false">Expirované hodnocení</a></li>
            </ul>
            <div class="tab-content" id="votesContent">
              <div class="tab-pane fade show active" id="votesAvailable" role="tabpanel" aria-labelledby="votesAvailable-tab">
                <?php
                  echo '<div class="admin__votes__item admin__votes__item--header">';
                  echo '<div class="admin__votes__content admin__votes__header">Název</div>';
                  echo '<div class="admin__votes__content admin__votes__teacher">Učitel</div>';
                  echo '<div class="admin__votes__content admin__votes__time">Datum vytvoření</div>';
                  echo '</div>';
                  for ($i=0; $i < count($events); $i++) {
                    if($events[$i]['expired'] == 0){
                      echo '<div class="admin__votes__item" data-eventID="'.$events[$i]['id'].'">';
                      echo '<div class="admin__votes__content admin__votes__header">'.$events[$i]['header'].'</div>';
                      echo '<div class="admin__votes__content admin__votes__teacher">'.getTeacherName($mysqli, $events[$i]["teacherID"]).'</div>';
                      echo '<div class="admin__votes__content admin__votes__time">'.$events[$i]['created'].'</div>';
                      echo '<div class="admin__votes__content admin__votes__btn-wrapper"><button type="button" class="admin__votes__btn js-admin-vote">Hodnotit <i class="fas fa-chevron-right"></i></button></div>';
                      echo '</div>';
                    }
                  }
                ?>
              </div>
              <div class="tab-pane fade" id="votesFinished" role="tabpanel" aria-labelledby="votesFinished-tab">
                <?php
                  echo '<div class="admin__votes__item admin__votes__item--header">';
                  echo '<div class="admin__votes__content admin__votes__header">Název</div>';
                  echo '<div class="admin__votes__content admin__votes__teacher">Učitel</div>';
                  echo '<div class="admin__votes__content admin__votes__time">Datum vytvoření</div>';
                  echo '</div>';
                  for ($i=0; $i < count($events); $i++) {
                    if($events[$i]['expired'] == 1){
                      echo '<div class="admin__votes__item">';
                      echo '<div class="admin__votes__content admin__votes__header">'.$events[$i]['header'].'</div>';
                      echo '<div class="admin__votes__content admin__votes__teacher">'.getTeacherName($mysqli, $events[$i]["teacherID"]).'</div>';
                      echo '<div class="admin__votes__content admin__votes__time">'.$events[$i]['created'].'</div>';
                      echo '</div>';
                    }
                  }
                ?>
              </div>
            </div>
          </div>

          <div id="modal-space">

          </div>

        </div>
      </div>
    </div>
    <script src="../js/vendor/jquery-3.3.1.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var request;
        $(".js-admin-logout").on('click', function(event){
          event.preventDefault();
          if (request) {
              request.abort();
          }
          request = $.ajax({
              url: "../actions/logout.php",
              type: "post",
          });
          request.done(function (response){
            if (response == 1) {
              window.location.href = "../login/?status=logout";
            } else {
              alert('chyba');
            }
          });
        });

        $(".js-admin-vote").on("click", function(event){
            event.preventDefault();
            if (request) {
                request.abort();
            }

            var id = $(this).closest('.admin__votes__item').attr('data-eventid');

            request = $.ajax({
                url: "../actions/vote.php",
                type: "post",
                data: {"id": id}
            });
            request.done(function (response){
              $("#modal-space").html(response);
              $(".vote-modal").modal("show");
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
              alert("Chyba. Prosím, kontaktujte správce.")
              console.log(jqXHR);
              console.log(textStatus);
              console.log(errorThrown);
            });
        });

        $(document).on('submit','form#vote-form',function(){
            event.preventDefault();
            if (request) {
                request.abort();
            }
            var time = $.now()/1000;
            var dataForm = getFormData($(this));
            var eventID = $(this).closest('.modal').attr('data-eventid');
            var date = new Date();
            var timeOffset = date.getTimezoneOffset();
            time -= (timeOffset*60);
            request = $.ajax({
                url: "../actions/sendVote.php",
                type: "post",
                data: {
                  "form": dataForm,
                  "time": time,
                  "eventid": eventID
                }
            });
            request.done(function (response){
              console.log(response);
            });
            request.fail(function (jqXHR, textStatus, errorThrown){
              alert("Chyba. Prosím, kontaktujte správce.")
              console.log(jqXHR);
              console.log(textStatus);
              console.log(errorThrown);
            });
        });
        function getFormData($form){
          var unindexed_array = $form.serializeArray();
          var indexed_array = {};
          $.map(unindexed_array, function(n, i){
              indexed_array[n['name']] = n['value'];
          });
          return indexed_array;
        }

      });
    </script>
  </body>
</html>
