<?php
$id_project = $_GET['id'] + 0;

$youtube_url = null;

$stmt = $db_client->prepare("SELECT * FROM project WHERE id=?"); // on prépare notre requête
$stmt->execute(array($id_project));
$projects = $stmt->fetchAll();

$stmt2 = $db_client->prepare("SELECT * FROM project_images WHERE id_project=? ORDER BY id DESC"); // on prépare notre requête
$stmt2->execute(array($id_project));
$projectVideos = $stmt2->fetchAll();

if (!empty($_POST)) {
    $youtube_url = $_POST['youtube_url'];

    $stmt = $db_client->prepare("INSERT INTO project_images(id_project,youtube_url,created_at,updated_at) VALUES (?,?,NOW(),NOW())"); // on prépare notre requête
    $stmt->execute(array($id_project, $youtube_url));
    header("Location: projects-videos-add-" . $id_project);
}
?>

<?php foreach ($projects as $project) : ?>
    <h1 class="no-p">Étape 2 <small><i>(facultatif)</i></small> : <br> Ajout des vidéos pour le projet <strong><?= $project->title ?></strong> <small><i>(étape 2 sur 3)</i></small></h1>
<?php endforeach; ?>
<hr>
<form role='form' method='post' action='#' enctype='multipart/form-data'>
    <div class='row'>
        <div class="carousel-blocs">
            <div class="bloc">
                <div class="form-group" style="width: 90%">
                    <div class="bg-black d-b">
                        <label for="youtube_url" class="control-label">URL Embed YouTube de la vidéo* <small><i>(obligatoire)</i></small></label>
                        <input id="youtube_url" name="youtube_url" style="width: 100%" class='form-control w-75' type="text" placeholder="Ex : https://www.youtube.com/embed/OPFhqvXetAY..." autofocus>
                    </div><br>
                    <input type='submit' name='submitAjout' class="btn btn-success" value="Validez l'ajout de la vidéo pour le projet" title="Ajouter une vidéo pour le projet">
                </div>
            </div>
            <div class="bloc" style="flex-direction: column">
                <h2 class="text-left-imp no-p">Vidéos déjà existantes pour le projet</h2>
                <br>
                <a href="projects-videos-edit-<?= $id_project ?>" class="btn btn-warning" aria-label='Ajouter une vidéo en plus au projet'>Voir toutes les vidéos du projet</a>
                <br>
                <div class="carousel-blocs">
                    <?php foreach ($projectVideos as $projectVideo) : ?>
                        <?php if (!empty($projectVideo) && $projectVideo->youtube_url == !null): ?>
                            <div class='bloc'>
                                <iframe width="100%" height="300px" src="<?= $projectVideo->youtube_url ?>" title="Vidéo du projet <?= $projects->title ?>" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; fullscreen; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen"></iframe>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</form>

<hr>
<div class='text-center'>
    <a href="projects-images-add-<?= $id_project ?>" type="submit" name='submitAjout' value='Ajouter' class="btn btn-success" aria-label='Ajouter des images'>Ajouter des images</a>
</div>