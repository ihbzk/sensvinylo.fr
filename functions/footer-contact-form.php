<?php

include("functions/mail.php");

if (isset($_POST['pseudo']) && $_POST['pseudo'] != "")
	header("Location: " . $routes['devis-success']);

$form_is_valid = true;
$form_has_errors = false;
$form_is_submitted = false;

$data = array(
	'email' => array('value' => null, 'status' => null, 'regex' => _EMAIL_REGEX_, 'label' => 'E-mail'),
	'phone' => array('value' => null, 'status' => null, 'regex' => _PHONE_REGEX_, 'label' => 'Téléphone'),
	'lastname' => array('value' => null, 'status' => null, 'regex' => _2_CHARS_REGEX_, 'label' => 'Nom'),
	'firstname' => array('value' => null, 'status' => null, 'regex' => _2_CHARS_REGEX_, 'label' => 'Prénom'),
	'message' => array('value' => null, 'status' => null, 'regex' => _2_CHARS_REGEX_, 'label' => 'Message'),
	'rgpd' => array('value' => null, 'status' => null, 'regex' => null, 'label' => 'En utilisant ce formulaire, vous acceptez le stockage et la gestion de vos données par ce site *')
);

if (isset($_POST['lastname'])) {
	$form_is_submitted = true;

	if (!isset($_POST['rgpd']) || $_POST['rgpd'] != "on") {
		$form_is_valid = false;
		$data['rgpd']['status'] = 'has-error';
	} else {
		$rgpd["value"] = true;
	}

	$data['email']['value'] = (isset($_POST['email'])) ? $_POST['email'] : null;
	$data['phone']['value'] = (isset($_POST['phone'])) ? $_POST['phone'] : null;
	$data['lastname']['value'] = (isset($_POST['lastname'])) ? $_POST['lastname'] : null;
	$data['firstname']['value'] = (isset($_POST['firstname'])) ? $_POST['firstname'] : null;
	$data['object']['value'] = (isset($_POST['object'])) ? $_POST['object'] : null;
	$data['message']['value'] = (isset($_POST['message'])) ? preg_replace("/\r\n/", "<br>", $_POST['message']) : null;

	foreach ($data as $key => $field) {
		if (!empty($field['regex'])) {
			if (validate($field['regex'], $field['value'])) {
				$data[$key]['status'] = 'has-success';
			} else {
				$data[$key]['status'] = 'has-error';
				$form_is_valid = false;
			}
		}
	}
	
	if ($form_is_valid) {
		mailContact($data);
		mailConfirmation($data);
		redirectNotification("Votre demande a bien été envoyée ! Notre équipe vous recontactera dès que possible.");
	} else {
		$form_has_errors = true;
	}
}