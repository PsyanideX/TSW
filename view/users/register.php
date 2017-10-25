<?php
//file: view/users/register.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", "Register");
?>
    <div class="login-reg">
      <div class="container">
        <div class="col-xs-12">
          <h1><?=i18n("Welcome to APUNTA")?></h1>

            <h3><?=i18n("Sign up here!")?></h3>

            <form  action="index.php?controller=users&amp;action=register" method="post">

              <div class="form-group">
                <input type="text" name="name"  class="form-control" placeholder="<?=i18n("Name and surname")?>">
                <?= isset($errors["name"])?i18n($errors["name"]):"" ?><br>
              </div>

              <div class="form-group">
                <input type="text" name="alias"  class="form-control" placeholder="<?=i18n("Username")?>">
                <?= isset($errors["alias"])?i18n($errors["alias"]):"" ?><br>
              </div>

              <div class="form-group">
                <input type="password" name="passwd" class="form-control" placeholder="<?=i18n("Password")?>">
                <?= isset($errors["passwd"])?i18n($errors["passwd"]):"" ?><br>
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-custom btn-lg btn-block btn-login" value="<?=i18n("Sign up")?>">
              </div>

            </form>

            <div class="form-group">
              <a href="index.php?controller=users&amp;action=login" class="btn btn-custom btn-lg btn-block btn-login"><?=i18n("Cancel")?></a>
            </div>

          </div> <!-- /.col-xs-12 -->
        </div> <!-- /.container -->
    </div>
