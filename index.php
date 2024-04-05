<?php
ob_start();
session_start();

include "functions/functions.php";
include "functions/contact.php";
include "config/company.php";
include "config/router.php";
include "config/database.php";
include "config/app.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title><?= $conf_title ?></title>
    <meta name="description" content="<?= $conf_description ?>">
	<link rel="icon" href="<?= asset("img/icons/favicon.png"); ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?= asset("css/style.css"); ?>">
</head>

<body>
    <?php include_once('sitemap.php'); ?>

    <div id="notification_sandbox">
        <?php printNotification(); ?>
    </div>

    <?php include("modules/navbar.php"); ?>

    <div id="page-wrapper">
        <?php include $page ?>

        <div class="sticky-phone download-pdf">
            <a href="tel:<?= $call_phone ?>"><?= $conf_phone ?></a>
        </div>
    </div>

    <?php include("modules/footer.php"); ?>

    <?php include("js.php"); ?>
</body>

</html>
<?php ob_end_flush(); ?>
<?php $db_client = null; ?>