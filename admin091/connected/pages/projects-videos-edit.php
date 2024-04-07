<?php
$id_project = $_GET['id'];
$stmt = $db_client->prepare("SELECT * FROM project WHERE id=? ORDER BY updated_at DESC");
$stmt->execute(array($id_project));
$projects = $stmt->fetchAll();

$stmt2 = $db_client->prepare("SELECT * FROM project_images WHERE id_project=? ORDER BY id ASC");
$stmt2->execute(array($id_project));
$projectVideos = $stmt2->fetchAll();

if (!empty($_POST)) {
    $stmt = $db_client->prepare("UPDATE project_images SET id_project=?,youtube_url=?,updated_at= NOW() WHERE id=?");
    $stmt->execute(array($id_project, $youtube_url, $id_project));
    header("Location: projects-videos-" . $id_project);
}
?>



<?php foreach ($projects as $project) : ?>
    <h1>Éditer la vidéo du projet <b>'<?= $project->title ?>'</b></h1>
    <hr><br>
<?php endforeach; ?>

<div class="carousel-blocs">
    <h2 class="text-left-imp no-p">Vidéos du projet <small><i>(ordre d'affichage du premier au dernier)</i></small></h2>
</div>
<br>
<div class='text-center'>
    <a href="projects-videos-add-<?= $id_project ?>" class="btn btn-success" aria-label='Ajouter une vidéo en plus au projet'>Ajouter une vidéo en plus au projet</a>
</div>
<br>
<div class="carousel-blocs">
    <?php foreach ($projectVideos as $projectVideo) : ?>
        <?php foreach ($projects as $project) : ?>
            <?php if (!empty($projectVideo) && $projectVideo->youtube_url == !null) {
                echo "
                    <div class='bloc' style='flex-direction: column'>
                        <iframe width='100%' height='500px' src='$projectVideo->youtube_url' title='Vidéo du projet $project->title' frameborder='0' allow='accelerometer; clipboard-write; encrypted-media; fullscreen; gyroscope; picture-in-picture' allowfullscreen='allowfullscreen' mozallowfullscreen='mozallowfullscreen' msallowfullscreen='msallowfullscreen' oallowfullscreen='oallowfullscreen' webkitallowfullscreen='webkitallowfullscreen'></iframe>
                        <div style='margin: 10px 0'>
                            <a href='projects-single-video-edit-$projectVideo->id' class='btn btn-xs btn-warning' title='Editer cette vidéo' aria-label='Editer cette vidéo'>
                                <span>Éditer</span>
                            </a>
                            <a data-bs-toggle='modal' href='#suppr$projectVideo->id' class='btn btn-xs btn-danger' title='Supprimer cette vidéo' aria-label='Supprimer cette vidéo'>
                                <span>Supprimer</span>
                            </a>
                        </div><br><br>
                    </div>
                    <div class='modal fade' id='suppr$projectVideo->id'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-bs-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title'>Supprimer la vidéo du projet'</b></h4>
                                </div>
                                <div class='modal-body'>
                                    Confirmez-vous la suppression de cette vidéo ?
                                </div>
                                <div class='modal-footer'>
                                    <form method='post' action='projects-videos-delete'>
                                        <input type='hidden' name='id' value='$projectVideo->id'>
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
    <?php endforeach; ?>
</div>