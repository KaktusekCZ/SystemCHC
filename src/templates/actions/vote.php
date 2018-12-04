<?php
  require(__DIR__.'/connectDB.php');

  $id = $_POST['id'];

  $res = $mysqli->query("SELECT * FROM chc_events WHERE id ='".$id."'");
  $event = $res->fetch_assoc();
  $toReturn =
  '<div class="modal fade vote-modal admin__modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-eventid="'.$id.'">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="alert alert-danger alert-dismissible fade show mx-0 my-0 is-hidden" role="alert">
            Vyskytla se neznámá chyba.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <h1>Hodnocení k <b>'.$event['header'].'</b></h1>
        <form id="vote-form" action="">
        ';
        if($event["satisfy"] == 1){
          $toReturn .= '<label class="admin__modal__label">Spokojenost s hodinou</label>
            <label class="admin__modal__radio"><input type="radio" name="satisfy" value="1"> <span>Velmi spokojen</span></label>
            <label class="admin__modal__radio"><input type="radio" name="satisfy" value="2"> <span>Spíše spokojen</span></label>
            <label class="admin__modal__radio"><input type="radio" name="satisfy" value="3"> <span>Nevím</span></label>
            <label class="admin__modal__radio"><input type="radio" name="satisfy" value="4"> <span>Spíše nespokojen</span></label>
            <label class="admin__modal__radio"><input type="radio" name="satisfy" value="5"> <span>Velmi nespokojen</span></label>';
        }
        if($event["summary"] == 1){
          $toReturn .= '<label class="admin__modal__label">Celkové hodnocení</label>
          <textarea name="summary"></textarea>';
        }
        $toReturn .='
        <button type="submit" class="admin__votes__btn js-admin-vote-submit">Odeslat <i class="fas fa-chevron-right"></i></button>
        </form>
      </div>
    </div>
  </div>';
  echo $toReturn;
?>
