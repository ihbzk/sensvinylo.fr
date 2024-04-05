<?php

$cover_title = $cover_image = $cover_image_alt = $slug = $meta_title = $meta_description = $meta_keywords = $title = $address = $zipCode = $city = $phone1 = $phone2 = $description = $fiche_technique = null;

$stmt = $db_client->prepare("SELECT * FROM studios"); // on prépare notre requête
$stmt->execute();
$studios = $stmt->fetchAll();

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

    if (!empty($cover_title) && !empty($cover_image_alt) && !empty($title) && !empty($address) && !empty($zipcode) && !empty($city) && !empty($phone1)) {
        if (!empty($cover_image)) {
            $stmt = $db_client->prepare("INSERT INTO studios(cover_title,cover_image,cover_image_alt,slug,meta_title,meta_description,meta_keywords,title,address,zipcode,city,phone1,phone2,description,fiche_technique,created_at,updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW())");
            $stmt->execute(array($cover_title,$cover_image,$cover_image_alt,$slug,$meta_title,$meta_description,$meta_keywords,$title,$address,$zipcode,$city,$phone1,$phone2,$description,$fiche_technique));
			$id_studio = $db_client->lastInsertId();
			header("Location: studios-images-add-".$id_studio);
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Erreur lors du transfert des images.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Les champs 'Titre' et 'Contenu' doivent être renseignés.</div>";
    }
}
?>

<h2 class="text-left-imp">Studios déjà existants :</h2>
<?php foreach ($studios as $studio) : ?>
    <h3 class="text-left-imp">- <?= $studio->title ?></h3>
<?php endforeach; ?>

<hr>

<form role='form' method='post' action='#' enctype='multipart/form-data'>
    <h1 class="no-p">Étape 1 : <br> Création du studio <small><i>(étape 1 sur 3)</i></small></h1>
    <hr class="mb-130">
    <div class="cover-blocs">
        <div class="cover-bloc cover-img-resp">
            <img id="uploadedCoverImage" src="../../assets/img/projets/templates/cover.png" alt="Cover Image" accept="image/png, image/jpeg" style="display: block" loading="lazy">
            <div class="bg-black d-b">
                <label for="cover_image">Image de la cover* <small><i>(obligatoire)</i></small></label>
                <input type="file" id="cover_image" name="cover_image" style="padding: 15px 10px">
                <label for="cover_image_alt" class="control-label">Description* <small><i>(obligatoire)</i></small></label>
                <input id="cover_image_alt" name="cover_image_alt" class='form-control w-75' type="text" placeholder="Ex : Studio spacieux..." autofocus>
            </div>
        </div>
        <div class="cover-bloc cover-img-resp2">
            <label for="cover_title">Titre de la cover* <small><i>(obligatoire)</i></small></label>
            <input id="cover_title" class='form-control' type="text" name="cover_title" value="<?= $cover_title ?>" autofocus style="width: 90%; margin-bottom: 30px" placeholder="Ex : Studio SensVinylo...">
        </div>
    </div>
    <hr style="margin-top: 80px">
    <div class='form-group'>
        <label for='title' class="control-label">Nom du studio* <small><i>(obligatoire)</i></small></label>
        <input id='title' name='title' placeholder='Ex : Studio SensVinylo...' autofocus type='text'>
    </div>
    <div class='form-group'>
        <label for='address' class="control-label">Adresse du studio* <small><i>(obligatoire)</i></small></label>
        <input id='address' name='address' placeholder='Ex : 57 rue de Bretagne...' autofocus type='text'>
    </div>
    <div class='form-group'>
        <label for='zipcode' class="control-label">Code postal* <small><i>(obligatoire)</i></small></label>
        <input id='zipcode' name='zipcode' placeholder='Ex : 75003...' autofocus type='text'>
    </div>
    <div class='form-group'>
        <label for='city' class="control-label">Ville* <small><i>(obligatoire)</i></small></label>
        <input id='city' name='city' placeholder='Ex : Paris...' autofocus type='text'>
    </div>
    <div class='form-group'>
        <label for='phone1' class="control-label">Numéro de téléphone* <small><i>(obligatoire)</i></small></label>
        <input id='phone1' name='phone1' placeholder='Ex : 01 42 77 34 19...' autofocus type='text'>
    </div>
    <div class='form-group'>
        <label for='phone2' class="control-label">Numéro de téléphone 2 <small><i>(facultatif)</i></small></label>
        <input id='phone2' name='phone2' placeholder='Ex : 07 85 15 31 29...' autofocus type='text'>
    </div>
    <div class="form-group">
        <label for='description'>Description* <small><i>(obligatoire)</i></small></label>
        <textarea id='description' name='description' class='form-control' autofocus type='text' placeholder="Ex : Ce studio peut accueillir jusqu'à 150..."></textarea>
    </div>
    <div class="form-group">
        <label for="fiche_technique">Fiche technique <small><i>(facultatif)</i></small></label>
        <input type="file" name="fiche_technique" id="fiche_technique">
    </div>
    <hr>
    <div class="form-group">
        <label for="slug">URL personnalisée du projet* <small><i>(obligatoire)</i></small></label>
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
    <div class='text-center'>
        <input type='submit' name='submitAjout' class="btn btn-success" value='Ajouter un studio' title="Ajouter un studio">
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