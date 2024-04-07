<?php

$title = $content_1 = $content_2 = null;

$stmt = $db_client->prepare("SELECT * FROM project_categories"); // on prépare notre requête
$stmt->execute();
$projectCategories = $stmt->fetchAll();

if (!empty($_POST['titleCategory'])) {
    $title = $_POST['titleCategory'];
    $content_1 = $_POST['content_1'];
    $content_2 = $_POST['content_2'];
    
    $stmt = $db_client->prepare("INSERT INTO project_categories(title,content_1,content_2,created_at,updated_at) VALUES (?,?,?,NOW(),NOW())");
    $stmt->execute(array($title,$content_1,$content_2));
    header("Location: project-categories");
}
?>

<h2 class="text-left-imp">Catégories déjà existantes pour les projets</h2>
<?php foreach ($projectCategories as $projectCategory) : ?>
    <h3 class="text-left-imp"><?= $projectCategory->title ?></h3>
<?php endforeach; ?>

<hr>

<form role='form' method='post' action='#' enctype='multipart/form-data'>
    <h2 class="pb0-pt20">Création des catégories pour les projets</h2><br>
    <div class='form-group'>
        <label for='title' class="control-label">Titre de la catégorie* <small><i>(obligatoire)</i></small></label>
        <input id='title' name='titleCategory' placeholder='Ex : Post-production...' autofocus type='text'>
    </div>
    <div class="form-group">
        <label for="content_1" class="control-label">Description 1* <small><i>(obligatoire)</i></small></label>
        <textarea name="content_1" placeholder="Ex : L'art de la production n'est pas de produire mais de créer ce que notre imagination de nous dit de faire..."></textarea>
    </div>
    <div class="form-group">
        <label for="content_2" class="control-label">Description 2 <small><i>(facultatif)</i></small></label>
        <textarea name="content_2" placeholder="Ex : L'art de la production n'est pas de produire mais de créer ce que notre imagination de nous dit de faire..."></textarea>
    </div>
    <hr>
    <div class='text-center'>
        <input type='submit' name='submitAjout' class="btn btn-success" value='Ajouter une catégorie' title="Ajouter une catégorie">
    </div>
</form>