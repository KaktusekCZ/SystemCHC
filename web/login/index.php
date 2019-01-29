<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: ../admin/?status=loggedAuto");
    die();
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>CHC | Přihlášení</title>
        <link href="http://gulpjs.com/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href="../css/main.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
        <link href="../icons/fontawesome/all.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="login">
            <div class="login__wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <?php
                    include(__DIR__ . '/../actions/loginStatus.php');
                    include (__DIR__ . '/../actions/loginAuto.php')
                    ?>
                            <form class="login__form" id="login">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="username" autocomplete="username" class="form-control login__username" placeholder="Uživatelské jméno" aria-label="Uživatelské jméno" aria-describedby="login_username" required="required">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" autocomplete="current-password" class="form-control login__password" placeholder="Heslo" aria-label="Heslo" aria-describedby="login_password" required="required">
                                </div>
                                <div class="input-group mb-3 rememberme_container">
                                    <input type="checkbox" class="rememberme" id="cbx" name="rememberme" style="display:none" />
                                    <label for="cbx" class="toggle"><span></span></label>
                                    <span class="text">Pamatovat si mě</span>
                                </div>

                                <button type="submit" name="submitButton" class="login__btn btn btn-block py-3">Přihlásit se
                                </button>

                            </form>
                            <a class="noacount" href="../register">
                                Ještě němám účet
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script src="../js/vendor/jquery-3.3.1.min.js"></script>
        <script src="../js/main.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/iziToast.js"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                let request;
                $("#login").submit(function(event)
                {
                    // var elem = $('.js-alert-everything');
                    event.preventDefault();
                    if (request)
                    {
                        request.abort();
                    }
                    let $form = $(this);
                    let $inputs = $form.find("input, select, button, textarea");
                    let serializedData = $form.serialize();
                    $inputs.prop("disabled", true);
                    request = $.ajax(
                    {
                        url: "../actions/login.php",
                        type: "post",
                        data: serializedData
                    });
                    request.done(function(response, textStatus, jqXHR)
                    {
                        console.log(response);
                        switch (response)
                        {
                            case "0":
                                showMessage("Nesprávné uživatelské jméno nebo heslo.", "red");
                                break;
                            case "1":
                                window.location.href = "../admin/?status=loggedIn";
                                break;
                            case "2":
                                showMessage("Prosím, ověřte si Vaši e-mailovou adresu.", "yellow");
                                break;
                            default:
                                showMessage("Vyskytla se neznámá chyba", "red");
                                break;
                        }
                    });
                    request.fail(function(jqXHR, textStatus, errorThrown)
                    {
                        showMessage("Vyskytla se neznámá chyba. Prosím, kontaktujte správce", "red");
                    });
                    request.always(function()
                    {
                        $inputs.prop("disabled", false);
                    });
                });
            });
        </script>
    </body>

</html>