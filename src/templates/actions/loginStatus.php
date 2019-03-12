<?php
if (isset($_GET['status'])) {
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $parts = parse_url($url);
    $message = '';
    $color = '';
    parse_str($parts['query'], $query);
    switch ($query['status']) {
        case 'loggedAuto':
            $message = "Byl/a jste automaticky přihlášen/a.";
            $color = 'green';
            break;
        case 'loggedIn':
            $message = "Byl/a jste úspěšně přihlášen/a.";
            $color = 'green';
            break;
        case 'userEdited':
            $message = "Uživatel byl úspěšně upraven.";
            $color = 'green';
            break;
        case 'userDeleted':
            $message = "Uživatel byl úspěšně smazán.";
            $color = 'green';
            break;
        case 'logout':
            $message = "Byl/a jste odhlášen/a.";
            $color = 'green';
            break;
        case 'logoutAuto':
            $message = "Byl/a jste automaticky odhlášen/a po 45 minutách neaktivity.";
            $color = 'yellow';
            break;
        case 'loginNeeded':
            $message = "Je potřeba se znovu přihlásit.";
            $color = 'yellow';
            break;
        case 'badVerify':
            $message = "Nesprávný ověřovací kód.";
            $color = 'red';
            break;
        case 'goodVerify':
            $message = "Váš e-mail byl úspěšně ověřen, přihlaste se prosím.";
            $color = 'green';
            break;
        default:
            $message = "Vyskytla se neznámá chyba, kontaktujte prosím správce";
            $color = 'red';
            break;
    }
    ?>
    <script type="text/javascript">
        window.onload = function () {
            showMessage('<?php echo $message; ?>', '<?php echo $color; ?>');
        }
    </script>
    <?php
}
?>
