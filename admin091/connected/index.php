<?php

ob_start();
session_start();

if (!isset($_SESSION['sessionAdmin']) or !$_SESSION['sessionAdmin']) header('Location: ../index.php?message=4'); //Vérification connexion Admin
include '../../config/app.php';
include 'router.php';
include "../../config/database.php";
include 'functions/page.php';
include "functions/functions.php";
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title><?= $conf_name ?> - Admin</title>
	<meta name="description" content="" />
	<link rel="icon" href="../favicon.ico" type="image/x-icon" />
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
	<meta name="Author" content="sensvinylo.f" />

	<link rel="stylesheet" href="<?= asset("../../../assets/css/style.css"); ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r58/three.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
</head>

<body>
	<header>
		<?php include "navbar.php"; ?>
	</header>

	<section class="section-admin" style="padding-top: 150px">
		<div class="container">
			<?php include $page; ?>
		</div>
	</section>

	<footer style="text-align: center">
		<div id="sensvinylo">
			<i><a href="https://www.sensvinylo.fr/contact" target="_blank" title="Page de contact de l'entreprise SensVinylo" aria-label="Besoin d'aide ?">Besoin d'aide ?</a></i>
		</div>
	</footer>

	<?php include "js.php"; ?>
</body>

</html>

<?php $db_client = null; ?>

<?php ob_end_flush(); ?>