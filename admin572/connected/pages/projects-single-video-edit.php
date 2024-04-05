<?php
$idVid = $_GET['id'];
$stmt = $db_client->prepare("SELECT * FROM project_images WHERE id=? ORDER BY updated_at DESC");
$stmt->execute(array($idVid));
$projectVideos = $stmt->fetchAll();

if (empty($projectVideo))
    foreach ($projectVideos as $projectVideo) :
        $youtube_url = $projectVideo->youtube_url;
    endforeach;

if (!empty($_POST)) {
    $youtube_url = $_POST['youtube_url'];

    $stmt = $db_client->prepare("UPDATE project_images SET youtube_url=?, updated_at= NOW() WHERE id=?");
    $stmt->execute(array($youtube_url, $idVid));
    $id_project = $projectVideo->id_project;
    header("Location: projects-videos-edit-" . $id_project);
}
?>

<h1 class="no-pt">Éditer la vidéo du projet</h1>
<hr><br>
<form role="form" method="post" action="#" enctype="multipart/form-data">
    <div class="carousel-blocs" style="flex-direction: column">
        <div class="bloc bg-black" style="flex-direction: column">
            <label for="youtube_url" class="control-label">URL Embed YouTube de la vidéo* <small><i>(obligatoire)</i></small></label><br>
            <input id="youtube_url" name="youtube_url" class='form-control' type="text" value="<?= $youtube_url ?>" placeholder="Ex : https://www.youtube.com/embed/OPFhqvXetAY..." style="width: 100%" autofocus>
        </div>
    </div>
    </div><br>
    <hr>
    <div class='text-center'>
        <a href="project" class="btn btn-warning" aria-label='Annuler'>Annuler</a>
        <button type='submit' name='submitAjout' class='btn btn-success'>Valider</button>
    </div>
</form>