<?php
if (isset($_GET['status'])) {
  $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $parts = parse_url($url);
  parse_str($parts['query'], $query);
  if ($query['status'] == 'loggedAuto') {
    echo '<div class="alert alert-success alert-dismissible is-visible alert__topbar fade show mx-0 my-0" role="alert">
            Byl/a jste automaticky přihlášen/a.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>';
  } else if ($query['status'] == 'loggedIn') {
    echo '<div class="alert alert-success alert-dismissible is-visible alert__topbar fade show mx-0 my-0" role="alert">
            Byl/a jste úspěšně přihlášen/a.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>';
  } else if ($query['status'] == 'logout') {
    echo '<div class="alert alert-warning alert-dismissible is-visible alert__topbar fade show" role="alert">
            Byl/a jste odhlášen/a.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>';
  } else if ($query['status'] == 'logoutAuto') {
    echo '<div class="alert alert-warning alert-dismissible is-visible alert__topbar fade show" role="alert">
            Byl/a jste automaticky odhlášen/a po 45 minutách neaktivity.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>';
  } else if ($query['status'] == 'loginNeeded') {
    echo '<div class="alert alert-warning alert-dismissible is-visible alert__topbar fade show" role="alert">
            Pro vstup do administrace je potřeba se přihlásit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>';
  }
}
?>