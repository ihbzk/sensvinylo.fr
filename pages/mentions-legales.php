<?php
//start_block('title','keywords','description')
start_block('', '', '');
?>

<section class="projects information">
    <div class="container">
        <div class="back">
            <h1 class="padtest-30" style="padding-top: 100px; padding-bottom: 50px">Mentions légales de <?= $conf_name ?></h1>
            <hr>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-editeur">
                <h2 style="margin-block-end: 0 !important">Éditeur du site</h2>
            </label>
            <div class="container projets toggle-box-content" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px"><?= $conf_name ?>, société par actions simplifiée au capital de <?= $conf_companyCapital ?>, dont le siège social est situé à <?= $conf_companyHeadOffice ?>, inscrite au Registre du Commerce et des Sociétés de <?= $conf_companyCity ?> sous le numéro <?= $conf_companySiret ?>.</p>
                    <p class="bloc3 text-center" style="display: block; padding: 0 30px">Directeur de la publication : <?= $conf_companyDirector ?>, Président de <?= $conf_name ?>.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-hebergement">
                <h2 style="margin-block-end: 0 !important">Hébergement</h2>
            </label>
            <div class="container projets toggle-box-content" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Ce site est hébergé par <?= $conf_hostName ?>, dont le siège social est situé <?= $conf_hostHeadOffice ?>.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-propriete">
                <h2 style="margin-block-end: 0 !important">Propriété intellectuelle</h2>
            </label>
            <div class="container projets toggle-box-content pb-3" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Tous les contenus présents sur le site <?= $conf_name_website ?>, y compris les graphismes, images, textes, logos, et icônes sont la propriété exclusive de <?= $conf_name ?> à l'exception des marques, logos ou contenus appartenant à d'autres sociétés partenaires ou auteurs.</p>
                </div>
            </div>
        </div>
    </div>
</section>