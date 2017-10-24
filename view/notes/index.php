<?php
//file: view/notes/index.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$notes = $view->getVariable("notes");
$sharedNotes = $view->getVariable("sharedNotes");
$currentuser = $view->getVariable("currentusername");
$view->setVariable("title", "Apunta");
?>

    <div class="col-md-12">
      <a class="glyphicon glyphicon-plus" id="nueva-nota" href="index.php?controller=notes&amp;action=add" title="<?=i18n("New note");?>"></a>
    </div>

    <div class="col-md-5 col-sm-10 borde-div-notas">
      <h3><?=i18n("My notes");?></h3>

      <?php foreach ($notes as $note): ?>
        <div class="col-md-5 col-sm-10 formatonota">
          <div class="titulo-nota scrollbar">
            <p ><?= $note->getTitle()?></p>
          </div>
          <div class="ver-nota">
              <a href="index.php?controller=notes&amp;action=showNote&amp;id_note=<?=$note->getIdNote()?>" class="glyphicon glyphicon-eye-open" title="<?=i18n("Show note");?>"></a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>


    <div class="col-md-5 col-sm-10 borde-div-notas">
      <h3><?=i18n("Notes shared with me");?></h3>
      <?php if($sharedNotes != NULL){
        foreach ($sharedNotes as $note): ?>
      <div class="col-md-5 col-sm-10 formatonota">
        <p class="titulo-nota scrollbar"><?= $note->getTitle()?> </p>
        <div class="ver-nota">
          <a href="index.php?controller=notes&amp;action=showNote&amp;id_note=<?=$note->getIdNote()?>" class="glyphicon glyphicon-eye-open" title="<?=i18n("Show note");?>"></a>
        </div>
        <div class="ver-autor">
          <p><?=i18n("Author: ")?><?= $note->getUser()->getAlias()?></p>
        </div>
      </div>
      <?php endforeach;
    }?>
    </div>
