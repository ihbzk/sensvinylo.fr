<?php
start_block('', '', '');
?>

<section class="projects information">
    <div class="container">
        <div class="back">
            <h1 class="padtest-30" style="padding-top: 100px; padding-bottom: 50px">Politique de confidentialité de <?= $conf_name ?></h1>
            <div class="bloc-logo text-center" style="padding-bottom: 30px">
                <a href="<?= getRoute("home"); ?>" style="z-index: 1; display: block">
                    <img src="<?= asset("img/icons/logo-footer.webp"); ?>" alt="Logo <?= $conf_name ?>" id="logo-footer" loading="lazy" width="120" class="h-100">
                </a>
            </div>
            <hr>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-editeur">
                <h2 style="margin-block-end: 0 !important">Qu'est-ce que le revêtement en vinyle?</h2>
            </label>
            <div class="container projets toggle-box-content" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Le revêtement en vinyle est une solution de décoration et de protection pour vos sols et murs, offrant une grande variété de designs et une résistance remarquable.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-hebergement">
                <h2 style="margin-block-end: 0 !important">Les revêtements en vinyle sont-ils résistants à l'eau ?</h2>
            </label>
            <div class="container projets toggle-box-content" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Oui, la plupart de nos revêtements en vinyle sont conçus pour être résistants à l'eau, ce qui les rend idéaux pour les cuisines, salles de bains, et autres zones humides.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-propriete">
                <h2 style="margin-block-end: 0 !important">Comment entretenir mon revêtement en vinyle ?</h2>
            </label>
            <div class="container projets toggle-box-content pb-3" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Un nettoyage régulier avec un balai ou un aspirateur est recommandé. Pour les taches, utilisez un chiffon humide avec un détergent doux.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-propriete">
                <h2 style="margin-block-end: 0 !important">Le revêtement en vinyle est-il écologique ?</h2>
            </label>
            <div class="container projets toggle-box-content pb-3" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px"><?= $conf_name ?> s'engage pour l'environnement en sélectionnant des vinyles éco-responsables et en adoptant des pratiques de production durables.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-propriete">
                <h2 style="margin-block-end: 0 !important">Puis-je obtenir un devis personnalisé ?</h2>
            </label>
            <div class="container projets toggle-box-content pb-3" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Bien sûr ! Contactez-nous à <a href="mailto:<?= $conf_email ?>" class="footer-link"><?= $conf_email ?></a> ou via <a href="<?= getRoute("contact"); ?>" class="footer-link">notre formulaire en ligne</a> pour un devis sur mesure adapté à vos besoins.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-propriete">
                <h2 style="margin-block-end: 0 !important">Quelle est la durée de vie d'un revêtement en vinyle ?</h2>
            </label>
            <div class="container projets toggle-box-content pb-3" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Avec un entretien adéquat, un revêtement en vinyle peut durer plus de 20 ans, en fonction de la qualité du produit et de l'intensité de son utilisation.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-propriete">
                <h2 style="margin-block-end: 0 !important"><?= $conf_name ?> offre-t-il des garanties sur ses installations ?</h2>
            </label>
            <div class="container projets toggle-box-content pb-3" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Oui, nous offrons une garantie sur toutes nos installations, assurant la qualité et la durabilité de votre revêtement en vinyle.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-propriete">
                <h2 style="margin-block-end: 0 !important">Puis-je visiter un showroom ?</h2>
            </label>
            <div class="container projets toggle-box-content pb-3" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Oui, nous vous invitons à visiter nos studios à Paris pour découvrir nos collections et parler de votre projet avec nos experts.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-propriete">
                <h2 style="margin-block-end: 0 !important">Durée d'installation ?</h2>
            </label>
            <div class="container projets toggle-box-content pb-3" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">L'installation varie selon la zone mais se fait généralement en 1-3 jours. Notre équipe veille à minimiser l'interruption de votre quotidien.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-propriete">
                <h2 style="margin-block-end: 0 !important">Compatible chauffage au sol ?</h2>
            </label>
            <div class="container projets toggle-box-content pb-3" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Absolument, nos revêtements s'adaptent parfaitement au chauffage au sol, assurant confort et chaleur dans votre maison.</p>
                </div>
            </div>
        </div>
    </div>
</section>