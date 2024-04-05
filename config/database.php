<?php
//Database
$database = array(
                    'dev' => array(
                                    //client database
                                    'client_host'       => 'localhost',
                                    'client_database'   => 'u805515904_sensvinylo',
                                    'client_user'       => 'u805515904_ilyesse',
                                    'client_password'   => 'Ilyesse/1',
                                    //forms database
                                    'forms_host'        => 'localhost',
                                    'forms_database'    => 'db_site',
                                    'forms_user'        => 'db_site',
                                    'forms_password'    => 'db_site',
                    ),

                    'prod' => array(
                                    //client database
                                    'client_host'       => 'localhost',
                                    'client_database'   => 'u805515904_sensvinylo',
                                    'client_user'       => 'u805515904_ilyesse',
                                    'client_password'   => 'Ilyesse/1',
                                    //forms database
                                    'forms_host'        => 'localhost',
                                    'forms_database'    => 'db_site',
                                    'forms_user'        => 'db_site',
                                    'forms_password'    => '',
                    )
);

$env = ($dev_environment)?'dev':'prod';

$conf_client_database = true;

if($conf_client_database)
{
    try{
    
        $db_client = new PDO('mysql:host='.$database[$env]['client_host'].';dbname='.$database[$env]['client_database'],$database[$env]['client_user'],$database[$env]['client_password'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $db_client->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Affichage détaillé des exeptions
        $db_client->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);//Fonctionnement en mode objet

    }catch (PDOException $e) {
        print "Erreur de connexion à la base de données !<br>" . $e->getMessage() . "<br/>";
        die();
    }
}