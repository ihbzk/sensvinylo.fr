<?php
$id_studios = $_GET['id'];
$stmt = $db_client->prepare("SELECT * FROM studios WHERE id=?");
$stmt->execute(array($id_studios));
$studios = $stmt->fetchAll();

if (empty($studio))
    foreach ($studios as $studio) :
        $cover_title = $studio->cover_title;
        $cover_image = $studio->cover_image;
        $cover_image_alt = $studio->cover_image_alt;
        $slug = $studio->slug;
        $meta_title = $studio->meta_title;
        $meta_description = $studio->meta_description;
        $meta_keywords = $studio->meta_keywords;
        $title = $studio->title;
        $address = $studio->address;
        $zipcode = $studio->zipcode;
        $city = $studio->city;
        $phone1 = $studio->phone1;
        $phone2 = $studio->phone2;
        $description = $studio->description;
        $fiche_technique = $studio->fiche_technique;
    endforeach;

if (!empty($_POST)) {
    $cover_title = $_POST['cover_title'];
    $cover_image_alt = $_POST['cover_image_alt'];
    $slug = $_POST['slug'];
    $slug = remove_accents($slug);
    $slug = str_replace(array(' ', ':', ',', ';', '/', '.', '\'', '---', '--', '\"', '"', ' -', '- '), array('-', '-', '-', '-', '-', '', '-', '-', '-', '-', '-', '-', '-'), $slug);
    $slug = strtolower($slug);
    $slug = rtrim($slug, '-');
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $title = $_POST['title'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $city = $_POST['city'];
    $phone1 = $_POST['phone1'];
    $phone2 = $_POST['phone2'];
    $description = $_POST['description'];

    if (!empty($cover_title) && !empty($cover_image_alt) && !empty($title) && !empty($address) && !empty($zipcode) && !empty($city) && !empty($phone1)) {

        $extension = array("png", "jpg", "webp");

        if ($_FILES['cover_image']['size'] > 0) {
            $dossier = "assets/img/studios/upload/";
            $file_name = $_FILES["cover_image"]["name"];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name = md5(uniqid()) . "." . $ext;
            if (in_array($ext, $extension)) {
                $imageTemp = $dossier . $file_name;

                if (!file_exists($imageTemp)) {
                    $res = move_uploaded_file($_FILES['cover_image']['tmp_name'], "../../" . $imageTemp);
                    if ($res) {
                        unlink("../../" . $cover_image);
                        $cover_image = $imageTemp;
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
    
        $extension = "pdf";
    
        if ($_FILES['fiche_technique']['size'] > 0) {
            $dossier = "assets/pdf/studios/upload/";
            $file_name = $_FILES["fiche_technique"]["name"];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name = md5(uniqid()) . "." . $ext;
            if ($ext == $extension) {
                $pdfTemp = $dossier . $file_name;
        
                if (!file_exists($pdfTemp)) {
                    $res = move_uploaded_file($_FILES['fiche_technique']['tmp_name'], "../../" . $pdfTemp);
                    if ($res) {
                        unlink("../../" . $fiche_technique);
                        $fiche_technique = $pdfTemp;
                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Erreur lors du transfert du fichier PDF. La taille ne doit pas être supérieure à 20 Mo.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Erreur lors du transfert du fichier PDF. La taille ne doit pas être supérieure à 20 Mo.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Veuillez choisir un fichier PDF.</div>";
            }
        }

        if(!empty($cover_image) && !empty($fiche_technique)) {
            $stmt = $db_client->prepare("UPDATE studios SET cover_title=?, cover_image=?, cover_image_alt=?, slug=?, meta_title=?, meta_description=?, meta_keywords=?, title=?, address=?, zipcode=?, city=?, phone1=?, phone2=?, description=?, fiche_technique=?, updated_at= NOW() WHERE id=?");
            $stmt->execute(array($cover_title, $cover_image, $cover_image_alt, $slug, $meta_title, $meta_description, $meta_keywords, $title, $address, $zipcode, $city, $phone1, $phone2, $description, $fiche_technique, $id_studios));
            header("Location: studios");
        } else {
            $stmt = $db_client->prepare("UPDATE studios SET cover_title=?, cover_image_alt=?, slug=?, meta_title=?, meta_description=?, meta_keywords=?, title=?, address=?, zipcode=?, city=?, phone1=?, phone2=?, description=?, updated_at= NOW() WHERE id=?");
            $stmt->execute(array($cover_title, $cover_image_alt, $slug, $meta_title, $meta_description, $meta_keywords, $title, $address, $zipcode, $city, $phone1, $phone2, $description, $id_studios));
            header("Location: studios");
        }
    } else {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Le titre et les contenus doivent être renseignés.</div>";
    }
}
?>

<h1 style="padding-top: 90px">Édition du studio : <br><?= $title ?> <small style="color: #D6FF35; text-decoration: underline"><em>(<a href="project" style="color: #D6FF35; text-decoration: underline" aria-label='Retour'><em>retour</em></a>)</em></small></h1><hr><br>
<div class='text-center'>
    <a href="studios-images-edit-<?= $id_studios ?>" class="btn btn-warning" aria-label='Images'>Images</a>
    <a href="studios-blocks-details-edit-<?= $id_studios ?>" class="btn btn-warning" aria-label='Blocs détails'>Blocs détails</a>
</div>
<form role="form" method="post" action="#" enctype="multipart/form-data">
    <h2 class="text-center pb0-pt20">Cover</h2>
    <div class="cover-blocs">
        <div class="cover-bloc">
            <?php if (!is_null($cover_image)) : ?>
                <img id="uploadedCoverImage" src="../../<?= $cover_image ?>" alt="Cover Image" accept="image/png, image/jpeg" style="display: block" loading="lazy">
            <?php else : ?>
                <i>Aucune image</i>
            <?php endif ?>
            <div class="bg-black d-b">
                <label for="cover_image">Changer d'image de cover</label>
                <input type="file" id="cover_image" name="cover_image" style="padding: 15px 10px">
                <label for="cover_image_alt" class="control-label">Description* <small><i>(obligatoire)</i></small></label>
                <input id="cover_image_alt" name="cover_image_alt" class='form-control w-75' type="text" placeholder="Ex : Voiture Jaune..." value="<?= $cover_image_alt ?>" autofocus>
            </div>
        </div>
        <div class="cover-bloc">
            <label for="cover_title" class="control-label">Titre de la cover* <small><i>(obligatoire)</i></small></label>
            <input id="cover_title" class='form-control' type="text" name="cover_title" value="<?= $cover_title ?>" autofocus style="width: 90%; margin-bottom: 30px" placeholder="Ex : Studio SensVinylo...">
        </div>
    </div>
    <hr>
    <h2 class="no-pt">Studio <small><i>(page du studio)</i></small></h2>
    <div class='form-group'>
        <label for='title' class="control-label">Nom du studio* <small><i>(obligatoire)</i></small></label>
        <input id='title' name='title' placeholder='Ex : Studio SensVinylo...' value='<?= $title ?>' autofocus type='text'>
    </div>
    <div class='form-group'>
        <label for='address' class="control-label">Adresse du studio* <small><i>(obligatoire)</i></small></label>
        <input id='address' name='address' placeholder='Ex : 57 rue de Bretagne...' autofocus type='text' value='<?= $address ?>'>
    </div>
    <div class='form-group'>
        <label for='zipcode' class="control-label">Code postal* <small><i>(obligatoire)</i></small></label>
        <input id='zipcode' name='zipcode' placeholder='Ex : 75003...' value='<?= $zipcode ?>' autofocus type='text'>
    </div>
    <div class='form-group'>
        <label for='city' class="control-label">Ville* <small><i>(obligatoire)</i></small></label>
        <input id='city' name='city' placeholder='Ex : Paris...' value='<?= $city ?>' autofocus type='text'>
    </div>
    <div class='form-group'>
        <label for='phone1' class="control-label">Numéro de téléphone* <small><i>(obligatoire)</i></small></label>
        <input id='phone1' name='phone1' placeholder='Ex : 01 42 77 34 19...' value='<?= $phone1 ?>' autofocus type='text'>
    </div>
    <div class='form-group'>
        <label for='phone2' class="control-label">Numéro de téléphone 2 <small><i>(facultatif)</i></small></label>
        <input id='phone2' name='phone2' placeholder='Ex : 07 85 15 31 29...' value='<?= $phone2 ?>' autofocus type='text'>
    </div>
    <div class="form-group">
        <label for="description" class="control-label">Description <small><i>(facultatif)</i></small></label>
        <textarea name="description" placeholder="Ex : Ce studio peut accueillir jusqu'à 150..."><?= $description ?></textarea>
    </div>
    <div class="form-group">
        <label for="fiche_technique">Fiche technique actuelle <small><i>(facultatif) :</i></small></label>
        <?php if (!is_null($fiche_technique)) : ?>
            <?php $pdfName = strtolower(str_replace("assets/pdf/studios/upload/","",$fiche_technique)); ?>
            <i name="fiche_technique" id="fiche_technique"><?= $pdfName ?></i>
        <?php else : ?>
            <i>Aucune fiche technique.</i>
        <?php endif ?><br><br>
        <label for="fiche_technique">Changer de fiche technique</label>
        <input type="file" id="fiche_technique" name="fiche_technique">
    </div>
    <hr>
    <h2 class="no-pt">SEO <small><i>(référencement)</i></small></h2>
    <div class="form-group">
        <label for="slug">URL personnalisée du projet* <small><i>(obligatoire)</i></small></label>
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
    <div class='text-center'>
        <a href="studios" class="btn btn-default" aria-label='Annuler'>Annuler</a>
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
                document.getElementById('uploadedcover_image').setAttribute('src', event.target.result);
                document.getElementById('uploadedcover_image').style.display = 'block';
            });
        }
    });
</script>