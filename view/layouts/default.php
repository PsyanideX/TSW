<?php
//file: view/layouts/default.php
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
?><!DOCTYPE html>
<html>
<head>
	<title><?= $view->getVariable("title", "no title") ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<!-- enable ji18n() javascript function to translate inside your scripts -->
	<script src="index.php?controller=language&amp;action=i18njs">
	</script>
	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>
<body>
	<!-- header -->
	<header>
		<h1>Blog</h1>
		<nav id="menu" style="background-color:grey">
			<ul>
				<li><a href="index.php?controller=posts&amp;action=index">Posts</a></li>

				<?php if (isset($currentuser)): ?>
					<li><?= sprintf(i18n("Hello %s"), $currentuser) ?>
						<a 	href="index.php?controller=users&amp;action=logout">(Logout)</a>
					</li>

				<?php else: ?>
					<li><a href="index.php?controller=users&amp;action=login"><?= i18n("Login") ?></a></li>
				<?php endif ?>
			</ul>
		</nav>
	</header>

  <nav class="navbar navbar-inverse" id="navfontcolor">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.html">APUNTA</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text"><span class="glyphicon glyphicon-user"></span> Usuario</p></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>
      </ul>
    </div>
  </nav>

	<main>
		<div id="flash">
			<?= $view->popFlash() ?>
		</div>

		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>

	<footer>
		<?php
		include(__DIR__."/language_select_element.php");
		?>
	</footer>

</body>
</html>
