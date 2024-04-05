<h1>Catégories de projets</h1>
<a href="project-categories-add" class="btn btn-sm btn-add"><i class="fa-solid fa-plus"></i>Ajouter</a>
<hr>
<?php
// Catégories projet
$stmt = $db_client->prepare("SELECT * FROM project_categories ORDER BY updated_at DESC");
$stmt->execute();
$projectCategories = $stmt->fetchAll();

if (!empty($projectCategories)) :
    foreach ($projectCategories as $projectCategory) { ?>

        <!-- Modal de suppression -->
        <div class='modal fade' id="suppr<?= $projectCategory->id ?>">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-bs-dismiss='modal' aria-hidden='true'>&times;</button>
                        <h4 class='modal-title'>Suppression d'une catégorie de projet</h4>
                    </div>
                    <div class='modal-body'>
                        Confirmez-vous la suppression de la catégorie de projet <b><?= $projectCategory->title ?></b> ?
                    </div>
                    <div class='modal-footer'>
                        <form method='post' action='project-categories-delete'>
                            <input type='hidden' name='id' value='<?= $projectCategory->id ?>'>
                            <a class='btn btn-default' data-bs-dismiss='modal' aria-label="Annuler">Annuler</a>
                            <button type='submit' name='formRemove' class='btn btn-danger'>Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal de détail -->
        <div class="modal fade" id="desc<?= $projectCategory->id ?>">
            <div class='modal-dialog modal-lg'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-bs-dismiss='modal' aria-hidden='true'>&times;</button>
                        <p class='modal-title'>Contenu de la catégorie de projet</p>
                    </div>
                    <div class='modal-body'>
                        <div class="no-m-p">
                            <h2 class="no-pt"><?= $projectCategory->title ?></h2><br>
                            <?= $projectCategory->content_1 ?><br>
                            <?= $projectCategory->content_2 ?>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="date-content">
                            <p><b>Crée le</b> <?= date("d/m/Y", strtotime($projectCategory->created_at)) ?>.</p>
                            <p><b>Modifié le</b> <?= date("d/m/Y", strtotime($projectCategory->updated_at)) ?>.</p>
                        </div>
                        <a class='btn btn-modal' data-bs-dismiss='modal' aria-label="Ok">Ok</a>
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
            foreach ($projectCategories as $projectCategory) {
                echo "
                    <tr>
                        <td>$projectCategory->title</td>
                        <td>" . date("d/m/Y", strtotime($projectCategory->updated_at)) . "</td>
                        <td>
                            <a data-bs-toggle='modal' href='#desc$projectCategory->id' class='btn btn-xs btn-info' title='Contenu de cette catégorie de projet' aria-label='Contenu de cette catégorie de projet'>
                                <span class='fa fa-file fa-fw'></span>
                            </a>
                        </td>
                        <td>
                            <a href='project-categories-edit-$projectCategory->id' class='btn btn-xs btn-warning' title='Editer cette catégorie de projet' aria-label='Editer cette catégorie de projet'>
                                <span class='fa fa-edit fa-fw'></span>
                            </a>
                            &nbsp;&nbsp;
                            <a data-bs-toggle='modal' href='#suppr$projectCategory->id' class='btn btn-xs btn-danger' title='Supprimer cette catégorie de projet' aria-label='Supprimer cette catégorie de projet'>
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
    <i>Aucune catégorie de projet n'a encore été ajoutée.</i>
<?php endif ?>
</div>