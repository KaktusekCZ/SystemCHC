<?php
session_start();
if (isset($_SESSION['username'])) {
  header("Location: ../?status=loggedAuto");
  die();
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <title>CHC | Přihlášení</title>
        <link href="http://gulpjs.com/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href="../css/main.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
        <link href="../fonts/fontawesome/all.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="login">
            <?php
        if (isset($_GET['status'])) {
          $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          $parts = parse_url($url);
          parse_str($parts['query'], $query);
          if ($query['status'] == 'logout') {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Byl/a jste odhlášen/a.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>';
          }
        }
      ?>
            <div class="login__wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="login__alert alert alert-danger js-alert-wrongLogin" role="alert">
                                <i class="fas fa-times"></i> Nesprávné uživatelské jméno nebo heslo.
                            </div>

                            <div class="login__alert alert alert-warning js-alert-unknown" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> Vyskytla se neznámá chyba. Prosím, kontaktujte správce.
                            </div>

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

                                <button type="submit" name="submitButton" class="login__btn btn btn-block py-3">Přihlásit se</button>

                            </form>

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
                var request;
                $("#login").submit(function(event)
                {
                    event.preventDefault();
                    if (request)
                    {
                        request.abort();
                    }
                    var $form = $(this);
                    var $inputs = $form.find("input, select, button, textarea");
                    var serializedData = $form.serialize();
                    $inputs.prop("disabled", true);
                    request = $.ajax(
                    {
                        url: "login.php",
                        type: "post",
                        data: serializedData
                    });
                    request.done(function(response, textStatus, jqXHR)
                    {
                        if (response == 1)
                        {
                            window.location.href = "../?status=loggedIn";
                        }
                        else if (response == 0)
                        {
                            $('.js-alert-wrongLogin').addClass('login__alert--visible');
                        }
                        else
                        {
                            $('.js-alert-unknown').addClass('login__alert--visible');
                        }
                    });
                    request.fail(function(jqXHR, textStatus, errorThrown)
                    {
                        $('.js-alert-unknown').addClass('login__alert--visible');
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