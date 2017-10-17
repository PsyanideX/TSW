<?php
//file: view/notes/index.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$note = $view->getVariable("note");
$currentuser = $view->getVariable("currentusername");
$view->setVariable("title", "Show note");
?>


    <div>
      <div class="col-xs-12 center-block" id="contenedornotaext">
        <h1 class="colorCabecera"><?=$note->getTitle()?></h1>

        <div class="scrollbar" id="contenedornotaint">
            <p><?=$note->getContent()?></p>
            <div id="ver-nota-entera">
              <a href="index.php?controller=notes&amp;action=edit&amp;id_note=<?=$note->getIdNote()?>" class="glyphicon glyphicon-pencil" title="<?=i18n("Edit note")?>"></a>
              <form method="POST" action="index.php?controller=notes&amp;action=delete" id="delete_note_<?= $note->getIdNote(); ?>" style="display: inline">

        				<input type="hidden" name="id_note" value="<?= $note->getIdNote() ?>">
        				<a href="#" onclick=" if (confirm('<?= i18n("are you sure?")?>'))
                  {
        					   document.getElementById('delete_note_<?= $note->getIdNote() ?>').submit()
        				  }"
        				class="glyphicon glyphicon-trash" title="<?=i18n("Delete note")?>"></a>
        			</form>

              <form method="POST" action="index.php?controller=notes&amp;action=share" id="share_note_<?= $note->getIdNote(); ?>" style="display: inline">

        				<input type="hidden" name="id_note" value="<?= $note->getIdNote() ?>">
        				<a href="#" onclick="shareFunction()"	class="glyphicon glyphicon-share-alt" title="<?=i18n("Share note")?>"></a>
        			</form>

              <form id="popup">
                <input type="text" name="sharedUser" placeholder="<?=i18n("Username")?>">
              </form>

              <script>
                /*$(document).ready(function(){
                  $("#popup").click(function(){
                    if($(this).is(":visible"){
                      $(this).fadeOut();
                    } else {
                      $(this).fadeIn();
                    }
                  });
                });*/
              </script>

            </div>
        </div>
      </div>
    </div>
