<?php
$temp = explode("studio-", $slug);
$studioSlug = $temp[1];

$stmt = $db_client->prepare("SELECT * FROM studios WHERE slug=?");
$stmt->execute(array($studioSlug));
$studios = $stmt->fetch();

$stmt2 = $db_client->prepare("SELECT * FROM studios_blocks_details ORDER BY created_at ASC");
$stmt2->execute();
$studiosBlocks = $stmt2->fetchAll();

$stmt3 = $db_client->prepare("SELECT * FROM studios_images ORDER BY created_at ASC");
$stmt3->execute();
$studiosCarousels = $stmt3->fetchAll();

$stmt4 = $db_client->prepare("SELECT * FROM studios ORDER BY updated_at ASC");
$stmt4->execute();
$studiosAll = $stmt4->fetchAll();

start_block($studios->meta_title, $studios->meta_keywords, $studios->meta_description);
?>

<?php if (!empty($studios)) : ?>
    <section class="diapo" style="padding-bottom: 0">
        <div class="container w-100">
            <h1><?= $studios->title ?></h1>
            <section class="fil-ariane">
                <div class="container">
                    <div class="studios">
                        <?php foreach ($studiosAll as $studioAll) { ?>
                            <?php
                                $slug = $studioAll->slug;
                                $slug = remove_accents($slug);
                                $slug = str_replace(array(' ', ':', ',', ';', '/', '.', '\'', '---', '--', '"', ' -', '- '), array('-', '-', '-', '-', '-', '', '-', '-', '-', '-', '-', '-'), $slug);
                                $slug = strtolower($slug);
                                $url = $routes['studio-single'] . '-' . $slug;
                            ?>
                            <p class="separator"> | </p>
                            <a href="<?= $url ?>" aria-label="Autres studios">
                                <?php if (intval($studioAll->id) === intval($studios->id)) { ?>
                                    <p class="active"><?= $studioAll->title ?> </p>
                                <?php } else { ?>
                                    <p><?= $studioAll->title ?> </p>
                                <?php } ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <div class="blocs circle2" style="justify-content: center">
                <div class="slider-studio">
                    <?php
                    $i = 0;
                    foreach ($studiosCarousels as $studiosCarousel) {
                        if (intval($studiosCarousel->id_studio) === intval($studios->id)) {
                            $actives = '';
                            if ($i == 0) {
                                $actives = 'active';
                            } ?>
                            <div class="slider <?= $actives; ?>">
                                <a href="<?= $studiosCarousel->image ?>" data-fancybox="project" aria-label="Voir l'image en détail">
                                    <img src="<?= $studiosCarousel->image ?>" width="100%" alt="<?= $studiosCarousel->image_alt ?>">
                                </a>
                            </div>
                    <?php $i++;
                        }
                    } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="info-studio">
        <div class="container">
            <?php $studiosPhone1Lower = strtolower(str_replace(" ", "", $studios->phone1)); ?>
            <?php $studiosPhone2Lower = strtolower(str_replace(" ", "", $studios->phone2)); ?>
            <a href="https://maps.google.com/maps?q=<?= $studios->address ?> <?= $studios->zipcode ?> <?= $studios->city ?>" target="_blank" aria-label="https://maps.google.com/maps?q=<?= $studios->address ?> <?= $studios->zipcode ?> <?= $studios->city ?>">
                <p><?= $studios->address ?> <?= $studios->zipcode ?> <?= $studios->city ?></p>
            </a>
            <a href="tel:<?= $studiosPhone1Lower ?>" aria-label="<?= $studiosPhone1Lower ?>">
                <p><?= $studios->phone1 ?></p>
            </a>
            <?php if (!empty($studios->phone2)) : ?>
                <a href="tel:<?= $studiosPhone2Lower ?>" aria-label="<?= $studiosPhone2Lower ?>">
                    <p><?= $studios->phone2 ?></p>
                </a>
            <?php endif ?>
            <div class="download-pdf">
                <a href="<?= $conf_instagram ?>" target="_blank" aria-label="Voir nos réaliastions sur Instagram">Voir nos réaliastions sur Instagram</a>
                <a href="<?= $conf_facebook ?>" target="_blank" aria-label="Voir nos réaliastions sur Facebook">Voir nos réaliastions sur Facebook</a>
            </div>
            <?= $studios->description ?>
        </div>
    </section>

    <section class="information" style="padding-top: 30px">
        <div class="container">
            <div class="toggle-box-region">
                <?php foreach ($studiosBlocks as $studiosBlock) {
                    if (intval($studiosBlock->id_studio) === intval($studios->id)) { ?>
                        <hr>
                        <h2 class="h3" style="padding: 0"><?= $studiosBlock->title ?></h2>
                        <?= $studiosBlock->content ?>
                <?php }
                } ?>
            </div>
        </div>
    </section>
<?php else : ?>
    <p class="text-center" style="padding-top: 200px">Ce studio n'existe pas.</p>
<?php endif ?>