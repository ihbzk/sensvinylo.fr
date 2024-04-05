<div id="navbar">
	<a href=".">
		<img src="<?= asset("../../../assets/img/icons/logo-stroke.svg"); ?>" alt="Logo La Maison de Production" id="navbar-logo" loading="lazy">
	</a>
    <div class="btn-toggle" id="navbar-toggle" onclick="document.getElementById('navbar').classList.toggle('open')">
        <span></span>
    </div>
	<nav id="navbar-nav">
		<!-- <a href="." class="btn active" aria-label="Espace d'administration - <?= $conf_name ?>">Espace d'administration - <?= $conf_name ?></a> -->
		<a href="project-categories" class="btn" aria-label="Catégories de projets /">Catégories de projets /</a>
		<a href="project" class="btn" aria-label="Projets /">Projets /</a>
		<a href="studios" class="btn" aria-label="Studios /">Studios /</a>
		<a href="../.." target="_blank" class="btn" aria-label="Retour sur le site /">Retour sur le site /</a>
		<a href="../deconnexion.php" class="btn" aria-label="Déconnexion /">Déconnexion /</a>
	</nav>
</div>