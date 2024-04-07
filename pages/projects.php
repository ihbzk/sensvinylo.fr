<?php
start_block('', '', '');
?>
<?php
$stmt = $db_client->prepare("SELECT * FROM project GROUP BY id ORDER BY updated_at ASC");
$stmt->execute();
$projects = $stmt->fetchAll();

$stmt2 = $db_client->prepare("SELECT * FROM project_categories GROUP BY id ORDER BY id ASC");
$stmt2->execute();
$projectsCategories = $stmt2->fetchAll();
?>

<section class="projects information">
    <div class="container">
        <div class="back">
            <h1 class="padtest-30">Nos réalisations</h1>
        </div>
        <p class="text-center mx-4 pb-3"><strong>Ces trois catégories offrent une vue d'ensemble claire et logique du processus de création chez <a href="<?= getRoute("home"); ?>" aria-label="Lien menant vers la page d'accueil du site web de <?= $conf_name ?>"><?= $conf_name ?></a></strong>, de l'idée initiale à la réalisation concrète, reflétant l'expertise et la passion qui caractérisent chaque projet.</p>
        <div class="toggle-box-region">
            <?php foreach ($projectsCategories as $projectsCategory) { ?>
                <?php $projectsCategoriesLower = strtolower(str_replace(" ", "-", $projectsCategory->title)); ?>
                <input class="toggle-box" id="toggleId-<?= $projectsCategoriesLower ?>" type="checkbox">
                <label for="toggleId-<?= $projectsCategoriesLower ?>">
                    <h2><?= $projectsCategory->title ?></h2>
                </label>
                <div class="container projets toggle-box-content" id="winning-message" style="width: 100%">
                    <div class="targetDiv w-100">
                        <div class="bloc2"><?= $projectsCategory->content_1 ?></div>
                        <div class="bloc3"><?= $projectsCategory->content_2 ?></div>
                        <?php foreach ($projects as $project) : ?>
                            <?php
                            $slug = $project->slug;
                            $slug = remove_accents($slug);
                            $slug = str_replace(array(' ', ':', ',', ';', '/', '.'), array('-', '-', '-', '-', '-', ''), $slug);
                            $slug = strtolower($slug);
                            $url = $routes['project-single'] . '-' . $slug;
                            ?>
                            <?php if ($project->id_project_category == $projectsCategory->id) : ?>
                                <?php if (!empty($projects)) : ?>
                                    <div class="projet">
                                        <div class="projet-overlay"></div>
                                        <div class="projet-image">
                                            <img src="<?= $project->cover_image ?>" alt="<?= $project->cover_image_alt ?>" loading="lazy">
                                        </div>
                                        <a href="<?= $url ?>">
                                            <div class="projet-details no-m-p">
                                                <h3><?= $project->cover_title ?></h3>
                                                <?= $project->cover_content ?>
                                            </div>
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <i>Aucun projet n'a encore été ajouté.</i>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>