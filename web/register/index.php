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
                <div class="login__loader js-login-loader">
                    <div class="login__loader__inner"></div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <?php
                    include(__DIR__ . '/../actions/loginStatus.php');
                    ?>
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
                                Již mám učet
                            </a>
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
                var request;
                $("#registry").submit(function(event)
                {
                    event.preventDefault();
                    if (userlength())
                    {
                        showMessage("Uživatelské jméno je příliš dlouhé.", "yellow");
                    }
                    else if (getAdressPart($(".teacher__email").val()) != "gmail.com" && getTeacher())
                    {
                        showMessage("Chybný učitelský e-mail.", "red");
                    }
                    else
                    {
                        if (request)
                        {
                            request.abort();
                        }
                        let $form = $(this);
                        let $inputs = $form.find("input, select, button, textarea");
                        let serializedData = $form.serialize();
                        $inputs.prop("disabled", true);
                        $('.js-login-loader').addClass('is-visible');
                        request = $.ajax(
                        {
                            url: "../actions/register.php",
                            type: "post",
                            data: serializedData
                        });
                        request.done(function(response, textStatus, jqXHR)
                        {
                            console.log(response);
                            switch (response)
                            {
                                case "1":
                                    window.location.href = "../admin/?status=loggedIn";
                                    break;
                                case "2":
                                    showMessage("Uživatelské jméno již existuje.", "red");
                                    break;
                                case "3":
                                    showMessage("Zadaná hesla se neshodují.", "yellow");
                                    break;
                                case "4":
                                    showMessage("Učitel byl úspěšně vytvořen, prosím ověřte Váš e-mail", "green");
                                    $("#registry")[0].reset();
                                    break;
                                default:
                                    showMessage("Vyskytla se neznámá chyba. Prosím, kontaktujte správce.", "red");
                            }
                        });
                        request.fail(function(jqXHR, textStatus, errorThrown)
                        {
                            showMessage("Vyskytla se neznámá chyba. Prosím, kontaktujte správce.", "red");
                        });
                        request.always(function()
                        {
                            $inputs.prop("disabled", false);
                            $('.js-login-loader').removeClass('is-visible');
                        });
                    }
                });
            });
        </script>
    </body>

</html>