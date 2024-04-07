<?php
$id_project_categories = $_GET['id'];
$stmt = $db_client->prepare("SELECT * FROM project_categories WHERE id=?");
$stmt->execute(array($id_project_categories));
$projectCategories = $stmt->fetchAll();

if (empty($projectCategory))
    foreach ($projectCategories as $projectCategory) :
        $title = $projectCategory->title;
        $content_1 = $projectCategory->content_1;
        $content_2 = $projectCategory->content_2;
    endforeach;

if (!empty($_POST)) {
    $title = $_POST['title'];
    $content_1 = $_POST['content_1'];
    $content_2 = $_POST['content_2'];

    if (!empty($title) && !empty($content_1)) {
        $stmt = $db_client->prepare("UPDATE project_categories SET title=?, content_1=?, content_2=?, updated_at= NOW() WHERE id=?");
        $stmt->execute(array($title, $content_1, $content_2, $id_project_categories));
        header("Location: project-categories");
    } else {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Le titre et les contenus doivent être renseignés.</div>";
    }
}
?>

<h1 style="padding-top: 90px">Édition de la catégorie de projet : <br><?= $title ?> <small style="color: #D6FF35; text-decoration: underline"><em>(<a href="project" style="color: #D6FF35; text-decoration: underline" aria-label="Retour"><em>retour</em></a>)</em></small></h1>
<form role="form" method="post" action="#" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title" class="control-label">Titre de la catégorie de projet* <small><i>(obligatoire)</i></small></label>
        <input id="title" name="title" class='form-control' type="text" value="<?= $title ?>" placeholder="Ex : Production..." autofocus>
    </div>
    <div class="form-group">
        <label for="content_1" class="control-label">Description 1* <small><i>(obligatoire)</i></small></label>
        <textarea name="content_1" placeholder="Ex : L'art de la production n'est pas de produire mais de créer ce que notre imagination de nous dit de faire..."><?= $content_1 ?></textarea>
    </div>
    <div class="form-group">
        <label for="content_2" class="control-label">Description 2 <small><i>(facultatif)</i></small></label>
        <textarea name="content_2" placeholder="Ex : L'art de la production n'est pas de produire mais de créer ce que notre imagination de nous dit de faire..."><?= $content_2 ?></textarea>
    </div>
    <hr>
    <div class='text-center'>
        <a href="project-categories" class="btn btn-default" aria-label="Annuler">Annuler</a>
        <button type='submit' name='submitUpdate' class='btn btn-success'>Modifier</button>
    </div>
</form>