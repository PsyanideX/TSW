<?php
//file: view/users/login.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>
    <div class="login-reg">
      <div class="container">
        <div class="col-xs-12">
          <h1><?=i18n("Welcome to APUNTA")?></h1>
            <form  action="index.php?controller=users&amp;action=login" method="POST">

              <div class="form-group">
                <input type="text" name="alias"  class="form-control" placeholder="<?=i18n("Username")?>">
              </div>

              <div class="form-group">
                <input type="password" name="passwd" class="form-control" placeholder="<?=i18n("Password")?>">
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-custom btn-lg btn-block btn-login" value="<?=i18n("Log in")?>">
              </div>

            </form>

            <div class="form-group">
              <a href="index.php?controller=users&amp;action=register" class="btn btn-custom btn-lg btn-block btn-login"><?=i18n("Sign up")?></a>
            </div>

          </div> <!-- /.col-xs-12 -->
        </div> <!-- /.container -->
    </div>
