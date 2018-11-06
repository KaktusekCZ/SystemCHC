<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/?status=loginNeeded");
    die();
}

require(__DIR__ . '/../actions/connectDB.php');
require(__DIR__ . '/../actions/logoutAuto.php');
require(__DIR__ . '/../actions/functions.php');

$res = $mysqli->query("SELECT * FROM chc_users WHERE username ='" . $_SESSION["username"] . "'");
$row = $res->fetch_assoc();
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
                        <?php if ($row["type"] == 1) : ?>
                        <a href="#">
                            <li class="active"><span>Souhrn</span><i class="fas fa-list-ul"></i></li>
                        </a>
                        <a href="#">
                            <li><span>Nové hodnocení</span><i class="fas fa-plus"></i></li>
                        </a>
                        <?php elseif ($row["type"] == 2) : ?>
                        <div class="aaa">
                            Menu Ucitele
                        </div>
                        <?php elseif ($row["type"] == 3) : ?>
                        <div class="aaa">
                            Menu Admina
                        </div>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="admin__content col-10">
                    <?php
            include(__DIR__ . '/../actions/loginStatus.php');
            ?>
                    <div class="admin__bar">
                        <div class="admin__bar__status">
                            <div class="admin__bar__item admin__bar__item--type"><span><i class="fas fa-user"></i> Typ účtu</span>
                                <?php getAccountType($row["type"]); ?>
                            </div>
                            <div class="admin__bar__item admin__bar__item--name"><span><i class="fas fa-check"></i> Přihlášen</span>
                                <?php echo $row["name"] ?>
                            </div>
                            <div class="admin__bar__item admin__bar__item--logout js-admin-logout">Odhlásit se <i class="fas fa-sign-out-alt"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/vendor/jquery-3.3.1.min.js"></script>
        <script src="../js/main.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $(".modal").modal('show');
                var request;
                $(".js-admin-logout").on('click', function(event)
                {
                    event.preventDefault();
                    if (request)
                    {
                        request.abort();
                    }
                    request = $.ajax(
                    {
                        url: "../actions/logout.php",
                        type: "post",
                    });
                    request.done(function(response)
                    {
                        if (response == 1)
                        {
                            window.location.href = "../login/?status=logout";
                        }
                        else
                        {
                            alert('chyba');
                        }
                    });
                });
            });
        </script>
    </body>

</html>