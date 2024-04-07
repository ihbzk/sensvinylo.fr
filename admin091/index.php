<?php session_start(); ?>

<?php

include "../config/app.php";
include "connected/functions/functions.php";

if (!$conf_client_database) {
	header("Location: " . '../404');
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Espace d'administration - <?= $conf_name ?></title>
	<meta name="description" content="Espace d'administration - <?= $conf_name ?>" />
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
	<link rel="icon" href="../img/icons/favicon.png" type="image/x-icon" />
	<meta name="Author" content="<?= $conf_name_website ?>" />
	<link rel="stylesheet" href="<?= asset("../../assets/css/style.css"); ?>">
</head>

<body>
	<div id="navbar">
		<a href="." aria-label="Retour à la page d'accueil">
			<img src="../assets/img/icons/logo-stroke.webp" alt="Logo <?= $conf_name ?>" id="navbar-logo" loading="lazy">
		</a>
		<nav id="navbar-nav">
			<a href="." aria-label="Espace d'administration - <?= $conf_name ?>">Espace d'administration - <?= $conf_name ?></a>
			<a href=".." target="_blank" class="btn" aria-label="Retour sur le site">Retour sur le site /</a>
		</nav>
	</div>
	<section style="height: 100vh">
		<div class="container">
			<div class="text-center">
				<img src="../assets/img/icons/logo-footer.webp" class="img-responsive" alt="Logo login page" loading="lazy">
			</div>
			<div class="center">
				<?php
				if (isset($_GET['err']) and $_GET['err'] == 1)
					echo "<div class='alert alert-danger'>Le login ou le mot de passe est incorrect, merci de réessayer.</div>";
				?>
				<form class="form-horizontal center" style="width: 100%" method="post" action="check-connection.php">
					<div class="form-group" style="width: 45%">
						<label class="control-label" for="login">Identifiant</label>
						<input class="form-control" type="text" id="login" name="login" placeholder='Login' title="login" autofocus>
					</div>
					<div class="form-group" style="width: 45%">
						<label class="control-label" for="password">Mot de passe</label>
						<input class="form-control" type="password" id="password" name="password" placeholder='Mot de passe' title="Mot de passe">
					</div>
					<input type="submit" class="button" name="BoutVal" value="Se connecter">
				</form>
			</div>
		</div>
	</section>
</body>

</html>