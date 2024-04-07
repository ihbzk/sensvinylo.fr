<?php

$conf_phone = "01 56 06 90 41";
$call_phone = strtolower(str_replace(" ", "", $conf_phone));


$conf_email = "contact@sensvinylo.fr";

$conf_name = "SensVinylo";

$conf_name_website = "sensvinylo.fr";

$conf_line1 = "242 Rue du Faubourg Saint-Antoine";
$conf_zipcode = "75012";
$conf_city = "Paris";
$conf_googleMap = "https://maps.app.goo.gl/ATckNtZqt4qj6UDz8";

$conf_address = "$conf_line1 <br> $conf_zipcode $conf_city";

$conf_instagram = "https://www.instagram.com/sensvinylo/";
$conf_facebook = "https://www.facebook.com/profile.php?id=61558154816957";
$conf_linkedin = "https://www.linkedin.com/company/sensvinylo/";

$conf_companyCapital = "100 000€";
$conf_companyHeadOffice = "85 Avenue Pierre Grenier, 92100 Boulogne-Billancourt";
$conf_companyCity = "RCS Paris";
$conf_companySiret = "531 458 669";
$conf_companyDirector = "Éric Rousseau";

$conf_hostName = "Hostinger International Ltd.";
$conf_hostHeadOffice = "61 Lordou Vironos Street, 6023 Larnaca, Cyprus";

$conf_id_company = 430;

$conf_addressOnline = "http://www." . $conf_name_website . "/";

$dev_environment = ($conf_addressOnline == 'http://' . $_SERVER['SERVER_NAME'] . '/') ? false : true;

if ($dev_environment) {
    $conf_email = "contact@sensvinylo.fr";
    $conf_email_formulaire1 = $conf_email;
}

if ($_SERVER['SERVER_NAME'] == "localhost") {
    $conf_email = "contact@sensvinylo.fr";
}