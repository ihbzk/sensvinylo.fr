<h1>Studios</h1>
<a href="studios-add" class="btn btn-sm btn-add" aria-label='Ajouter'><i class="fa-solid fa-plus"></i>Ajouter</a>
<hr>
<?php
// Studios
$stmt = $db_client->prepare("SELECT * FROM studios ORDER BY updated_at DESC");
$stmt->execute();
$studios = $stmt->fetchAll();

// Blocks détails studios
$stmt2 = $db_client->prepare("SELECT * FROM studios_blocks_details ORDER BY updated_at DESC");
$stmt2->execute();
$studiosBlocksDetails = $stmt2->fetchAll();

// Blocks détails studios
$stmt3 = $db_client->prepare("SELECT * FROM studios_images ORDER BY updated_at DESC");
$stmt3->execute();
$studiosImages = $stmt3->fetchAll();

if (!empty($studios)) :
    foreach ($studios as $studio) { ?>

        <!-- Modal de suppression -->
        <div class='modal fade' id="suppr<?= $studio->id ?>">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-bs-dismiss='modal' aria-hidden='true'>&times;</button>
                        <h4 class='modal-title'>Suppression d'un studio</h4>
                    </div>
                    <div class='modal-body'>
                        Confirmez-vous la suppression du studio <b><?= $studio->title ?></b> ?
                    </div>
                    <div class='modal-footer'>
                        <form method='post' action='studios-delete'>
                            <input type='hidden' name='id' value='<?= $studio->id ?>'>
                            <a class='btn btn-default' data-bs-dismiss='modal' aria-label='Annuler'>Annuler</a>
                            <button type='submit' name='formRemove' class='btn btn-danger'>Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal de détail -->
        <div class="modal fade" id="desc<?= $studio->id ?>">
            <div class='modal-dialog modal-lg'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-bs-dismiss='modal' aria-hidden='true'>&times;</button>
                        <p class='modal-title'>Contenu du studio "<strong><?= $studio->title ?>"</strong></p>
                    </div>
                    <div class='modal-body'>
                        <div class="cover-blocs">
                            <div class="cover-bloc cover-img-resp">
                                <h2 class="text-center pb0-pt20">Cover</h2>
                                <img src="../../<?= $studio->cover_image ?>" alt="<?= $studio->cover_image_alt ?>" loading="lazy">
                            </div>
                        </div>
                        <hr>
                        <h2 class="text-center pb0-pt20">SEO <small><i>(bientôt disponible)</i></small></h2>
                        <?= (!empty($studio->slug)) ? "<p><b>URL personnalisée du projet : </b> " . $studio->slug . "</p>" : "<p><i>Aucune URL personnalisée.</i></p>"; ?>
                        <?= (!empty($studio->meta_title)) ? "<p><b>Meta Title :</b> " . $studio->meta_title . "</p>" : "<p><i>Aucune Meta Title.</i></p>"; ?>
                        <?= (!empty($studio->meta_description)) ? "<p><b>Meta Description :</b> " . $studio->meta_description . "</p>" : "<p><i>Aucune Meta Description.</i></p>"; ?>
                        <?= (!empty($studio->meta_keywords)) ? "<p><b>Meta Keywords :</b> " . $studio->meta_keywords . "</p>" : "<p><i>Aucune Meta Keywords.</i></p>"; ?><br>
                        <hr>
                        <div class="center no-m-p">
                            <h2 class="no-pt"><?= $studio->title ?></h2><br>
                            <p><?= $studio->address ?> <?= $studio->zipcode ?> <?= $studio->city ?></p>
                            <p><?= $studio->phone1 ?></p>
                            <?= (!empty($studio->phone2)) ? "<p class='no-m'>$studio->phone2</p>" : "<p><i>Pas de 2ème numéro de téléphone.</i></p>"; ?>
                            <br>
                            <?php foreach ($studiosBlocksDetails as $studiosBlocksDetail) : ?>
                                <?php if (intval($studiosBlocksDetail->id_studio) === intval($studio->id)) : ?>
                                    <h3><?= $studiosBlocksDetail->title ?></h3>
                                    <?= $studiosBlocksDetail->content ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="projects">
                            <?php foreach ($studiosImages as $studiosImage) : ?>
                                <?php if (intval($studiosImage->id_studio) === intval($studio->id)) : ?>
                                    <div class="project-block1">
                                        <div class="project-block1-img">
                                            <a href="../../<?= $studiosImage->image ?>" data-fancybox="project" aria-label="Voir l'image en détail">
                                                <img src="../../<?= $studiosImage->image ?>" alt="<?= $studiosImage->image_alt ?>" loading="lazy">
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class='modal-footer'>
                    <div class="date-content">
                        <p><b>Crée le</b> <?= date("d/m/Y", strtotime($studio->created_at)) ?>.</p>
                        <p><b>Modifié le</b> <?= date("d/m/Y", strtotime($studio->updated_at)) ?>.</p>
                    </div>
                    <a class='btn btn-modal' data-bs-dismiss='modal' aria-label='Ok'>Ok</a>
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
            foreach ($studios as $studio) {
                echo "
                    <tr>
                        <td>$studio->title</td>
                        <td>" . date("d/m/Y", strtotime($studio->updated_at)) . "</td>
                        <td>
                            <a data-bs-toggle='modal' href='#desc$studio->id' class='btn btn-xs btn-info' title='Contenu de ce studio' aria-label='Contenu de ce studio'>
                                <span>Voir</span>
                            </a>
                        </td>
                        <td>
                            <a href='studios-edit-$studio->id' class='btn btn-xs btn-warning' title='Editer ce studio' aria-label='Editer ce studio'>
                                <span>Éditer</span>
                            </a>
                            &nbsp;&nbsp;
                            <a data-bs-toggle='modal' href='#suppr$studio->id' class='btn btn-xs btn-danger' title='Supprimer ce studio' aria-label='Supprimer ce studio'>
                                <span>Supprimer</span>
                            </a>
                        </td>
                    </tr>
                ";
            }
            ?>
        </tbody>
    </table>
<?php else : ?>
    <i>Aucun studio n'a encore été ajouté.</i>
<?php endif ?>
</div>