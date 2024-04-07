<?php
$id_studio = $_GET['id'];
$stmt = $db_client->prepare("SELECT * FROM studios WHERE id=? ORDER BY updated_at DESC");
$stmt->execute(array($id_studio));
$studios = $stmt->fetchAll();

$stmt2 = $db_client->prepare("SELECT * FROM studios_images WHERE id_studio=? ORDER BY updated_at DESC");
$stmt2->execute(array($id_studio));
$studioImages = $stmt2->fetchAll();

if (!empty($_POST)) {

    //Ajout de l'image
    $extension = array("png", "jpg", "webp");

    if ($_FILES['image']['size'] > 0) {
        $dossier = "assets/img/studios/upload/";
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
        $stmt = $db_client->prepare("UPDATE studio_images SET id_studio=?,image=?,image_alt,updated_at= NOW() WHERE id=?");
        $stmt->execute(array($id_studio, $image, $image_alt, $id_studio));
        header("Location: studios-images-" . $id_studio);
    } else {
        $stmt = $db_client->prepare("UPDATE studio_images SET id_studio=?,image_alt=?,updated_at= NOW() WHERE id=?"); // on prépare notre requête
        $stmt->execute(array($id_studio, $image_alt, $id_studio));
        header("Location: studios-images-" . $id_studio);
    }
}
?>



<?php foreach ($studios as $studio) : ?>
    <h1>Éditer les images du studio <b>'<?= $studio->title ?>'</b></h1>
    <hr><br>
<?php endforeach; ?>

<div class="carousel-blocs">
    <h2 class="text-left-imp no-p">Images du studio</h2>
    <br>
    <div class="carousel-blocs">
        <?php foreach ($studioImages as $studioImage) : ?>
            <?php if (!empty($studioImage)) {
                echo "
                    <div class='bloc' style='flex-direction: column'>
                        <img src='../../$studioImage->image' alt='$studioImage->image_alt' style='width: 100%; height: 500px; object-fit: cover' loading='lazy'>
                        <div style='margin: 10px 0'>
                            <a href='studios-single-image-edit-$studioImage->id' class='btn btn-xs btn-warning' title='Editer cette image' aria-label='Editer cette image'>
                                <span>Éditer</span>
                            </a>
                            <a data-bs-toggle='modal' href='#suppr$studioImage->id' class='btn btn-xs btn-danger' title='Supprimer cette image' aria-label=''>
                                <span>Supprimer</span>
                            </a>
                        </div><br><br>
                    </div>
                    <div class='modal fade' id='suppr$studioImage->id'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-bs-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title'>Supprimer l'image du studio'</b></h4>
                                </div>
                                <div class='modal-body'>
                                    Confirmez-vous la suppression de cette image ?
                                </div>
                                <div class='modal-footer'>
                                    <form method='post' action='studios-images-delete'>
                                        <input type='hidden' name='id' value='$studioImage->id'>
                                        <a class='btn btn-default' data-bs-dismiss='modal' aria-label='Annuler'>Annuler</a>
                                        <button type='submit' name='formRemove' class='btn btn-danger'>Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            } else {
                echo "<p>Il n'y a aucune image.</p>";
            } ?>
        <?php endforeach; ?>
    </div>
</div>
<div class='text-center'>
    <a href="studios-images-add-<?= $id_studio ?>" class="btn btn-success" aria-label='Ajouter une image en plus au studio'>Ajouter une image en plus au studio</a>
</div>