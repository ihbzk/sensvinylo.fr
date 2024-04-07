<?php
$studioPerPage = 100;

$stmt = $db_client->prepare("SELECT * FROM studios GROUP BY id ORDER BY id ASC");
$stmt->execute();
$studios = $stmt->fetchAll();
?>

<section class="diapo pb0-pt120">
    <div class="container">
        <div class="back">
            <h1 class="padtest-30">Nos ateliers</h1>
        </div>
        <div class="fil-ariane">
            <div class="studios">
                <?php foreach ($studios as $studio) { ?>
                    <p class="separator"> | </p>
                    <a href="<?= $routes['studio-single'] . "-" . $studio->slug ?>">
                        <p><?= $studio->title ?> </p>
                    </a>
                <?php } ?>
            </div>
        </div>
        <p class="text-center mx-4 pb-3">Chacun de ces ateliers est conçu pour offrir un environnement unique et spécialisé, permettant aux artisans de Sens Vinylo de pousser les limites de la créativité et de l'innovation en matière de design vinyle.</p>
        <div class="blocs circle2" style="justify-content: center">
            <div class="pizza">
                <?php if (!empty($studios)) :
                    foreach ($studios as $studio) { ?>
                        <?php
                        $slug = $studio->slug;
                        $slug = remove_accents($slug);
                        $slug = str_replace(array(' ', ':', ',', ';', '/', '.', '\'', '---', '--', '\"'), array('-', '-', '-', '-', '-', '', '-', '-', '-', '-'), $slug);
                        $slug = strtolower($slug);
                        $url = $routes['studio-single'] . '-' . $slug;
                        ?>
                        <div class="projet">
                            <div class="projet-overlay"></div>
                            <div class="projet-image">
                                <img src="<?= $studio->cover_image ?>" alt="<?= $studio->cover_image_alt ?>" loading="lazy">
                            </div>
                            <a href="<?= $url ?>" title="Voir les informations détaillées du studio <?= $studio->title ?>">
                                <div class="projet-details no-m-p">
                                    <h2><?= $studio->cover_title ?></h2>
                                </div>
                            </a>
                            <h3 style="margin-block-start: 0; margin-block-end: 0"><?= $studio->title ?></h3>
                            <?php $studiosPhone1Lower = strtolower(str_replace(" ", "", $studio->phone1)); ?>
                            <?php $studiosPhone2Lower = strtolower(str_replace(" ", "", $studio->phone2)); ?>
                            <a href="https://maps.google.com/maps?q=<?= $studio->address ?> <?= $studio->zipcode ?> <?= $studio->city ?>" target="_blank" title="Adresse du studio <?= $studio->title ?>">
                                <p><?= $studio->address ?> <?= $studio->zipcode ?> <?= $studio->city ?></p>
                            </a>
                            <a href="tel:<?= $studiosPhone1Lower ?>" title="Numéro de téléphone 2 du studio <?= $studio->title ?>">
                                <p><?= $studio->phone1 ?></p>
                            </a>
                            <?php if (!empty($studios->phone2)) : ?>
                                <a href="tel:<?= $studiosPhone2Lower ?>" title="Numéro de téléphone 2 du studio <?= $studio->title ?>">
                                    <p><?= $studio->phone2 ?></p>
                                </a>
                            <?php endif ?>
                        </div>
                    <?php }
                    ?>
                <?php else : ?>
                    <i>Aucun studio n'a encore été ajouté.</i>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>