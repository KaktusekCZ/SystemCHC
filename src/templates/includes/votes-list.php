<div class="admin__votes">
    <?php echo '<h1 class="admin__votes__title">Hodnocení pro '.getAccountGrade($groupRow).'</h1>'?>
    <h2 class="admin__votes__expire"><i class="fas fa-exclamation"></i> Každé hodnocení je dostupné pouze 24 hodin!</h2>
    <ul class="nav nav-tabs" id="votes" role="tablist">
        <li class="nav-item"><a class="nav-link active" id="votesAvailable-tab" data-toggle="tab" href="#votesAvailable" role="tab" aria-controls="votesAvailable" aria-selected="true">Dostupné hodnocení</a></li>
        <li class="nav-item"><a class="nav-link" id="votesFinished-tab" data-toggle="tab" href="#votesFinished" role="tab" aria-controls="votesFinished" aria-selected="false">Expirované hodnocení</a></li>
    </ul>
    <div class="tab-content" id="votesContent">
        <div class="tab-pane fade show active" id="votesAvailable" role="tabpanel" aria-labelledby="votesAvailable-tab">
            <?php
            echo '<div class="admin__votes__item admin__votes__item--header">';
            echo '<div class="admin__votes__content admin__votes__header">Název</div>';
            echo '<div class="admin__votes__content admin__votes__teacher">Učitel</div>';
            echo '<div class="admin__votes__content admin__votes__time">Datum vytvoření</div>';
            echo '</div>';
            for ($i=0; $i < count((array)$events); $i++) {
                if($events[$i]['expired'] == 0){
                    echo '<div class="admin__votes__item" data-eventID="'.$events[$i]['id'].'">';
                    echo '<div class="admin__votes__content admin__votes__header">'.$events[$i]['header'].'</div>';
                    echo '<div class="admin__votes__content admin__votes__teacher">'.getTeacherName($mysqli, $events[$i]["teacherID"]).'</div>';
                    echo '<div class="admin__votes__content admin__votes__time">'.date("d. m. Y G:i", strtotime($events[$i]['created'])).'</div>';
                    echo '<div class="admin__votes__content admin__votes__btn-wrapper"><button type="button" class="admin__votes__btn js-admin-vote">Hodnotit <i class="fas fa-chevron-right"></i></button></div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
        <div class="tab-pane fade" id="votesFinished" role="tabpanel" aria-labelledby="votesFinished-tab">
            <?php
            echo '<div class="admin__votes__item admin__votes__item--header">';
            echo '<div class="admin__votes__content admin__votes__header">Název</div>';
            echo '<div class="admin__votes__content admin__votes__teacher">Učitel</div>';
            echo '<div class="admin__votes__content admin__votes__time">Datum vytvoření</div>';
            echo '</div>';
            for ($i=0; $i < count((array)$events); $i++) {
                if($events[$i]['expired'] == 1){
                    echo '<div class="admin__votes__item">';
                    echo '<div class="admin__votes__content admin__votes__header">'.$events[$i]['header'].'</div>';
                    echo '<div class="admin__votes__content admin__votes__teacher">'.getTeacherName($mysqli, $events[$i]["teacherID"]).'</div>';
                    echo '<div class="admin__votes__content admin__votes__time">'.date("d. m. Y G:i", strtotime($events[$i]['created'])).'</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</div>