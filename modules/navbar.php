<div id="navbar">
    <a href="<?= getRoute("home"); ?>" style="z-index: 1">
        <img src="<?= asset("img/icons/logo-stroke.webp"); ?>" alt="Logo La Maison de Production" id="navbar-logo" loading="lazy">
    </a>
    <div class="btn-toggle" id="navbar-toggle" onclick="document.getElementById('navbar').classList.toggle('open')">
        <span></span>
    </div>
    <nav id="navbar-nav">
        <a href="<?= getRoute("sensvinylo"); ?>" class="btn2"><?= $conf_name ?></a>
        <a href="<?= getRoute("projects"); ?>" class="btn2">Nos réaliastions</a>
        <a href="<?= getRoute("studios"); ?>" class="btn2">Nos ateliers</a>
        <a href="<?= getRoute("contact"); ?>" class="btn2">Nous contacter</a>
    </nav>
</div>