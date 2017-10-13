<!DOCTYPE html>

<?php
//file: view/users/register.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
var_dump($errors);
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
          <h1>Bienvenido a APUNTA</h1>

            <h3>Regístrate aquí</h3>

            <form  action="index.php?controller=users&amp;action=register" method="post">

              <div class="form-group">
                <input type="text" name="name"  class="form-control" placeholder="Nombre y apellidos">
              </div>

              <div class="form-group">
                <input type="text" name="alias"  class="form-control" placeholder="Usuario">
              </div>

              <div class="form-group">
                <input type="password" name="passwd" class="form-control" placeholder="Contraseña">
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-custom btn-lg btn-block btn-login" value="Registrarse">
              </div>

            </form>

          </div> <!-- /.col-xs-12 -->
        </div> <!-- /.container -->
    </div>
  </body>
</html>
