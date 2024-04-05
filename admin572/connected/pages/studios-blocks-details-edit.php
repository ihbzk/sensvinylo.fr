<?php
$id_studio = $_GET['id'];
$stmt = $db_client->prepare("SELECT * FROM studios WHERE id=? ORDER BY updated_at DESC");
$stmt->execute(array($id_studio));
$studios = $stmt->fetchAll();

$stmt2 = $db_client->prepare("SELECT * FROM studios_blocks_details WHERE id_studio=? ORDER BY updated_at DESC");
$stmt2->execute(array($id_studio));
$blocksDetails = $stmt2->fetchAll();

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
        $stmt = $db_client->prepare("UPDATE studio_blocks_details SET id_studio=?,image=?,image_alt,updated_at= NOW() WHERE id=?");
        $stmt->execute(array($id_studio, $image, $image_alt, $id_studio));
        header("Location: studios-images-" . $id_studio);
    } else {
        $stmt = $db_client->prepare("UPDATE studio_blocks_details SET id_studio=?,image_alt=?,updated_at= NOW() WHERE id=?"); // on prépare notre requête
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
        <?php foreach ($blocksDetails as $blocksDetail) : ?>
            <?php if (!empty($blocksDetail)) {
                echo "
                    <div class='bloc' style='flex-direction: column'>
                        <h3 class='no-p fs-15'>$blocksDetail->title</h3>
                        <div class='no-p-content'>
                            <p>$blocksDetail->content</p>
                        </div>
                        <div style='margin: 10px 0'>
                            <a href='studios-blocks-details-single-edit-$blocksDetail->id' class='btn btn-xs btn-warning' title='Editer ce bloc détail' aria-label='Editer ce bloc détail'>
                                <span class='fa fa-edit fa-fw'></span>
                            </a>
                            <a data-bs-toggle='modal' href='#suppr$blocksDetail->id' class='btn btn-xs btn-danger' title='Supprimer ce bloc détail' aria-label='Supprimer ce bloc détail'>
                                <span class='fa fa-times fa-fw'></span>
                            </a>
                        </div><br><br>
                    </div>
                    <div class='modal fade' id='suppr$blocksDetail->id'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-bs-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title'>Supprimer le bloc détail'</b></h4>
                                </div>
                                <div class='modal-body'>
                                    Confirmez-vous la suppression de ce bloc détail ?
                                </div>
                                <div class='modal-footer'>
                                    <form method='post' action='studios-blocks-details-delete'>
                                        <input type='hidden' name='id' value='$blocksDetail->id'>
                                        <a class='btn btn-default' data-bs-dismiss='modal' aria-label='Annuler'>Annuler</a>
                                        <button type='submit' name='formRemove' class='btn btn-danger'>Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            } else {
                echo "<p>Il n'y a aucun bloc détail.</p>";
            } ?>
        <?php endforeach; ?>
    </div>
</div>
<div class='text-center'>
    <a href="studios-blocks-details-add-<?= $id_studio ?>" class="btn btn-success" aria-label='Ajouter un bloc détails en plus'>Ajouter un bloc détails en plus</a>
</div>