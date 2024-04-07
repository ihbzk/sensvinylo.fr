<?php
$id_project = $_GET['id'];
$stmt = $db_client->prepare("SELECT * FROM project WHERE id=? ORDER BY updated_at DESC");
$stmt->execute(array($id_project));
$projects = $stmt->fetchAll();

$stmt2 = $db_client->prepare("SELECT * FROM project_images WHERE id_project=? ORDER BY id ASC");
$stmt2->execute(array($id_project));
$projectImages = $stmt2->fetchAll();

if (!empty($_POST)) {

    //Ajout de l'image
    $extension = array("png", "jpg", "webp");

    if ($_FILES['image']['size'] > 0) {
        $dossier = "assets/img/projets/upload/";
        $file_name = $_FILES["image"]["name"];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_name = md5(uniqid()) . "." . $ext;
        if (in_array($ext, $extension)) {
            $imageTemp = $dossier . $file_name;

            if (!file_exists($coverImgTemp)) {
                //Si le fichier existe déjà (peu probable car num aléatoire généré)
                $res = move_uploaded_file($_FILES['image']['tmp_name'], "../../" . $imageTemp);
                if ($res) {
                    //Erreur de transfert (souvent la taille)
                    unlink("../../" . $image);
                    $image = $imageTemp;
                } else {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Erreur lors du transfert du fichier, la taille ne doit pas être supérieur à 20 Mo.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Erreur lors du transfert du fichier, la taille ne doit pas être supérieur à 20 Mo..</div>";
            }
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Veuillez choisir une fichier avec l'exention pdf, doc ou docx</div>";
        }
    }

    if (!empty($image)) {
        $stmt = $db_client->prepare("UPDATE project_images SET id_project=?,image=?,image_alt,updated_at= NOW() WHERE id=?");
        $stmt->execute(array($id_project, $image, $image_alt, $id_project));
        header("Location: projects-images-" . $id_project);
    } else {
        $stmt = $db_client->prepare("UPDATE project_images SET id_project=?,image_alt=?,updated_at= NOW() WHERE id=?"); // on prépare notre requête
        $stmt->execute(array($id_project, $image_alt, $id_project));
        header("Location: projects-images-" . $id_project);
    }
}
?>



<?php foreach ($projects as $project) : ?>
    <h1>Éditer l'image du projet <b>'<?= $project->title ?>'</b></h1>
    <hr><br>
<?php endforeach; ?>

<div class="carousel-blocs">
    <h2 class="text-left-imp no-p">Images du projet <small><i>(ordre d'affichage du premier au dernier)</i></small></h2>
</div>
<br>
<div class='text-center'>
    <a href="projects-images-add-<?= $id_project ?>" class="btn btn-success" aria-label='Ajouter une image en plus au projet'>Ajouter une image en plus au projet</a>
</div>
<br>
<div class="carousel-blocs">
    <?php foreach ($projectImages as $projectImage) : ?>
        <?php if (!empty($projectImage) && $projectImage->youtube_url == null) {
            echo "
                <div class='bloc' style='flex-direction: column'>
                    <img src='../../$projectImage->image' alt='$projectImage->image_alt' style='width: 100%; height: 500px; object-fit: cover' loading='lazy'>
                    <div style='margin: 10px 0'>
                        <a href='projects-single-image-edit-$projectImage->id' class='btn btn-xs btn-warning' title='Editer cette image' aria-label='Editer cette image'>
                            <span>Éditer</span>
                        </a>
                        <a data-bs-toggle='modal' href='#suppr$projectImage->id' class='btn btn-xs btn-danger' title='Supprimer cette image' aria-label='Supprimer cette image'>
                            <span>Supprimer</span>
                        </a>
                    </div><br><br>
                </div>
                <div class='modal fade' id='suppr$projectImage->id'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <button type='button' class='close' data-bs-dismiss='modal' aria-hidden='true'>&times;</button>
                                <h4 class='modal-title'>Supprimer l'image du projet'</b></h4>
                            </div>
                            <div class='modal-body'>
                                Confirmez-vous la suppression de cette image ?
                            </div>
                            <div class='modal-footer'>
                                <form method='post' action='projects-images-delete'>
                                    <input type='hidden' name='id' value='$projectImage->id'>
                                    <a class='btn btn-default' data-bs-dismiss='modal' aria-label='Annuler'>Annuler</a>
                                    <button type='submit' name='formRemove' class='btn btn-danger'>Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            ";
        } ?>
    <?php endforeach; ?>
</div>