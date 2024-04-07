<?php
$id_project = $_GET['id'] + 0;

$image = $image_alt = null;

$stmt = $db_client->prepare("SELECT * FROM project WHERE id=?"); // on prépare notre requête
$stmt->execute(array($id_project));
$projects = $stmt->fetchAll();

$stmt2 = $db_client->prepare("SELECT * FROM project_images WHERE id_project=?"); // on prépare notre requête
$stmt2->execute(array($id_project));
$projectImages = $stmt2->fetchAll();

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
                $stmt = $db_client->prepare("INSERT INTO project_images(id_project,image,image_alt,created_at,updated_at) VALUES (?,?,?,NOW(),NOW())"); // on prépare notre requête
                $stmt->execute(array($id_project, $image, $image_alt));
                header("Location: projects-images-add-" . $id_project);
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

<?php foreach ($projects as $project) : ?>
    <h1 class="no-p">Étape 3 <small><i>(facultatif)</i></small> : <br> Ajout des images pour le projet <strong><?= $project->title ?></strong> <small><i>(étape 3 sur 3)</i></small></h1>
<?php endforeach; ?>
<hr>
<form role='form' method='post' action='#' enctype='multipart/form-data'>
    <div class='row'>
        <div class="carousel-blocs">
            <div class="bloc">
                <div class="form-group" style="width: 90%">
                    <img id="uploadedCoverImage" src="../../assets/img/projets/templates/block1/1.jpg" alt="Cover Image" accept="image/png, image/jpeg" style="display: block" loading="lazy">
                    <div class="bg-black d-b">
                        <label for="image">Image* <small><i>(obligatoire)</i></small></label>
                        <input type="file" id="image" name="image" style="padding: 15px 10px">
                        <label for="image_alt" class="control-label">Description* <small><i>(obligatoire)</i></small></label>
                        <input id="image_alt" name="image_alt" class='form-control w-75' type="text" placeholder="Ex : Atelier Studio SensVinylo..." autofocus>
                    </div><br>
                    <input type='submit' name='submitAjout' class="btn btn-success" value="Validez l'ajout de l'image pour le projet" title="Ajouter une image pour le projet">
                </div>
            </div>
            <div class="bloc" style="flex-direction: column">
                <h2 class="text-left-imp no-p">Images déjà existantes pour le projet</h2>
                <br>
                <a href="projects-images-edit-<?= $id_project ?>" class="btn btn-warning" aria-label='Ajouter une image en plus au projet'>Voir toutes les images du projet</a>
                <br>
                <div class="carousel-blocs">
                    <?php foreach ($projectImages as $projectImage) : ?>
                        <?php if (!empty($projectImage) && $projectImage->youtube_url == null) {
                            echo "
                            <div class='bloc'>
                                <img src='../../$projectImage->image' alt='$projectImage->image_alt' style='object-fit: cover; height: 300px' loading='lazy'><br>
                            </div>";
                        } ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
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
                document.getElementById('uploadedCoverImage').setAttribute('src', event.target.result);
                document.getElementById('uploadedCoverImage').style.display = 'block';
            });
        }
    });
</script>

<hr>
<div class='text-center'>
    <a href="project" type="submit" name='submitAjout' value='Ajouter' class="btn btn-default" aria-label='Terminer'>Terminer</a>
</div>