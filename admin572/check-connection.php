<?php 
session_start();
require_once("../config/app.php");
require_once("../config/database.php");

$loginOK = false;
if(isset($_POST['login']) AND isset($_POST['password']) AND !empty($_POST['login'])  AND !empty($_POST['password'])){
	//récupération des champs login et password
	$login=$_POST['login']; 
	$password=sha1($_POST['password']);

	$stmt = $db_client->prepare("SELECT * FROM user WHERE login=?");
	$stmt->execute(array($login));

	//Vérification de l'existance du user
	if (!empty($stmt)) {
		$row = $stmt->fetch();
		if ($password==$row->password){
			$_SESSION['sessionAdmin']=true;
			$loginOK = true;
		}
	}
}
if ($loginOK) 
	header('Location: connected/');
else 
	header('Location: ./index.php?err=1');
?>