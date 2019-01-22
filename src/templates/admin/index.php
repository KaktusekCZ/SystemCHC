<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/?status=loginNeeded");
    die();
}
require(__DIR__ . '/../actions/connectDB.php');
require(__DIR__ . '/../actions/logoutAuto.php');
require(__DIR__ . '/../actions/functions.php');

require(__DIR__ . '/../actions/getAccount.php');
require(__DIR__ . '/../actions/getGroup.php');
require(__DIR__ . '/../actions/getEvents.php');
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
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon" sizes="16x16">
</head>
<body>
<div class="admin">
    <div class="row no-gutters">
        <div class="admin__menu col-2">
            <div class="admin__logo">Hodnocení učitelů CHC</div>
            <ul>
                <?php
                if ($accRow["type"] == 1) {
                    require(__DIR__ . '/../includes/menu--student.php');
                } else if ($accRow["type"] == 2) {
                    require(__DIR__ . '/../includes/menu--ucitel.php');
                } else if ($accRow["type"] == 3) {
                    require(__DIR__ . '/../includes/menu--admin.php');
                }
                ?>
            </ul>
        </div>
        <div class="admin__content col-10">
            <?php
            require(__DIR__ . '/../actions/loginStatus.php');
            require(__DIR__ . '/../includes/topbar--default.php');
            require(__DIR__ . '/../includes/votes-list.php');
            require(__DIR__ . '/../includes/my-votes.php');
            ?>

            <div id="modal-space">

            </div>

        </div>
    </div>
</div>
<script src="../js/vendor/jquery-3.3.1.min.js"></script>
<script src="../js/main.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/iziToast.js"></script>
</body>
</html>
