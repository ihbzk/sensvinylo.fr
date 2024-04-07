<?php

$is_blocks1 = $is_blocks2 = $idProjectCategory = $coverTitle = $coverContent = $coverImage = $coverImageAlt = $slug = $meta_title = $meta_description = $meta_keywords = $title = $content = null;
$error_projectCategory = false;

$stmt = $db_client->prepare("SELECT category.id categoryId, blocks2.title projectBlocks2Title FROM project blocks2 INNER JOIN project_categories category ON category.id = blocks2.id_project_category ORDER BY blocks2.created_at ASC"); // on prépare notre requête
$stmt->execute();
$projectsBlock2Images = $stmt->fetchAll();

$stmt2 = $db_client->prepare("SELECT * FROM project_categories ORDER BY created_at ASC");
$stmt2->execute();
$projectCategories = $stmt2->fetchAll();

if (!empty($_POST)) {
    $is_blocks1 = $_POST['is_blocks1'];
    $is_blocks2 = $_POST['is_blocks2'];
    $coverTitle = $_POST['cover_title'];
    $coverContent = $_POST['cover_content'];
    $coverImageAlt = $_POST['cover_image_alt'];
    $slug = $_POST['slug'];
    $slug = remove_accents($slug);
    $slug = str_replace(array(' ', ':', ',', ';', '/', '.', '\'', '---', '--', '\"', '"', ' -', '- '), array('-', '-', '-', '-', '-', '', '-', '-', '-', '-', '-', '-', '-'), $slug);
    $slug = strtolower($slug);
    $slug = rtrim($slug, '-');
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    if ($_POST['projectCategory'] != "---") {
        $id_project_category = $_POST['projectCategory'];
    } else {
        $error_projectCategory = true;
    }

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

    if (!empty($coverTitle) && !$error_projectCategory && !empty($title)) {
        if (!empty($coverImage)) {
            $is_blocks1 = 0;
            $is_blocks2 = 1;
            $stmt = $db_client->prepare("INSERT INTO project(is_blocks1, is_blocks2, slug, meta_title, meta_description, meta_keywords, cover_title, cover_content, cover_image, cover_image_alt, id_project_category, title, content, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
            $stmt->execute(array($is_blocks1, $is_blocks2, $slug, $meta_title, $meta_description, $meta_keywords, $coverTitle, $coverContent, $coverImage, $coverImageAlt, $id_project_category, $title, $content));
            $id_project = $db_client->lastInsertId();
            header("Location: projects-videos-add-".$id_project);
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Erreur lors du transfert des images.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Les champs 'Titre' et 'Contenu' doivent être renseignés.</div>";
    }
}
?>

<h1 style="padding-top: 90px">Étape 1 : <br> Ajout d'un projet <small><i>(étape 1 sur 2)</i></small></h1>

<form role="form" method="post" action="#" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Type de production* <small><i>(obligatoire)</i></small></label>
        <select name="projectCategory" class="form-control">
            <option>---</option>
            <?php foreach ($projectCategories as $projectCategory) : ?>
                <option value="<?= $projectCategory->id ?>"><?= $projectCategory->title ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <hr class="mb-130">
    <div class="cover-blocs">
        <div class="cover-bloc cover-img-resp">
            <img id="uploadedCoverImage" src="../../assets/img/projets/templates/cover.png" alt="Cover Image" accept="image/png, image/jpeg" style="display: block" loading="lazy">
            <div class="bg-black d-b">
                <label for="cover_image">Image de la cover* <small><i>(obligatoire)</i></small></label>
                <input type="file" id="cover_image" name="cover_image" style="padding: 15px 10px">
                <label for="cover_image_alt" class="control-label">Description* <small><i>(obligatoire)</i></small></label>
                <input id="cover_image_alt" name="cover_image_alt" class='form-control w-75' type="text" placeholder="Ex : Voiture Jaune..." autofocus>
            </div>
        </div>
        <div class="cover-bloc cover-img-resp2">
            <label for="cover_title">Titre de la cover* <small><i>(obligatoire)</i></small></label>
            <input id="cover_title" class='form-control' type="text" name="cover_title" value="<?= $coverTitle ?>" autofocus style="width: 90%; margin-bottom: 30px" placeholder="Ex : Ofenbach - Love Me Now...">
            <label for="cover_content">Contenu de la cover <small><i>(facultatif)</i></small></label>
            <textarea name="cover_content" style="width: 100%" placeholder="Ex : Réalisaeur : Amaro ShakeDirector, Chef opérateur: Antoine Carpentier, etc..."><?= $coverContent ?></textarea>
        </div>
    </div>
    <hr style="margin-top: 80px">
    <div class="form-group">
        <label for="slug">URL personnalisé du projet* <small><i>(obligatoire)</i></small></label>
        <input id="slug" name="slug" class='form-control' type="text" value="<?= $title ?>" placeholder="Ex : nom-du-projet..." autofocus>
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
    <div class="form-group">
        <label for="title">Titre* <small><i>(obligatoire)</i></small></label>
        <input id="title" class='form-control' type="text" name="title" value="<?= $title ?>" placeholder="Ex : Ofenbach - Love Me Now..." autofocus>
    </div>
    <div class="form-group">
        <label for="content">Contenu <small><i>(facultatif)</i></small></label>
        <textarea name="content" placeholder="Ex : Réalisaeur : Amaro ShakeDirector, Chef opérateur: Antoine Carpentier, etc..."><?= $content ?></textarea>
    </div>
    <hr class="mt-190">
    <div class='text-center'>
        <a href="project" class="btn btn-default"aria-label="Annuler">Annuler</a>
        <button type='submit' name='submitAjout' class='btn btn-success'>Ajouter</button>
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