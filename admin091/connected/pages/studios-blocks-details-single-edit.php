<?php
$idBlockDetails = $_GET['id'];
$stmt = $db_client->prepare("SELECT * FROM studios_blocks_details WHERE id=? ORDER BY updated_at DESC");
$stmt->execute(array($idBlockDetails));
$blockDetails = $stmt->fetchAll();

if (empty($blockDetail))
    foreach ($blockDetails as $blockDetail) :
        $title = $blockDetail->title;
        $content = $blockDetail->content;
    endforeach;

if (!empty($_POST)) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (!empty($title) && !empty($content)) {
        $stmt = $db_client->prepare("UPDATE studios_blocks_details SET title=?, content=?, updated_at= NOW() WHERE id=?");
        $stmt->execute(array($title, $content, $idBlockDetails));
        $id_studio = $blockDetail->id_studio;
        header("Location: studios-blocks-details-edit-" . $id_studio);
    }
}
?>

<h1 class="no-pt">Éditer le bloc détails</h1>
<hr><br>
<form role="form" method="post" action="#" enctype="multipart/form-data">
    <div class="cover-bloc">
        <label for="title" class="control-label">Titre* <small><i>(obligatoire)</i></small></label>
        <input id="title" class='form-control' type="text" name="title" value="<?= $title ?>" autofocus style="width: 90%; margin-bottom: 30px" placeholder="Ex : Ofenbach - Love Me Now...">
        <label for="content" class="control-label">Contenu* <small><i>(obligatoire)</i></small></label>
        <textarea name="content" style="width: 100%"><?= $content ?></textarea>
    </div>
    <hr>
    <div class='text-center'>
        <a href="studios" class="btn btn-warning" aria-label='Annuler'>Annuler</a>
        <button type='submit' name='submitAjout' class='btn btn-success'>Valider</button>
    </div>
</form>