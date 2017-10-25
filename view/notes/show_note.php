<?php
//file: view/notes/index.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$note = $view->getVariable("note");
$currentuser = $view->getVariable("currentusername");
$sharedusers = $view->getVariable("sharedUsers");

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

              <?php
                if (isset($currentuser) && $currentuser == $note->getUser()->getAlias()): ?>

                <form class="share_note" id="share_note_<?= $note->getIdNote(); ?>" style="display: inline">
          				<a href="#" class="glyphicon glyphicon-share-alt" title="<?=i18n("Share note")?>"></a>
          			</form>

                <form class="info_note" id="info_note_<?= $note->getIdNote(); ?>" style="display: inline">
          				<a href="#" class="glyphicon glyphicon-info-sign" title="<?=i18n("Shared with")?>"></a>
          			</form>

                <form id="popup" method="POST" action="index.php?controller=notes&amp;action=share">
                  <input type="hidden" name="id_note" value="<?= $note->getIdNote() ?>">
                  <input type="text" name="sharedUser" placeholder="<?=i18n("Username")?>">
                  <input type="submit" name="submit" value="<?=i18n("Share note")?>">
                </form>

                <div id="sharedwith">
                  <table>
                    <tr>
                      <th><?=i18n("Shared with:")?></th>
                    </tr>
                    <tr>
                      <?php foreach ($sharedusers as $user): ?>
                      <td><?=$user["alias"];?></td>
                      <td><a href="index.php?controller=notes&amp;action=unshareNote&amp;id_note=<?=$note->getIdNote()?>&amp;userShared=<?=$user["alias"]?>" class="	glyphicon glyphicon-remove" title="<?=i18n("Unshare note")?>"></a></td>
                    </tr>

                  <?php endforeach; ?>
                </table>
                </div>

              <?php elseif (isset($currentuser) && $currentuser != $note->getUser()->getAlias()): ?>
                <div class="ver-autor">
                  <p><?=i18n("Author: ")?><?= $note->getUser()->getAlias()?></p>
                </div>
              <?php endif; ?>

            </div>
        </div>
      </div>
    </div>
