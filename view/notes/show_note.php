<?php
//file: view/notes/index.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$note = $view->getVariable("note");
$currentuser = $view->getVariable("currentusername");
$view->setVariable("title", "Show note");
?>

  <body class="body-index">
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

              <a href="index.php?controller=notes&amp;action=shareNote&amp;id_note=<?=$note->getIdNote()?>" class="glyphicon glyphicon-share-alt" title="<?=i18n("Share note")?>"></a>
            </div>
        </div>
      </div>
    </div>

  </body>
  </html>
