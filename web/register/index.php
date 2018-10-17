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
        <title>CHC | Registrace</title>
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
                    ?>
                            <div class="login__alert alert alert-danger js-alert-wrongLogin" role="alert">
                                <i class="fas fa-times"></i> Uživatelské jméno již existuje.
                            </div>
                            <div class="login__alert alert alert-danger js-alert-wrongPass" role="alert">
                                <i class="fas fa-times"></i> Zadaná hesla se neshodují.
                            </div>
                            <div class="login__alert alert alert-danger js-alert-longUser" role="alert">
                                <i class="fas fa-times"></i> Uživatelské jméno je příliš dlouhé.
                            </div>
                            <div class="login__alert alert alert-danger js-alert-falseteacher" role="alert">
                                <i class="fas fa-times"></i> Chybný učitelský e-mail.
                            </div>
                            <div class="login__alert alert alert-warning js-alert-unknown" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> Vyskytla se neznámá chyba. Prosím, kontaktujte
                                správce.
                            </div>

                            <form class="registry__form" id="registry">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="username" autocomplete="username" class="form-control registry__username" placeholder="Uživatelské jméno" aria-label="Uživatelské jméno" aria-describedby="registry_username" required="required">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-book"></i></span>
                                    </div>
                                    <input type="text" name="name" autocomplete="name" class="form-control registry__name" placeholder="Vaše jméno" aria-label="Vaše jméno" aria-describedby="registry_name" required="required">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control registry__password" placeholder="Heslo" aria-label="Heslo" aria-describedby="registry_password" required="required">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password_re" class="form-control registry__password" placeholder="Heslo znovu" aria-label="Heslo znovu" aria-describedby="registry_password" required="required">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-circle"></i></span>
                                    </div>
                                    <select name="usertype" class="form-control register__select select_user_registry">
                                        <option value="student">Student</option>
                                        <option value="ucitel">Učitel</option>
                                    </select>
                                </div>
                                <div class="input-group teacher_password mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input type="email" name="email_teacher" class="form-control teacher__email" placeholder="E-mail" aria-label="E-mail" aria-describedby="email_teacher">
                                </div>
                                <div class="input-group mb-3 groupidcontainer">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-bars"></i></span>
                                    </div>
                                    <select name="groupid" class="form-control register__select">
                                        <option value="1">1. VMA</option>
                                        <option value="2">1. GD</option>
                                        <option value="3">1. MT</option>
                                        <option value="4">2. VMA</option>
                                        <option value="5">2. GD</option>
                                        <option value="6">2. MT</option>
                                        <option value="7">3. VMA</option>
                                        <option value="8">3. GD</option>
                                        <option value="9">3. MT</option>
                                        <option value="10">4. VMA</option>
                                        <option value="11">4. GD</option>
                                        <option value="12">4. MT</option>
                                    </select>
                                </div>
                                <button type="submit" name="submitButton" class="login__btn btn btn-block py-3">Registrovat se
                                </button>
                            </form>
                            <a class="noacount" href="../login">
                                Již mám učet.
                            </a>
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
                $("#registry").submit(function(event)
                {
                    event.preventDefault();
                    if ($("input[name=username]").val().length > 16)
                    {
                        $('.js-alert-longUser').addClass('login__alert--visible');
                    }
                    else if (getAdressPart($(".teacher__email").val()) != "creativehill.cz" && getTeacher())
                    {
                        $('.js-alert-falseteacher').addClass('login__alert--visible');
                    }
                    else
                    {
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
                            url: "../actions/register.php",
                            type: "post",
                            data: serializedData
                        });
                        request.done(function(response, textStatus, jqXHR)
                        {
                            switch (response)
                            {
                                case "1":
                                    window.location.href = "../admin/?status=loggedIn";
                                    break;
                                case "2":
                                    $('.js-alert-wrongLogin').addClass('login__alert--visible');
                                    break;
                                case "3":
                                    $('.js-alert-wrongPass').addClass('login__alert--visible');
                                    break;
                                case "4":
                                    $('.js-alert-wrongteacher').addClass('login__alert--visible')
                                default:
                                    console.log(response);
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
                    }
                });
            });
        </script>
    </body>

</html>