<!DOCTYPE html>
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
  <body class="body-index">
    <div>
      <div class="col-xs-12" id="crear-nota">
        <h1 class="colorCabecera">Nueva nota</h1>
        <form  action="add" method="post">
        <div>
          <textarea id="areatitulo" name="title" rows="1" cols="80" placeholder="Título"></textarea>
        </div>
        <div>
          <textarea id="areatexto" name="content" placeholder="Descripción"></textarea>
        </div>
        <div>
          <!--<a class="btn btn-success boton-nota">Crear</a>-->
          <input type="submit" class="btn btn-success boton-nota" value="Crear">
          <a href="index.php" class="btn btn-success boton-nota">Cancel </a>
        </div>
      </div>
    </div>

  </body>
  </html>
