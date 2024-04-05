<?php
require 'functions/PHPMailer/PHPMailerAutoload.php';

$smtp_server = "smtp.hostinger.com";
$smtp_username = "noreply@sensvinylo.fr";
$smtp_password = "Ilyesse/1";
$smtp_from = "noreply@sensvinylo.fr";

function mailContact($data){
	global $smtp_server;
	global $smtp_username;
	global $smtp_password;
	global $smtp_from;//A AJOUTER
	global $conf_email_copie;
	global $conf_name;
	global $conf_email;
	
	$mail = new PHPMailer;

	$mail->isSMTP();
	$mail->Host = $smtp_server;  							
	$mail->SMTPAuth = true;                               	
	$mail->Username = $smtp_username;                    	
	$mail->Password = $smtp_password;
	$mail->Port = 587;

	//Configuration
	$mail->WordWrap = 50;                                 
	$mail->isHTML(true);                                  
	$mail->CharSet = 'UTF-8';

	$mail->From = $smtp_from;
	$mail->FromName = $conf_name;
	$mail->addAddress($conf_email, $conf_name); 
	$mail->addBCC($conf_email_copie,"SensVinylo");

	$mail->Subject = 'Formulaire de contact - '.$conf_name;
	$bodies = bodyMailContact($data);
	$mail->Body    = $bodies[0];
	$mail->AltBody = $bodies[1];

	if(!$mail->send()) {
		dd("Votre message n'a pas pu nous être transmis. Merci de réessayer, si le problème persiste vous pouvez nous contacter à l'adresse $conf_email");
		dd('Mailer Error: ' . $mail->ErrorInfo);
		exit;
	}
}

function bodyMailContact($data){
	global $conf_addressOnline;
	global $conf_name_website;

	$bodyHTML = "
		<html>
		<head><title>Formulaire de contact</title><meta charset='UTF-8'></head>
		<body style='font-family:Segoe UI,Calibri,Arial,sans-serif;font-size:12px;color:#3d3d3d;'>
		Bonjour,<br><br>
		<p>Le formulaire de contact de votre site internet <a href='$conf_addressOnline'>$conf_name_website</a> vient d'être complété : </p>
		<p>
		<h2 style='margin-bottom:5px;'>Fiche contact</h2>";
	foreach($data as $key => $field)
	{
		//on check si la value est vide (champ facultatif non rempli)
		if(is_null($field['value']) || ($field['value'] == '')){

			if($key == 'subject'){
				$bodyHTML .= "<h2 style='margin-bottom:5px;'>Objet</h2>";
				$bodyHTML .= "Non renseigné<br>";
			}elseif($key == 'message'){
				$bodyHTML .= "<h2 style='margin-bottom:5px;'>Message</h2>";
				$bodyHTML .= "Non renseigné<br>";
			}elseif($key == 'pseudo'){
				//do nothing
			}elseif($key == 'rgpd'){
				//do nothing
			}else{
				$bodyHTML .= $field['label'] . " : Non renseigné<br>";
			}
		}else{
			if($key == 'subject'){
				$bodyHTML .= "<h2 style='margin-bottom:5px;'>Objet</h2>";
				$bodyHTML .= $field['value']."<br>";
			}elseif($key == 'message'){
				$bodyHTML .= "<h2 style='margin-bottom:5px;'>Message</h2>";
				$bodyHTML .= nl2br($field['value'])."\n";
			}else{
				$bodyHTML .= $field['label'] . " : " .$field['value']."<br>";
			}		
		}
	}
	$bodyHTML.="
		</p>
		</body>
		</html>"; 

	$bodyPlain = "Bonjour,\n\nLe formulaire de contact de votre site internet $conf_name_website vient d'être complété :\n\nFiche contact : \n";
	foreach($data as $key => $field)
	{
		//on check si la value est vide (champ facultatif non rempli)
		if(is_null($field['value']) || ($field['value'] == '')){

			if($key == 'subject'){
				$bodyPlain .= "\nObjet\n";
				$bodyPlain .= "Non renseigné\n";
			}elseif($key == 'message'){
				$bodyPlain .= "\nMessage\n";
				$bodyPlain .= "Non renseigné\n";
			}elseif($key == 'pseudo'){
				//do nothing
			}elseif($key == 'rgpd'){
				//do nothing
			}else{
				$bodyHTML .= $field['label'] . " : Non renseigné\n";
			}
		}else{
			if($key == 'subject'){
				$bodyPlain .= "\nObjet\n";
				$bodyPlain .= $field['value']."\n";
			}elseif($key == 'message'){
				$bodyPlain .= "\nMessage\n";
				$bodyPlain .= str_ireplace("<br>", "\r\n", $field['value'])."\n";
			}else{
				$bodyPlain .= $field['label'] . " : " .$field['value']."\n";
			}		
		}
	}
	$bodyPlain .="\n\n\nFiche contact.";

	return array($bodyHTML, $bodyPlain);
}

function mailConfirmation($data){
	global $smtp_server;
	global $smtp_username;
	global $smtp_password;
	global $smtp_from;//A AJOUTER
	global $conf_name;
	global $conf_email;

	$mail = new PHPMailer;

	//SMTP
	$mail->isSMTP();
	$mail->Host = $smtp_server;  							// Specify main and backup server
	$mail->SMTPAuth = true;                               	
	$mail->Username = $smtp_username;                    	
	$mail->Password = $smtp_password;
	$mail->Port = 587; //A AJOUTER  		

	//Configuration email
	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->CharSet = 'UTF-8';

	//Variable (sender, receiver, etc)
	$mail->From = $smtp_from;//A MODIFIER
	$mail->FromName = $conf_name;
	$mail->addAddress($data['email']['value'], $data['lastname']['value']);  

	$mail->Subject = 'Confirmation - '.$conf_name;
	$bodies = bodyMailConfirmation($data);
	$mail->Body    = $bodies[0];
	$mail->AltBody = $bodies[1];

	if(!$mail->send()) {
		echo "Votre message n'a pas pu nous être transmis. Merci de réessayer, si le problème persiste vous pouvez nous contacter à l'adresse $conf_email";
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	}
}

function bodyMailConfirmation($data){
	global $conf_addressOnline;
	global $conf_name_website;
	global $conf_name;

	if(date("H")>=22 AND date("H")<6)
		$dayTime = "nuit";
	else if(date("H")>=6 AND date("H")<16)
		$dayTime = "journée";
	else if(date("H")>=16 AND date("H")<19)
		$dayTime = "fin de journée";
	else
		$dayTime = "soirée";

	$bodyHTML = "
		<html>
		<head><title>Devis site Internet</title><meta charset='UTF-8'></head>
		<body style='font-family:Segoe UI,Calibri,Arial,sans-serif;font-size:12px;color:#3d3d3d;'>
			Bonjour ".$data['lastname']['value'].",<br><br>
			<p>
				Votre demande nous a bien été transmise.<br>
				Notre équipe vous recontactera dans les plus brefs délais, le temps de préparer une réponse adaptée à vos besoins.
			</p>
			<p>Dans l'attente, n'hésitez pas à consulter notre site internet <a href='$conf_addressOnline'>$conf_name_website</a>.</p>
			<br>
			<p>L'équipe de $conf_name vous souhaite une bonne $dayTime.</p>
		</body>
		</html>";

	$bodyPlain = "Bonjour ".$data['lastname']['value'].",\n\nVotre demande nous a bien été transmise.\nNotre équipe vous recontactera dans les plus brefs délais, le temps de préparer une réponse adaptée à vos besoins.\n\nDans l'attente, n'hésitez pas à consulter notre site internet $conf_addressOnline.\n\n\nL'équipe de $conf_name vous souhaite une bonne $dayTime.\n";

	return array($bodyHTML,$bodyPlain);
}

function mailDevis($data){
	global $smtp_server;
	global $smtp_username;
	global $smtp_password;
	global $smtp_from;//A AJOUTER
	global $conf_email_copie;
	global $conf_name;
	global $conf_email;
	
	$mail = new PHPMailer;

	$mail->isSMTP();
	$mail->Host = $smtp_server;  							
	$mail->SMTPAuth = true;                               	
	$mail->Username = $smtp_username;                    	
	$mail->Password = $smtp_password;
	$mail->Port = 587;

	//Configuration
	$mail->WordWrap = 50;                                 
	$mail->isHTML(true);                                  
	$mail->CharSet = 'UTF-8';

	$mail->From = $smtp_from;
	$mail->FromName = $conf_name;
	$mail->addAddress($conf_email, $conf_name); 
	$mail->addBCC($conf_email_copie,"SensVinylo");

	$mail->Subject = 'Formulaire de devis - '.$conf_name;
	$bodies = bodyMailDevis($data);
	$mail->Body    = $bodies[0];
	$mail->AltBody = $bodies[1];

	if(!$mail->send()) {
		dd("Votre message n'a pas pu nous être transmis. Merci de réessayer, si le problème persiste vous pouvez nous contacter à l'adresse $conf_email");
		dd('Mailer Error: ' . $mail->ErrorInfo);
		exit;
	}
}

function bodyMailDevis($data){
	global $conf_addressOnline;
	global $conf_name_website;

	$bodyHTML = "
		<html>
		<head><title>Formulaire de devis</title><meta charset='UTF-8'></head>
		<body style='font-family:Segoe UI,Calibri,Arial,sans-serif;font-size:12px;color:#3d3d3d;'>
		Bonjour,<br><br>
		<p>Le formulaire de devis de votre site internet <a href='$conf_addressOnline'>$conf_name_website</a> vient d'être complété : </p>
		<p>
		<h2 style='margin-bottom:5px;'>Fiche contact</h2>";
	foreach($data as $key => $field)
	{
		//on check si la value est vide (champ facultatif non rempli)
		if(is_null($field['value']) || ($field['value'] == '')){

			if($key == 'subject'){
				$bodyHTML .= "<h2 style='margin-bottom:5px;'>Objet</h2>";
				$bodyHTML .= "Non renseigné<br>";
			}elseif($key == 'message'){
				$bodyHTML .= "<h2 style='margin-bottom:5px;'>Message</h2>";
				$bodyHTML .= "Non renseigné<br>";
			}elseif($key == 'pseudo'){
				//do nothing
			}elseif($key == 'rgpd'){
				//do nothing
			}else{
				$bodyHTML .= $field['label'] . " : Non renseigné<br>";
			}
		}else{
			if($key == 'subject'){
				$bodyHTML .= "<h2 style='margin-bottom:5px;'>Objet</h2>";
				$bodyHTML .= $field['value']."<br>";
			}elseif($key == 'message'){
				$bodyHTML .= "<h2 style='margin-bottom:5px;'>Message</h2>";
				$bodyHTML .= nl2br($field['value'])."\n";
			}else{
				$bodyHTML .= $field['label'] . " : " .$field['value']."<br>";
			}		
		}
	}
	$bodyHTML.="
		</p>
		</body>
		</html>"; 

	$bodyPlain = "Bonjour,\n\nLe formulaire de devis de votre site internet $conf_name_website vient d'être complété :\n\nFiche contact : \n";
	foreach($data as $key => $field)
	{
		//on check si la value est vide (champ facultatif non rempli)
		if(is_null($field['value']) || ($field['value'] == '')){

			if($key == 'subject'){
				$bodyPlain .= "\nObjet\n";
				$bodyPlain .= "Non renseigné\n";
			}elseif($key == 'message'){
				$bodyPlain .= "\nMessage\n";
				$bodyPlain .= "Non renseigné\n";
			}elseif($key == 'pseudo'){
				//do nothing
			}elseif($key == 'rgpd'){
				//do nothing
			}else{
				$bodyHTML .= $field['label'] . " : Non renseigné\n";
			}
		}else{
			if($key == 'subject'){
				$bodyPlain .= "\nObjet\n";
				$bodyPlain .= $field['value']."\n";
			}elseif($key == 'message'){
				$bodyPlain .= "\nMessage\n";
				$bodyPlain .= str_ireplace("<br>", "\r\n", $field['value'])."\n";
			}else{
				$bodyPlain .= $field['label'] . " : " .$field['value']."\n";
			}		
		}
	}
	$bodyPlain .="\n\n\nFiche devis.";

	return array($bodyHTML, $bodyPlain);
}