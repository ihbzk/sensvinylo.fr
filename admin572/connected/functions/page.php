<?php 


//Retourne un array de formulaire à afficher
function listTextBloc(){
	global $db_client;
	global $conf_id_company;
	global $page;

	$pageName = substr($page,6,-4);

	//Requete SQL pour lister les blocs
	$stmt=$db_client->prepare("SELECT tb.id as id,content FROM page p INNER JOIN text_bloc AS tb ON tb.page=p.id WHERE p.title=? AND p.id_company=? "); // on prépare notre requête
	$stmt->execute(array($pageName,$conf_id_company));
	$rows=$stmt->fetchAll();

	$blocs=array();
	foreach ($rows as $row)
		$blocs[] = array($row->id,$row->content);

	//Si la requete renvoie une ligne, sinon erreur
	if(!empty($blocs))
		$return = $blocs;
	else {
		$return = null;
		echo "Erreur d'affichage du bloc de texte";
	}

	return $return;
}

//Template d'un formulaire pour édition de contenu
function templateTextBloc($bloc, $num){
	return "
	<h2>Bloc $num</h2>
	<form method='post' action='#message'>
		<input type='hidden' name='id_text_bloc' value='$bloc[0]'>
		<textarea name='content'>$bloc[1]</textarea>
		<br>
		<div class='text-center'>
			<a href='accueil.php' class='btn btn-danger' title='Annuler les modifications' aria-label='Annuler'>Annuler</a>
			<button name='updateBlocText' class='btn btn-success' type='submit' title='Enregistrer les modifications'>Valider</button>
		</div>
	</form>
	<hr>";
}


//Mise à jour du contenu d'un bloc
function updateTextBloc($id,$content){
	global $db_client;
	global $conf_id_company;

	$stmt=$db_client->prepare("SELECT id_company FROM page p INNER JOIN text_bloc AS tb ON tb.page=p.id WHERE tb.id=? "); // on prépare notre requête
	$stmt->execute(array($id));
	$row=$stmt->fetch();

	if($content!='' && $row->id_company==$conf_id_company){
		$stmt=$db_client->prepare("UPDATE text_bloc SET content=? WHERE id=?"); // on prépare notre requête
		$stmt->execute(array($content,$id));
		$code = 1;
	}else
		$code = 0;

	return $code;
}