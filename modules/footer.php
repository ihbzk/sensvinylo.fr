<hr>
<footer id="footer">
    <div class="container">
        <div class="blocks">
            <div class="block-left">
                <div class="bloc-logo">
                    <a href="<?= getRoute("home"); ?>">
                        <img src="<?= asset("img/icons/logo-footer.webp"); ?>" alt="Logo <?= $conf_name ?>" id="logo-footer" loading="lazy">
                    </a>
                    <a href="mailto:<?= $conf_email ?>" class="footer-link"><?= $conf_email ?></a>
                    <a href="tel:<?= $call_phone ?>" class="footer-link"><?= $conf_phone ?></a>
                </div>
            </div>
            <div class="block-right">
                <p>Contact</p>
                <div>
                    <a href="<?= $conf_googleMap ?>" target="_blank" rel="noopener noreferrer" class="footer-link"><?= $conf_address ?></a>
                </div>
                <div class="block-logos">
                    <a href="tel:<?= $call_phone ?>" class="footer-link">
                        <img src="<?= asset("img/icons/phone.svg"); ?>" alt="Logo Téléphone" loading="lazy">
                    </a>
                    <a href="mailto:<?= $conf_email ?>" class="footer-link">
                        <img src="<?= asset("img/icons/mail.svg"); ?>" alt="Logo Mail" loading="lazy">
                    </a>
                    <a href="<?= $conf_instagram ?>" class="footer-link" target="_blank">
                        <img src="<?= asset("img/icons/instagram.svg"); ?>" alt="Logo Instagram" loading="lazy">
                    </a>
                    <a href="<?= $conf_facebook ?>" class="footer-link" target="_blank">
                        <img src="<?= asset("img/icons/facebook.svg"); ?>" alt="Logo Facebook" loading="lazy">
                    </a>
                    <a href="<?= $conf_linkedin ?>" class="footer-link" target="_blank">
                        <img src="<?= asset("img/icons/linkedin-3.svg"); ?>" alt="Logo LinkedIn" loading="lazy">
                    </a>

                </div>
            </div>
        </div>
        <hr>
        <div class="sublinks flex-column gap-0">
            <small><a href="<?= getRoute("revetement-vinyle-paris"); ?>">Revêtement vinyle à Paris</a></small>
            <small><a href="<?= getRoute("decoration-vinyle-sur-mesure"); ?>">Décoration vinyle sur mesure</a></small>
            <small><a href="<?= getRoute("decoration-murale-en-vinyle"); ?>">Décoration murale en vinyle</a></small>
            <small><a href="<?= getRoute("pourquoi-nous-choisir"); ?>">Pourquoi nous choisir</a></small>
            <small><a href="<?= getRoute("conseils-et-inspirations"); ?>">Conseils et inspirations</a></small>
            <small><a href="<?= getRoute("pose-de-vinyle-professionnel"); ?>">Pose de vinyle professionnel</a></small>
        </div>
        <small class="separate py-2">-</small>
        <div class="sublinks">
            <small><a href="<?= getRoute("faq"); ?>">FAQ</a></small>
            <small class="separate"> | </small>
            <small><a href="<?= getRoute("mentions-legales"); ?>">Mentions légales</a></small>
            <small class="separate"> | </small>
            <small><a href="<?= getRoute("politique-de-confidentialite"); ?>">Politique de confidentialité</a></small>
            <small class="separate"> | </small>
            <small><a href="sitemap.xml">Plan du site</a></small>
        </div>
        <br>
        <div class="sublinks">
            <small><a href="<?= getRoute("home"); ?>"><?= $conf_name ?> | <?= date("Y"); ?></a></small>
        </div>
    </div>
</footer>