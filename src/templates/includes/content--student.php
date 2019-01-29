<div class="tab-pane fade show active" id="votes-list" role="tabpanel" aria-labelledby="votes-list-tab">
    <?php
    try {
        checkExpiredEvents($mysqli);
        $events = null;
        require(__DIR__ . '/../actions/getEvents.php');
    } catch (Exception $e) {
        echo "Chyba: Nepodařilo se zobrazit dostupné hodnocení. <br>" . $e;
    } finally {
        require(__DIR__ . '/../includes/votes-list.php');
    }
    ?>
</div>

<div class="tab-pane fade" id="my-votes" role="tabpanel" aria-labelledby="my-votes-tab">
    <?php
    require(__DIR__ . '/../includes/my-votes.php');
    ?>
</div>