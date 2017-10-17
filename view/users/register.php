

<?php
//file: view/users/register.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", "Register");
?>

<html>
  <head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link href='https://fonts.googleapis.com/css?family=Permanent Marker' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Patrick Hand' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/style.css"></link>
    <meta charset="utf-8"></meta>
    <title>Apunta</title>
  </head>
 <body class="body-login-reg">

    <div class="login-reg">
      <div class="container">
        <div class="col-xs-12">
          <h1><?=i18n("Welcome to APUNTA")?></h1>

            <h3><?=i18n("Sign up here!")?></h3>

            <form  action="index.php?controller=users&amp;action=register" method="post">

              <div class="form-group">
                <input type="text" name="name"  class="form-control" placeholder="<?=i18n("Name and surname")?>">
              </div>

              <div class="form-group">
                <input type="text" name="alias"  class="form-control" placeholder="<?=i18n("Username")?>">
              </div>

              <div class="form-group">
                <input type="password" name="passwd" class="form-control" placeholder="<?=i18n("Password")?>">
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-custom btn-lg btn-block btn-login" value="<?=i18n("Sign up")?>">
              </div>

            </form>

          </div> <!-- /.col-xs-12 -->
        </div> <!-- /.container -->
    </div>
  </body>
</html>
