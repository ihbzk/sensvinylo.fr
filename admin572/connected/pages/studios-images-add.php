<?php
$id_studio = $_GET['id'] + 0;

$image = $image_alt = null;

$stmt = $db_client->prepare("SELECT * FROM studios WHERE id=?"); // on prépare notre requête
$stmt->execute(array($id_studio));
$studios = $stmt->fetchAll();

$stmt2 = $db_client->prepare("SELECT * FROM studios_images WHERE id_studio=?"); // on prépare notre requête
$stmt2->execute(array($id_studio));
$studioImages = $stmt2->fetchAll();

if (!empty($_POST)) {
    $image_alt = $_POST['image_alt'];

    //Ajout de l'image
    $extension = array("png", "jpg", "svg", "webp");

    if ($_FILES['image']['size'] > 0) {
        $dossier = "assets/img/studios/upload/";
        $file_name = $_FILES["image"]["name"];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_name = md5(uniqid()) . "." . $ext;
        if (in_array($ext, $extension)) {
            $imageTemp = $dossier . $file_name;

            if (!file_exists($imageTemp)) {
                //Si le fichier existe déjà (peu probable car num aléatoire généré)
                $res = move_uploaded_file($_FILES['image']['tmp_name'], "../../" . $imageTemp);
                if ($res) {
                    //Erreur de transfert (souvent la taille)
                    $image = $imageTemp;
                } else {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Erreur lors du transfert de l'image. La taille ne doit pas être supérieure à 20 Mo.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Erreur lors du transfert de l'image. La taille ne doit pas être supérieure à 20 Mo.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Veuillez choisir une image avec l'extension '.png' ou '.jpg'.</div>";
        }
    }

    if (!empty($image_alt)) {
        if (!empty($image)) {
            if (!empty($image)) {
                $stmt = $db_client->prepare("INSERT INTO studios_images(id_studio,image,image_alt,created_at,updated_at) VALUES (?,?,?,NOW(),NOW())"); // on prépare notre requête
                $stmt->execute(array($id_studio, $image, $image_alt));
                header("Location: studios-images-add-" . $id_studio);
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Erreur lors du transfert de l'image.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>L'image doit être renseignée.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Le champs 'Description' doit être renseigné.</div>";
    }
}
?>

<?php foreach ($studios as $studio) : ?>
    <h1 class="no-p">Étape 2 : <br> Ajout des images pour le studio <strong><?= $studio->title ?></strong> <small><i>(étape 2 sur 3)</i></small></h1>
<?php endforeach; ?>
<hr>
<form role='form' method='post' action='#' enctype='multipart/form-data'>
    <div class='row'>
        <div class="carousel-blocs">
            <div class="bloc">
                <div class="form-group" style="width: 90%; display: flex">
                    <img id="uploadedCoverImage" src="../../assets/img/projets/templates/block1/1.jpg" alt="Cover Image" accept="image/png, image/jpeg" style="display: block" loading="lazy">
                    <div class="bg-black d-b">
                        <label for="image">Image* <small><i>(obligatoire)</i></small></label>
                        <input type="file" id="image" name="image" style="padding: 15px 10px">
                        <label for="image_alt" class="control-label">Description* <small><i>(obligatoire)</i></small></label>
                        <input id="image_alt" name="image_alt" class='form-control w-75' type="text" placeholder="Ex : Atelier Studio SensVinylo..." autofocus>
                    </div><br>
                    <input type='submit' name='submitAjout' class="btn btn-success" value="Validez l'ajout de l'image pour le studio" title="Ajouter une image pour le studio">
                </div>
            </div>
            <div class="bloc" style="flex-direction: column">
                <h2 class="text-left-imp no-p">Images déjà existantes pour le studio</h2>
                <br>
                <a href="studios-images-edit-<?= $id_studio ?>" class="btn btn-warning" aria-label='Ajouter une image en plus au studio'>Voir toutes les images du studio</a>
                <br>
                <div class="carousel-blocs">
                    <?php foreach ($studioImages as $studioImage) : ?>
                        <?php if (!empty($studioImage)) {
                            echo "
                            <div class='bloc'>
                                <img src='../../$studioImage->image' alt='$studioImage->image_alt' style='object-fit: cover; height: 300px' loading='lazy'><br>
                            </div>";
                        } else {
                            echo "<p>Aucun bloc details n'a été crée.</p>";
                        } ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</form>

<hr>

<?php foreach ($studios as $studio) : ?>
    <h2 class="no-p">Résumé de la création du studio <strong><?= $studio->title ?></strong> :</h2>
    <br>
    <p class='no-m'><b>Cover :</b></p>
    <br>
    <img src='../../<?= $studio->cover_image ?>' alt='<?= $studio->cover_image_alt ?>' style='width: 25%; heught: 400px; object-fit: cover' loading='lazy'>
    <br><br><br>
    <p class='no-m'><b>Adresse du studio :</b> <?= $studio->address ?> <?= $studio->zipcode ?> <?= $studio->city ?></p>
    <p class='no-m'><b>Numéro de téléphone 1 :</b> <?= $studio->phone1 ?></p>
    <p class='no-m'><b>Numéro de téléphone 2 :</b> <?= (!empty($studio->phone2)) ? "$studio->phone2" : "<p class='no-m'><i>Pas de 2ème numéro de téléphone.</i></p>"; ?></p>
    <br>
<?php endforeach; ?>

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

    document.getElementById('image').addEventListener('change', function() {
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

<hr>
<div class='text-center'>
    <a href="studios" type="submit" name='submitAjout' value='Ajouter' class="btn btn-default" aria-label="Retour à l'accueil">Retour à l'accueil</a>
    <a href="studios-blocks-details-add-<?= $id_studio ?>" type="submit" name='submitAjout' value='Ajouter' class="btn btn-success" aria-label='Ajouter des caractéristiques'>Ajouter des caractéristiques</a>
</div>