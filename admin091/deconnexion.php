<?php
session_start();

$path_parts = pathinfo($_SERVER['PHP_SELF']);
$page = $path_parts['basename'];
$numDossier = substr($path_parts['dirname'], strlen($path_parts['dirname']) - 3);

$_SESSION = array();

session_destroy();

header("Location: ../admin$numDossier/");