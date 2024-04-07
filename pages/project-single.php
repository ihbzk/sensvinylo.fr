<?php
$temp = explode("projet-", $slug);
$projectSlug = $temp[1];

$stmt = $db_client->prepare("SELECT * FROM project WHERE slug=?");
$stmt->execute(array($projectSlug));
$projects = $stmt->fetch();

$meta_title = $projects->meta_title;
$meta_description = $projects->meta_description;
$meta_keywords = $projects->meta_keywords;

$stmt2 = $db_client->prepare("SELECT * FROM project_images ORDER BY id ASC");
$stmt2->execute();
$projectImages = $stmt2->fetchAll();

start_block($projects->meta_title, $projects->meta_keywords, $projects->meta_description);
?>

<?php if (!empty($projects)) : ?>
  <section class="project-single">
    <div class="container">
      <div class="back">
        <a href="<?= $routes['projects'] ?>" class="arrow-back" aria-label="Page précédente">
          <img src="<?= asset("img/icons/arrow-left.svg"); ?>" alt="Flèche Retour" loading="lazy">
        </a>
      </div>
      <h1 class="text-center"><b><?= $projects->title ?></b></h1>
      <div class="blocs">
        <div class="bloc2">
          <?= $projects->content ?>
        </div>
      </div>
    </div>
  </section>

  <section class="project-single">
    <div class="container w-100">
      <div class="projects">
        <?php foreach ($projectImages as $projectImage) : ?>
          <?php if (intval($projectImage->id_project) === intval($projects->id)) : ?>
            <?php if ($projects->is_blocks1 == 0 && $projects->is_blocks2 == 1 && $projectImage->youtube_url == !null) : ?>
              <div class="project-block1">
                <div class="project-block1-img">
                  <iframe width="100%" height="100%" src="<?= $projectImage->youtube_url ?>" title="Vidéo du projet <?= $projects->title ?>" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              </div>
            <?php elseif ($projects->is_blocks1 == 1 && $projects->is_blocks2 == 0 && $projectImage->youtube_url == !null) : ?>
              <div class="project-block2">
                <div class="project-block2-img">
                  <iframe width="100%" height="100%" src="<?= $projectImage->youtube_url ?>" title="Vidéo du projet <?= $projects->title ?>" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; ?>

        <?php foreach ($projectImages as $projectImage) : ?>
          <?php if (intval($projectImage->id_project) === intval($projects->id)) : ?>
            <?php if ($projects->is_blocks1 == 0 && $projects->is_blocks2 == 1 && $projectImage->youtube_url == null) : ?>
              <div class="project-block1">
                <div class="project-block1-img">
                  <a href="<?= $projectImage->image ?>" data-fancybox="project" aria-label="Voir l'image en détail">
                    <img src="<?= $projectImage->image ?>" alt="<?= $projectImage->image_alt ?>" loading="lazy">
                  </a>
                </div>
              </div>
            <?php elseif ($projects->is_blocks1 == 1 && $projects->is_blocks2 == 0 && $projectImage->youtube_url == null) : ?>
              <div class="project-block2">
                <div class="project-block2-img">
                  <a href="<?= $projectImage->image ?>" data-fancybox="project" aria-label="Voir l'image en détail">
                    <img src="<?= $projectImage->image ?>" alt="<?= $projectImage->image_alt ?>" loading="lazy">
                  </a>
                </div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php else : ?>
  <p class="text-center" style="padding-top: 200px">Ce projet n'existe pas.</p>
<?php endif ?>