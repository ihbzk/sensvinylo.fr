<?php

session_start();
ob_start();

include "functions/functions.php";
include "functions/contact.php";
include "config/company.php";
include "config/router.php";
include "config/database.php";
include "config/app.php";

if ($current_route == "project-single") {
    $temp = explode("projet-", $slug);
    $projectSlug = $temp[1];
    
    $stmt = $db_client->prepare("SELECT * FROM project WHERE slug=?");
    $stmt->execute(array($projectSlug));
    $projectMeta = $stmt->fetch();

    if ($projectMeta) {
        $conf_title = $projectMeta->meta_title;
        $conf_description = $projectMeta->meta_description;
    } else {
        $conf_title = "Projet title";
        $conf_description = "Projet description";
    }
}

if ($current_route == "studio-single") {
    $temp = explode("studio-", $slug);
    $studioSlug = $temp[1];
    
    $stmt = $db_client->prepare("SELECT * FROM studios WHERE slug=?");
    $stmt->execute(array($studioSlug));
    $studioMeta = $stmt->fetch();

    if ($studioMeta) {
        $conf_title = $studioMeta->meta_title;
        $conf_description = $studioMeta->meta_description;
    } else {
        $conf_title = "Studio title";
        $conf_description = "Studio description";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title><?= $conf_title ?></title>
    <meta name="description" content="<?= $conf_description ?>">

    <?php $host = $_SERVER['HTTP_HOST']; ?>
    <?php $uri = $_SERVER['REQUEST_URI']; ?>
    <?php $canonical_url = "https://$host$uri"; ?>

    <link rel="canonical" href="<?= $canonical_url ?>">
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
        <?php // if ($current_route == "studio-single" || $current_route == "project-single") : ?>`

        <?php // else : ?>
            <?php include $page ?>
        <?php // endif; ?>

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