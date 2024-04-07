<?php
start_block('', '', '');
?>

<section class="projects information">
    <div class="container">
        <div class="back">
            <h1 class="padtest-30" style="padding-top: 100px; padding-bottom: 50px">Politique de confidentialité de <?= $conf_name ?></h1>
            <hr>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-editeur">
                <h2 style="margin-block-end: 0 !important">Collecte des données personnelles</h2>
            </label>
            <div class="container projets toggle-box-content" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Les informations personnelles pouvant être recueillies sur le site sont principalement utilisées par l'éditeur pour la gestion des relations avec vous, et le cas échéant pour le traitement de vos commandes. Elles sont enregistrées dans le fichier de clients de <?= $conf_name ?>, et le fichier ainsi constitué à partir de données personnelles est déclaré auprès de la CNIL.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-hebergement">
                <h2 style="margin-block-end: 0 !important">Droits d'accès, de rectification et de suppression</h2>
            </label>
            <div class="container projets toggle-box-content" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Conformément à la loi informatique et libertés du 6 janvier 1978 modifiée, vous disposez des droits d'accès, de rectification et de suppression des informations vous concernant, que vous pouvez exercer en vous adressant à <a href="mailto:<?= $conf_email ?>"><?= $conf_email ?></a>, ou par courrier à <a href="<?= $conf_googleMap ?>" target="_blank" rel="noopener noreferrer" class="footer-link"><?= $conf_address ?></a>, en joignant une copie de votre pièce d'identité.</p>
                </div>
            </div>
        </div>
        <div class="toggle-box-region">
            <label for="toggleId-propriete">
                <h2 style="margin-block-end: 0 !important">Cookies</h2>
            </label>
            <div class="container projets toggle-box-content pb-3" id="winning-message" style="width: 100%">
                <div class="targetDiv w-100">
                    <p class="bloc2 text-center" style="display: block; padding: 0 30px">Le site <?= $conf_name_website ?> ne collecte pas pour l'instant de cookie. Il peut collecter automatiquement des informations standards telles que tous types d'informations personnalisées permettant d'identifier les utilisateurs. Toute information collectée indirectement ne sera utilisée que pour suivre le volume, le type et la configuration du trafic utilisant ce site, pour en développer la conception et l'agencement et à d'autres fins administratives et de planification et plus généralement pour améliorer le service que nous vous offrons.</p>
                </div>
            </div>
        </div>
    </div>
</section>