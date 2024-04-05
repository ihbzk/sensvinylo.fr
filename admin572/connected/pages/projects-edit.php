<?php
$id_project = $_GET['id'];

$stmt = $db_client->prepare("SELECT * FROM project WHERE id=?");
$stmt->execute(array($id_project));
$projects = $stmt->fetch();

$stmt2 = $db_client->prepare("SELECT p.*, category.title as category_title, category.id as category_id
                              FROM project p
                              INNER JOIN project_categories category on p.id_project_category = category.id
                              WHERE p.id=?
                              ORDER BY updated_at DESC");
$stmt2->execute(array($id_project));
$projects = $stmt2->fetchAll();

$stmt3 = $db_client->prepare("SELECT * FROM project_categories ORDER BY created_at DESC"); // on prépare notre requête
$stmt3->execute(array());
$projectCategories = $stmt3->fetchAll();

if (empty($project))
    foreach ($projects as $project) :
        $slug = $project->slug;
        $meta_title = $project->meta_title;
        $meta_description = $project->meta_description;
        $meta_keywords = $project->meta_keywords;
        $coverTitle = $project->cover_title;
        $coverContent = $project->cover_content;
        $coverImage = $project->cover_image;
        $coverImageAlt = $project->cover_image_alt;
        $title = $project->title;
        $content = $project->content;
    endforeach;

if (!empty($_POST)) {
    $slug = $_POST['slug'];
    $slug = remove_accents($slug);
    $slug = str_replace(array(' ', ':', ',', ';', '/', '.', '\'', '---', '--', '\"', '"', ' -', '- '), array('-', '-', '-', '-', '-', '', '-', '-', '-', '-', '-', '-', '-'), $slug);
    $slug = strtolower($slug);
    $slug = rtrim($slug, '-');
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $coverTitle = $_POST['cover_title'];
    $coverContent = $_POST['cover_content'];
    $coverImageAlt = $_POST['cover_image_alt'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    if ($_POST['projectCategory'] != "---") {
        $id_project_category = $_POST['projectCategory'];
    } else {
        $error_projectCategory = true;
    }

    if (!empty($coverTitle) && !empty($title) && !$error_projectCategory) {

        $extension = array("png", "jpg", "webp");

        if ($_FILES['cover_image']['size'] > 0) {
            $dossier = "assets/img/projets/upload/";
            $file_name = $_FILES["cover_image"]["name"];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name = md5(uniqid()) . "." . $ext;
            if (in_array($ext, $extension)) {
                $imageTemp = $dossier . $file_name;

                if (!file_exists($imageTemp)) {
                    $res = move_uploaded_file($_FILES['cover_image']['tmp_name'], "../../" . $imageTemp);
                    if ($res) {
                        unlink("../../" . $imagcoverImagee);
                        $coverImage = $imageTemp;
                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Erreur lors du transfert de l'image. La taille ne doit pas être supérieure à 20 Mo.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Erreur lors du transfert de l'image. La taille ne doit pas être supérieure à 20 Mo.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Veuillez choisir une image avec l'extension '.png' ou '.jpg'.</div>";
            }
        }

        if (!empty($coverImage)) {
            $stmt = $db_client->prepare("UPDATE project SET id_project_category=?,slug=?,meta_title=?,meta_description=?,meta_keywords=?,cover_title=?,cover_content=?,cover_image=?,cover_image_alt=?,title=?,content=?,updated_at=NOW() WHERE id=?");
            $stmt->execute(array($id_project_category, $slug, $meta_title, $meta_description, $meta_keywords, $coverTitle, $coverContent, $coverImage, $coverImageAlt, $title, $content, $id_project));
            header("Location: project");
        } else {
            $stmt = $db_client->prepare("UPDATE project SET id_project_category=?,slug=?,meta_title=?,meta_description=?,meta_keywords=?,cover_title=?,cover_content=?,cover_image_alt=?,slug=?,meta_title=?,meta_description=?,meta_keywords=?,title=?,content=?,updated_at=NOW() WHERE id=?");
            $stmt->execute(array($id_project_category, $slug, $meta_title, $meta_description, $meta_keywords, $coverTitle, $coverContent, $coverImageAlt, $slug, $meta_title, $meta_description, $meta_keywords, $title, $content, $id_project));
            header("Location: project");
        }
    } else {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Le champs auteur et les bloc de texte ne peuvent pas être vide de contenu.</div>";
    }
}
?>

<h1 style="padding-top: 90px">Édition du projet : <br><?= $title ?> <small style="color: #D6FF35; text-decoration: underline"><em>(<a href="project" style="color: #D6FF35; text-decoration: underline"><em>retour</em></a>)</em></small></h1><br>

<div class='text-center'>
    <a href="projects-videos-edit-<?= $id_project ?>" class="btn btn-warning" aria-label='Vidéos'>Vidéos</a>
    <a href="projects-images-edit-<?= $id_project ?>" class="btn btn-warning" aria-label='Images'>Images</a>
</div>

<form role="form" method="post" action="#" enctype="multipart/form-data">
    <h2 class="text-center pb0-pt20">Choix de la production</h2>
    <div class="form-group">
        <label for="title" class="control-label">Type de production* <small><i>(obligatoire)</i></small></label>
        <select name="projectCategory" class="form-control">
            <option>---</option>
            <?php foreach ($projects as $project) : ?>
                <?php foreach ($projectCategories as $projectCategory) : ?>
                    <option value="<?= $projectCategory->id ?>" <?php if ($project->id_project_category == $projectCategory->id) : ?> selected <?php endif; ?>><?= $projectCategory->title ?></option>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </select>
    </div>
    <hr>
    <h2 class="text-center pb0-pt20">Cover</h2>
    <div class="cover-blocs">
        <div class="cover-bloc">
            <?php if (!is_null($coverImage)) : ?>
                <img id="uploadedCoverImage" src="../../<?= $coverImage ?>" alt="Cover Image" accept="image/png, image/jpeg" style="display: block" loading="lazy">
            <?php else : ?>
                <i>Aucune image</i>
            <?php endif ?>
            <div class="bg-black d-b">
                <label for="cover_image">Changer d'image de cover</label>
                <input type="file" id="cover_image" name="cover_image" style="padding: 15px 10px">
                <label for="cover_image_alt" class="control-label">Description* <small><i>(obligatoire)</i></small></label>
                <input id="cover_image_alt" name="cover_image_alt" class='form-control w-75' type="text" placeholder="Ex : Voiture Jaune..." value="<?= $coverImageAlt ?>" autofocus>
            </div>
        </div>
        <div class="cover-bloc">
            <label for="cover_title" class="control-label">Titre de la cover* <small><i>(obligatoire)</i></small></label>
            <input id="cover_title" class='form-control' type="text" name="cover_title" value="<?= $coverTitle ?>" autofocus style="width: 90%; margin-bottom: 30px" placeholder="Ex : Ofenbach - Love Me Now...">
            <label for="cover_content" class="control-label">Contenu de la cover <small><i>(facultatif)</i></small></label>
            <textarea name="cover_content" style="width: 100%" placeholder="Exemple : Direction artistique : Emilie GRUSON, Réalisateur : Fabrice COTON..."><?= $coverContent ?></textarea>
        </div>
    </div>
    <hr>
    <h2 class="text-center pb0-pt20">SEO <small><i>(pour le référencement -> partie gérée par SensVinylo)</i></small></h2>
    <div class="form-group">
        <label for="slug" class="control-label">URL personnalisée du projet* <small><i>(obligatoire)</i></small></label>
        <input id="slug" name="slug" class='form-control' type="text" value="<?= $slug ?>" placeholder="Ex : nom-du-projet..." autofocus>
    </div>
    <div class="form-group">
        <label for="meta_title" class="control-label">Meta Title* <small><i>(obligatoire)</i></small></label>
        <input id="meta_title" name="meta_title" class='form-control' type="text" value="<?= $meta_title ?>" placeholder="Ex : Alpine Manifesto | Modèle inédit..." autofocus>
    </div>
    <div class="form-group">
        <label for="meta_description" class="control-label">Meta Description* <small><i>(obligatoire)</i></small></label>
        <input id="meta_description" name="meta_description" class='form-control' type="text" value="<?= $meta_description ?>" placeholder="Ex : Nous vous proposons les photos de notre dernier shooting photo avec l'équipe..." autofocus>
    </div>
    <div class="form-group">
        <label for="meta_keywords" class="control-label">Meta Keywords* <small><i>(obligatoire)</i></small></label>
        <input id="meta_keywords" name="meta_keywords" class='form-control' type="text" value="<?= $meta_keywords ?>" placeholder="Ex : Projet Alpine Concept Car..." autofocus>
    </div>
    <hr>
    <h2 class="text-center pb0-pt20">Projet</h2>
    <div class="form-group">
        <label for="title" class="control-label">Titre* <small><i>(obligatoire)</i></small></label>
        <input id="title" class='form-control' type="text" name="title" value="<?= $title ?>" placeholder="Ex : Ofenbach - Love Me Now..." autofocus>
    </div>
    <div class="form-group">
        <label for="content" class="control-label">Contenu <small><i>(facultatif)</i></small></label>
        <textarea name="content" placeholder="Ex : Réalisaeur : Amaro ShakeDirector, Chef opérateur: Antoine Carpentier, etc..."><?= $content ?></textarea>
    </div>
    <hr>
    <div class='text-center'>
        <a href="project" class="btn btn-default" aria-label='Annuler'>Annuler</a>
        <button type='submit' name='submitUpdate' class='btn btn-success'>Modifier</button>
    </div>
</form>

<script>
    function addEventListenerToUpload(inputId, imageId) {
        document.getElementById(inputId).addEventListener('change', function() {
            if (this.files[0]) {
                var picture = new FileReader();
                picture.readAsDataURL(this.files[0]);
                picture.addEventListener('load', function(event) {
                    document.getElementById(imageId).setAttribute('src', event.target.result);
                });
            }
        });
    }

    document.getElementById('cover_image').addEventListener('change', function() {
        if (this.files[0]) {
            var picture = new FileReader();
            picture.readAsDataURL(this.files[0]);
            picture.addEventListener('load', function(event) {
                document.getElementById('uploadedCoverImage').setAttribute('src', event.target.result);
                document.getElementById('uploadedCoverImage').style.display = 'block';
            });
        }
    });
</script>