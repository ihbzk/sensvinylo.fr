<hr>
<footer id="footer">
    <div class="container">
        <div class="blocks">
            <div class="block-left">
                <div class="bloc-logo">
                    <a href="<?= getRoute("home"); ?>" style="z-index: 1">
                        <img src="<?= asset("img/icons/logo-footer.webp"); ?>" alt="Logo <?= $conf_name ?>" id="logo-footer" loading="lazy">
                    </a>
                </div>
            </div>
            <div class="block-right">
                <h2>Contact</h2>
                <a href="https://goo.gl/maps/AYYxQn7dVZThTmBs9" target="_blank" rel="noopener noreferrer" class="footer-link"><?= $conf_address ?></a>
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
                </div>
            </div>
        </div>
        <hr>
        <div class="sublinks">
            <small><a href="<?= getRoute("revetement-vinyle-paris"); ?>">Revêtement vinyle à Paris</a></small>
            <small class="separate"> | </small>
            <small><a href="<?= getRoute("mentions-legales"); ?>">Mentions légales</a></small>
            <small class="separate"> | </small>
            <small><a href="<?= getRoute("politique-de-confidentialite"); ?>">Politique de confidentialité</a></small>
            <small class="separate"> | </small>
            <small><a href="sitemap.xml">Plan du site</a></small>
            <small class="separate"> | </small>
            <small><a href="<?= getRoute("home"); ?>"><?= $conf_name ?></a></small>
            <small class="separate"> | </small>
            <small><a href="<?= getRoute("home"); ?>"><?= date("Y"); ?></a></small>
        </div>
    </div>
</footer>