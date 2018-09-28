<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login/");
  die();
}
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <title>CHC | Administrace</title>
        <link href="http://gulpjs.com/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href="./css/main.css" rel="stylesheet">
        <link href="./bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
        <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="./bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
        <link href="./fonts/fontawesome/all.min.css" rel="stylesheet">
    </head>

    <body>
        <?php
      if (isset($_GET['status'])) {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        if ($query['status'] == 'loggedAuto') {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Byl/a jsi automaticky přihlášen.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                  </button>
                </div>';
        } else if ($query['status'] == 'loggedIn') {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Byl/a jsi úspěšně přihlášen.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                  </button>
                </div>';
        }
      }
    ?>
        <a href="#" class="admin__logout">ODHLÁSIT SE</a>
        <script src="./js/vendor/jquery-3.3.1.min.js"></script>
        <script src="./js/main.js"></script>
        <script src="./bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {});
        </script>
    </body>

</html>