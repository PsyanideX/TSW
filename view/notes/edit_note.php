<?php
//file: view/notes/edit_note.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$note = $view->getVariable("note");
//$currentuser = $view->getVariable("currentusername");
$view->setVariable("title", "Edit Note");
$errors = $view->getVariable("errors");
?>

    <div>
      <div class="col-xs-12" id="crear-nota">
        <h1 class="colorCabecera"><?=i18n("Edit note")?></h1>
        <form  action="index.php?controller=notes&amp;action=edit" method="post">
          <div>
            <input id="areatitulo" name="title" rows="1" cols="80" value="<?= isset($_POST["title"])?$_POST["title"]:$note->getTitle() ?>" >
            <?= isset($errors["title"])?i18n($errors["title"]):"" ?><br>
          </div>
          <div>
            <textarea id="areatexto" name="content"> <?= isset($_POST["content"])?htmlentities($_POST["content"]):htmlentities($note->getContent()) ?></textarea>
            <?= isset($errors["content"])?i18n($errors["content"]):"" ?><br>
          </div>
          <div>
            <input type="hidden" name="id_note" value="<?= $note->getIdNote() ?>">
            <input type="submit" name="submit" class="btn btn-success boton-nota" value="<?=i18n("Edit")?>">
            <a href="index.php?controller=notes&amp;action=index" class="btn btn-success boton-nota"><?=i18n("Cancel")?></a>
          </div>
      </div>
    </div>
