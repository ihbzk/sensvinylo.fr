<?php
// On appelle la session
session_start();

//Numéro du dossier admin
$path_parts = pathinfo($_SERVER['PHP_SELF']); $page = $path_parts['basename'];
$numDossier = substr($path_parts['dirname'],strlen($path_parts['dirname'])-3);

// On écrase le tableau de session
$_SESSION = array();

// On détruit la session
session_destroy();
header("Location: ../admin$numDossier/");
?>