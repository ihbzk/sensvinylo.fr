<?php

try {
    $db_forms = new PDO('mysql:host=' . $database[$env]['forms_host'] . ';dbname=' . $database[$env]['forms_database'], $database[$env]['forms_user'], $database[$env]['forms_password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $db_forms->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db_forms->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    print "Erreur de connexion à la base de données !<br>" . $e->getMessage() . "<br/>";
    die();
}
