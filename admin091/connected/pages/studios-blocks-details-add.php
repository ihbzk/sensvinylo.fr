<?php
$id_studio = $_GET['id'] + 0;

$title = $content = null;

$stmt = $db_client->prepare("SELECT * FROM studios WHERE id=?"); // on prépare notre requête
$stmt->execute(array($id_studio));
$studios = $stmt->fetchAll();

$stmt2 = $db_client->prepare("SELECT * FROM studios_blocks_details WHERE id_studio=?"); // on prépare notre requête
$stmt2->execute(array($id_studio));
$blocs = $stmt2->fetchAll();

if (!empty($_POST['title']) || !empty($_POST['content'])) {

    if (!empty($_POST['title']) && !empty($_POST['content'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $stmt = $db_client->prepare("INSERT INTO studios_blocks_details(id_studio,title,content,created_at,updated_at) VALUES (?,?,?,NOW(),NOW())"); // on prépare notre requête
        $stmt->execute(array($id_studio, $title, $_POST['content']));
        header("Location: studios-blocks-details-add-" . $id_studio);
    } else {
        echo "<div id='alertDanger' class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Les champs 'Titre' du bloc et son contenu doivent être renseignés.</div>";
    }
}
?>

<?php foreach ($studios as $studio) : ?>
    <h1 class="no-p">Étape 3 : <br> Création des blocs détails du studio <strong><?= $studio->title ?></strong> <small><i>(étape 3 sur 3)</i></small></h1>
<?php endforeach; ?>

<hr>
<form role='form' method='post' action='#' enctype='multipart/form-data'>
    <div class="carousel-blocs">
        <div class="bloc" style="flex-direction: column">
            <div class='form-group' style="width: 90%">
                <label for='title'>Titre de l'élément du bloc détail* <small><i>(obligatoire)</i></small></label>
                <input id='title' name='title' class='form-control' placeholder='Ex : Dimensions...' autofocus type='text'>
            </div>
            <div class="form-group" style="width: 90%">
                <label for='content'>Contenu de l'élément du bloc détail* <small><i>(obligatoire)</i></small></label>
                <textarea id='content' name='content' class='form-control' autofocus type='text' placeholder="Ce studio peut accueillir jusqu'à 150..."></textarea>
            </div>
        </div>
        <div class="bloc" style="flex-direction: column">
            <h2 class="text-left-imp no-p">Blocs details déjà existants pour le studio</h2>
            <br>
            <a href="studios-blocks-details-edit-<?= $id_studio ?>" class="btn btn-warning" aria-label='Ajouter un bloc détails en plus au studio'>Voir tous les blocs détails du studio</a>
            <br>
            <div class="carousel-blocs">
                <?php foreach ($blocs as $bloc) : ?>
                    <?php if (!empty($bloc)) {
                        echo "
                        <div class='w-100'>
                            <h3 class='no-p fs-15' style='margin-block-end: 0'>$bloc->title</h3>
                            <div class='no-p-content' style='padding-bottom: 10px'>$bloc->content</div>
                        </div>";
                    } else {
                        echo "<p>Aucun bloc details n'a été crée.</p>";
                    } ?>
                <?php endforeach; ?>
            </div>
        </div><br>
    </div>
    <input type='submit' name='submitAjout' class="btn btn-primary" value="Validez l'ajout du bloc details" title="Ajouter un bloc details">
    <hr>
    <div class='text-center'>
        <a href="studios" type="submit" name='submitAjout' value='Ajouter' class="btn btn-success" aria-label='Terminer'>Terminer</a>
    </div>
</form>