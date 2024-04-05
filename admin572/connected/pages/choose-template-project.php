<h1>Choisir le template que vous souhaitez avoir sur votre projet</h1>
<div class="templates-project">
    <?php for ($i = 1; $i <= 2; $i++) { ?>
        <div>
            <h2>Template <?= $i ?></h2>
            <a href="project-blocks<?= $i ?>-add" aria-label="Choisir le template que vous souhaitez avoir sur votre projet">
                <img src="../../assets/img/projets/templates/<?= $i ?>.jpg" alt="Template <?= $i ?>" class="template-thumbail" loading="lazy">
            </a>
        </div>
    <?php } ?>
    </div>
</div>