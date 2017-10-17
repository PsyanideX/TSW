<?php
// file: view/layouts/welcome.php
$view = ViewManager::getInstance();
?><!DOCTYPE html>
<html>
<head>
	<title><?= $view->getVariable("title", "no title") ?></title>
	<meta charset="utf-8"></meta>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link href='https://fonts.googleapis.com/css?family=Permanent Marker' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Patrick Hand' rel='stylesheet'>
	<link rel="stylesheet" href="css/style.css"></link>
	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>

<body class="body-login-reg">
	<main>
		<!-- flash message -->
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
