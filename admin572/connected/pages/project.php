<h1>Projets</h1>
<a href="choose-template-project" class="btn btn-sm btn-add" aria-label="Ajouter"><i class="fa-solid fa-plus"></i>Ajouter</a>
<hr>
<?php
// Projets
$stmt = $db_client->prepare("SELECT * FROM project ORDER BY updated_at DESC");
$stmt->execute();
$projects = $stmt->fetchAll();

// Images projets
$stmt4 = $db_client->prepare("SELECT * FROM project_images ORDER BY updated_at DESC");
$stmt4->execute();
$projectImages = $stmt4->fetchAll();

// Catégories projets
$stmt5 = $db_client->prepare("SELECT * FROM project_categories ORDER BY updated_at DESC");
$stmt5->execute();
$projectCategories = $stmt5->fetchAll();

if (!empty($projects)) :
    foreach ($projects as $project) { ?>
        <!-- Modal de suppression -->
        <div class='modal fade' id="suppr<?= $project->id ?>">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-bs-dismiss='modal' aria-hidden='true'>&times;</button>
                        <h4 class='modal-title'>Suppression d'un projet</h4>
                    </div>
                    <div class='modal-body'>
                        Confirmez-vous la suppression du projet <b><?= $project->title ?></b> ?
                    </div>
                    <div class='modal-footer'>
                        <form method='post' action='projects-delete'>
                            <input type='hidden' name='id' value='<?= $project->id ?>'>
                            <a class='btn btn-default' data-bs-dismiss='modal' aria-label="Annuler">Annuler</a>
                            <button type='submit' name='formRemove' class='btn btn-danger'>Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal de détail -->
        <div class="modal fade" id="desc<?= $project->id ?>">
            <div class='modal-dialog modal-lg'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-bs-dismiss='modal' aria-hidden='true'>&times;</button>
                        <p class='modal-title'>Contenu du projet</p>
                    </div>
                    <div class='modal-body'>
                        <h2 class="text-center pb0-pt20">Cover</h2>
                        <div class="cover-blocs">
                            <div class="cover-bloc cover-img-resp">
                                <img src="../../<?= $project->cover_image ?>" alt="<?= $project->cover_image_alt ?>" loading="lazy">
                            </div>
                            <div class="cover-bloc no-m-p">
                                <h2><?= $project->cover_title ?></h2><br>
                                <?= $project->cover_content ?>
                                <?php foreach ($projectCategories as $projectCategory) : ?>
                                    <?php if (intval($project->id_project_category) === intval($projectCategory->id)) : ?>
                                        <p><b>Catégorie : </b> <?= $projectCategory->title ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <hr>
                        <h2 class="text-center pb0-pt20">SEO <small><i>(bientôt disponible)</i></small></h2>
                        <?= (!empty($project->slug)) ? "<p><b>URL personnalisée du projet : </b> " . $project->slug . "</p>" : "<p><i>Aucune URL personnalisée.</i></p>"; ?>
                        <?= (!empty($project->meta_title)) ? "<p><b>Meta Title :</b> " . $project->meta_title . "</p>" : "<p><i>Aucune Meta Title.</i></p>"; ?>
                        <?= (!empty($project->meta_description)) ? "<p><b>Meta Description :</b> " . $project->meta_description . "</p>" : "<p><i>Aucune Meta Description.</i></p>"; ?>
                        <?= (!empty($project->meta_keywords)) ? "<p><b>Meta Keywords :</b> " . $project->meta_keywords . "</p>" : "<p><i>Aucune Meta Keywords.</i></p>"; ?><br>
                        <hr>
                        <h2 class="text-center pb0-pt20"><b><?= $project->title ?></b></h2>
                        <br><br>
                        <?= $project->content ?><br><br>
                        <div class="projects">
                            <!-- Videos en avant -->
                            <?php foreach ($projectImages as $projectImage) : ?>
                                <?php if (intval($projectImage->id_project) === intval($project->id)) : ?>
                                    <?php if ($project->is_blocks1 == 1 && $project->is_blocks2 == 0 && $projectImage->youtube_url == !null) : ?>
                                        <div class="project-block1">
                                            <div class="project-block1-img">
									            <iframe width="100%" height="100%" src="<?= $projectImage->youtube_url ?>" title="Vidéo du projet <?= $project->title ?>" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    <?php elseif ($project->is_blocks1 == 1 && $project->is_blocks2 == 0 && $projectImage->youtube_url == !null) : ?>
                                        <div class="project-block2">
                                            <div class="project-block2-img">
									            <iframe width="100%" height="100%" src="<?= $projectImage->youtube_url ?>" title="Vidéo du projet <?= $project->title ?>" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <!-- Photos après les vidéos -->
                            <?php foreach ($projectImages as $projectImage) : ?>
                                <?php if (intval($projectImage->id_project) === intval($project->id)) : ?>
                                    <?php if ($project->is_blocks1 == 0 && $project->is_blocks2 == 1 && $projectImage->youtube_url == null) : ?>
                                        <div class="project-block1">
                                            <div class="project-block1-img">
                                                <a href="../../<?= $projectImage->image ?>" data-fancybox="project" aria-label="Voir l'image en détail">
                                                    <img src="../../<?= $projectImage->image ?>" alt="<?= $projectImage->image_alt ?>" loading="lazy">
                                                </a>
                                            </div>
                                        </div>
                                    <?php elseif ($project->is_blocks1 == 1 && $project->is_blocks2 == 0 && $projectImage->youtube_url == null) : ?>
                                        <div class="project-block2">
                                            <div class="project-block2-img">
                                                <a href="../../<?= $projectImage->image ?>" data-fancybox="project" aria-label="Voir l'image en détail">
                                                    <img src="../../<?= $projectImage->image ?>" alt="<?= $projectImage->image_alt ?>" loading="lazy">
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="date-content">
                            <p><b>Crée le</b> <?= date("d/m/Y", strtotime($project->created_at)) ?>.</p>
                            <p><b>Modifié le</b> <?= date("d/m/Y", strtotime($project->updated_at)) ?>.</p>
                        </div>
                        <a class='btn btn-modal' data-bs-dismiss='modal' aria-label="Ok">Ok</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal fade' id="visible<?= $project->id ?>">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        Changer la visibilite du projet <b><?= $project->title ?></b> ?
                    </div>
                    <div class='modal-footer'>
                        <form method='post' role='form' action="project-blocks<?= $i ?>-visible">
                            <input type='hidden' name='id' value='<?= $project->id ?>'>
                            <input type='hidden' name='visible' value='<?= $project->visible ?>'>
                            <a class='btn btn-default' data-bs-dismiss='modal' aria-label="Annuler">Annuler</a>
                            <button type='submit' name='changeVisible' class='btn btn-success'>Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <table class='table table-default'>
        <thead>
            <tr>
                <th>
                    <h3 class="text-left-imp"><b>Titre</b></h3>
                </th>
                <th>
                    <h3 class="text-left-imp"><b>Mise à jour</b></h3>
                </th>
                <th>
                    <h3 class="text-left-imp"><b>Contenu</b></h3>
                </th>
                <th>
                    <h3 class="text-left-imp"><b>Actions</b></h3>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($projects as $project) {
                echo "
                <tr>
                    <td>$project->title</td>
                    <td>" . date("d/m/Y", strtotime($project->updated_at)) . "</td>
                    <td>
                        <a data-bs-toggle='modal' href='#desc$project->id' class='btn btn-xs btn-info' title='Contenu de ce projet' aria-label='Contenu de ce projet'>
                            <span class='fa fa-file fa-fw'></span>
                        </a>
                    </td>
                    <td>
                        <a href='projects-edit-$project->id' class='btn btn-xs btn-warning' title='Editer ce projet'>
                            <span class='fa fa-edit fa-fw'></span>
                        </a>
                        &nbsp;&nbsp;
                        <a data-bs-toggle='modal' href='#suppr$project->id' class='btn btn-xs btn-danger' title='Supprimer ce projet' aria-label='Supprimer ce projet'>
                            <span class='fa fa-times fa-fw'></span>
                        </a>
                    </td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>
<?php else : ?>
    <i>Aucun projet n'a encore été ajouté.</i>
<?php endif ?>
</div>