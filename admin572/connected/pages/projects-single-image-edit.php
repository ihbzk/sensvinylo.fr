<?php
$idImg = $_GET['id'];
$stmt = $db_client->prepare("SELECT * FROM project_images WHERE id=? ORDER BY updated_at DESC");
$stmt->execute(array($idImg));
$projectImages = $stmt->fetchAll();

if (empty($projectImage))
    foreach ($projectImages as $projectImage) :
        $image = $projectImage->image;
        $image_alt = $projectImage->image_alt;
    endforeach;

if (!empty($_POST)) {
    $image_alt = $_POST['image_alt'];

    //Ajout de l'image
    $extension = array("png", "jpg", "webp");

    if ($_FILES['image']['size'] > 0) {
        $dossier = "assets/img/projets/upload/";
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
                    unlink("../../" . $image);
                    $image = $imageTemp;
                } else {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Erreur lors du transfert du fichier, la taille ne doit pas être supérieur à 20 Mo.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Erreur lors du transfert du fichier, la taille ne doit pas être supérieur à 20 Mo..</div>";
            }
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Veuillez choisir une fichier avec l'exention pdf, doc ou docx</div>";
        }
    }

    if (!empty($image)) {
        $stmt = $db_client->prepare("UPDATE project_images SET image=?, image_alt=?, updated_at= NOW() WHERE id=?");
        $stmt->execute(array($image, $image_alt, $idImg));
        $id_project = $projectImage->id_project;
        header("Location: projects-images-edit-" . $id_project);
    }
}
?>

<h1 class="no-pt">Éditer l'image du projet</h1>
<hr><br>
<form role="form" method="post" action="#" enctype="multipart/form-data">
    <div class="carousel-blocs" style="flex-direction: column">
        <div class="bloc bg-black" style="flex-direction: column">
            <label for="image">Changer d'image </label>
            <input type="file" id="image" name="image" onchange="readURL(this);" style="padding: 15px 10px">
            <?php if (!is_null($image)) : ?>
                <img id="uploadedImage" src="../../<?= $image ?>" alt="Uploaded Image" accept="image/png, image/jpeg" style="display: block; width: 100%" loading="lazy">
            <?php else : ?>
                <i>Aucune image</i>
            <?php endif ?><br><br>
            <label for="image_alt" class="control-label">Description* <small><i>(obligatoire)</i></small></label><br>
            <input id="image_alt" name="image_alt" class='form-control' type="text" value="<?= $image_alt ?>" placeholder="Ex : Voiture Jaune..." style="width: 100%" autofocus>
        </div>
    </div>
    </div><br>
    <hr>
    <div class='text-center'>
        <a href="project" class="btn btn-warning" aria-label='Annuler'>Annuler</a>
        <button type='submit' name='submitAjout' class='btn btn-success'>Valider</button>
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

    document.getElementById('image').addEventListener('change', function() {
        if (this.files[0]) {
            var picture = new FileReader();
            picture.readAsDataURL(this.files[0]);
            picture.addEventListener('load', function(event) {
                document.getElementById('uploadedImage').setAttribute('src', event.target.result);
                document.getElementById('uploadedImage').style.display = 'block';
            });
        }
    });
</script>