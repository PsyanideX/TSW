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
              <a href="index.php?controller=notes&amp;action=edit" class="glyphicon glyphicon-pencil" title="<?=i18n("Edit note")?>"></a>
              <a href="index.php?controller=notes&amp;action=delete" class="glyphicon glyphicon-trash" title="<?=i18n("Delete note")?>"></a>
              <a href="index.php?controller=notes&amp;action=shareNote" class="glyphicon glyphicon-share-alt" title="<?=i18n("Share note")?>"></a>
            </div>
        </div>
      </div>
    </div>

  </body>
  </html>
