<section class="header">
    <div class="container">
        <h1><?= $conf_name ?> : Le spécialiste du revêtement et de la décoration en vinyle</h1>
    </div>
    <div class="download-pdf">
        <a href="<?= getRoute("sensvinylo"); ?>" aria-label="Lien menant vers la page de l'histoire de <?= $conf_name ?>">En savoir plus sur notre entreprise</a>
    </div>
</section>

<?php include("modules/scroll-down-header-hp.php"); ?>

<section class="vertical">
    <div class="container">
        <h2 class="text-center" id="scroll-down-header-hp">Bien plus qu'un simple revêtement</h2>
        <div class="blocs" style="padding-bottom: 0">
            <div class="bloc2">
                <p><strong><?= $conf_name ?></strong> est une entreprise spécialisée dans la <strong>pose de revêtements et décorations en vinyle sur mesure.</strong></p>
                <p>Plus qu'un simple revêtement, <strong><?= $conf_name ?> est une véritable invitation à la création</strong> et à l'expression de votre personnalité.</p>
                <p class="pb-3"><strong>Depuis plus de 30 ans, <?= $conf_name ?> explore les possibilités infinies du vinyle pour créer des décors uniques et personnalisés.</strong> Notre histoire est celle d'une passion, d'un savoir-faire artisanal transmis de génération en génération et d'une quête incessante d'innovation.</p>
                <p><strong>Fondée en 1991 par Éric Rousseau</strong>, un artisan visionnaire, <?= $conf_name ?> s'est rapidement imposée comme un pionnier dans l'art du revêtement mural et du sol en vinyle. Animé par une fascination pour ce matériau aux multiples facettes, Éric Rousseau a su déceler son potentiel pour transformer les espaces en véritables œuvres d'art.</p>
                <p class="pb-3"><strong>Au fil des années, <?= $conf_name ?> s'est développé et enrichi de nouvelles compétences.</strong> L'entreprise s'est dotée d'un atelier de production ultramoderne et d'une équipe de designers talentueux, tous animés par la même passion pour le vinyle et le design.</p>
                <p><strong>Aujourd'hui, <?= $conf_name ?> est bien plus qu'une simple entreprise.</strong> C'est un véritable univers créatif où chaque projet est une occasion unique de donner vie à vos rêves.</p>
                <div class="download-pdf">
                    <a href="<?= getRoute("sensvinylo"); ?>" aria-label="Lien menant vers la page de l'histoire de <?= $conf_name ?>">En savoir plus sur notre entreprise</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="category">
    <div class="container w-100">
        <div class="blocs">
            <?php

            // Projets
            $stmt = $db_client->prepare("SELECT * FROM project GROUP BY id ORDER BY updated_at ASC");
            $stmt->execute();
            $projects = $stmt->fetchAll();

            // Catégories de projet
            $stmt2 = $db_client->prepare("SELECT * FROM project_categories GROUP BY id ORDER BY updated_at ASC");
            $stmt2->execute();
            $projectCategories = $stmt2->fetchAll();

            // Studios
            $stmt3 = $db_client->prepare("SELECT * FROM studios GROUP BY id ORDER BY updated_at ASC");
            $stmt3->execute();
            $studios = $stmt3->fetchAll();
            ?>
            <div class="bloc3 scroll scroll-2">
                <div class="container">
                    <h2 class="text-center">Nos différentes réalisations</h2>
                    <?php
                    $directions = array("to-left", "to-right");
                    foreach ($directions as $dir) {
                    ?>
                        <div class="marquee">
                            <div class="marquee_inner-wrap">
                                <div class="marquee-<?php echo $dir; ?>_inner">
                                    <?php
                                    if (isset($projects)) : ?>
                                        <?php foreach ($projects as $project) : ?>
                                            <?php
                                                $slug = $project->slug;
                                                $slug = remove_accents($slug);
                                                $slug = str_replace(array(' ', ':', ',', ';', '/', '.'), array('-', '-', '-', '-', '-', ''), $slug);
                                                $slug = strtolower($slug);
                                                $urlProject = $routes['project-single'] . '-' . $slug;
                                            ?>
                                            <?php foreach ($projectCategories as $projectCategory) : ?>
                                                <?php foreach ($studios as $studio) : ?>
                                                    <?php
                                                        $slug = $studio->slug;
                                                        $slug = remove_accents($slug);
                                                        $slug = str_replace(array(' ', ':', ',', ';', '/', '.'), array('-', '-', '-', '-', '-', ''), $slug);
                                                        $slug = strtolower($slug);
                                                        $urlStudio = $routes['studio-single'] . '-' . $slug;
                                                    ?>
                                                    <a href="<?= $urlProject ?>" aria-label="Projet">
                                                        <span aria-hidden="true"><?= $project->cover_title ?> &nbsp; // </span>
                                                    </a>
                                                    <a href="projets" aria-label="Catégorie de projets">
                                                        <span aria-hidden="true"><?= $projectCategory->title ?> &nbsp; // </span>
                                                    </a>
                                                    <a href="<?= $urlStudio ?>" aria-label="Studio">
                                                        <span aria-hidden="true"><?= $studio->title ?> &nbsp; //</span>
                                                    </a>
                                                    <a href="<?= $urlProject ?>" aria-label="Projet">
                                                        <span aria-hidden="true"><?= $project->cover_title ?> &nbsp; // </span>
                                                    </a>
                                                    <a href="projets" aria-label="Catégorie de projets">
                                                        <span aria-hidden="true"><?= $projectCategory->title ?> &nbsp; // </span>
                                                    </a>
                                                    <a href="<?= $urlStudio ?>" aria-label="Studio">
                                                        <span aria-hidden="true"><?= $studio->title ?> &nbsp; //</span>
                                                    </a>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <i>Aucune réalisation n'a encore été ajouté.</i>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="studio-content2 pb-3">
    <div class="container">
        <div class="blocs">
            <div class="bloc1">
                <h2>L'exploration commence par nos principaux ateliers thématiques</h2>
                <p>Laissez-vous transporter par la vague d'inspiration azur. Des bleus profonds aux turquoises cristallines, plongez dans une ambiance marine et relaxante. Créez un havre de paix où le calme et la sérénité règnent en maîtres.</p>
                <p>Remontez le temps et revisitez le charme du passé. Motifs rétro, couleurs d'antan et matériaux authentiques : donnez à votre espace une touche d'élégance et de nostalgie.</p>
                <p class="pb-3">Vos envies prennent vie en vinyle. Exprimez votre personnalité et vos aspirations à travers des décors uniques et personnalisés. Nos designers talentueux travaillent en étroite collaboration avec vous pour créer des espaces qui vous ressemblent.</p>
                <p><strong>Mais <?= $conf_name ?> ne se limite pas à ces univers.</strong> Notre expertise s'étend à la création de fresques et de tableaux en vinyle avec des œuvres d'art uniques pour sublimer vos murs et donner vie à vos envies les plus folles.</p>
                <p><strong>Nous réalisation des sols en vinyle, des dalles, des lames et des tapis qui s'adaptent à tous les styles et à toutes les exigences.</strong> La fabrication des objets décoratifs en vinyle que nous faisons sont sculptures, installations et tableaux pour une touche d'originalité et de créativité.</p>
                <p>Notre engagement ne s'arrête pas à la qualité de nos produits et services. <strong>Chez <?= $conf_name ?>, nous sommes convaincus que le respect de l'environnement est essentiel.</strong> C'est pourquoi nous utilisons des vinyles éco-responsables et des techniques de production durables.</p>
                <p>Pour vous accompagner dans votre projet, nous mettons à votre disposition une équipe de designers expérimentés qui vous conseillent et vous guident tout au long du processus de création, de la conception à la réalisation.</p>
                <p>Un <strong>large choix de vinyles</strong> est disponible avec des matières nobles, des couleurs vibrantes et des textures uniques pour une créativité sans limites. Nous utilisons des technologies de pointe : impression numérique, découpe laser et thermoformage pour des réalisations d'une précision exceptionnelle.</p>
                <a href="studios" aria-label="Nos studios">
                    <img src="<?= asset("img/icons/arrow-white-right.svg"); ?>" alt="Flèche blanche pointant vers la droite" loading="lazy">
                </a>
            </div>
            <div class="bloc2">
                <img src="<?= asset("img/pages/home/studio/studios.webp"); ?>" alt="Employés dans les studios" loading="lazy">
            </div>
        </div>
        <div class="blocs pb-3">
            <div class="bloc2">
                <img src="<?= asset("img/pages/home/studio/studios2.webp"); ?>" alt="Locaux de <?= $conf_name ?>" loading="lazy">
            </div>
            <div class="bloc1">
                <h2>Un engagement durable</h2>
                <p><strong><?= $conf_name ?>, c'est bien plus qu'une simple entreprise.</strong> C'est un partenaire de confiance qui vous accompagne dans la création d'espaces uniques qui reflètent votre personnalité et vos aspirations.</p>
                <p>N'hésitez pas à nous contacter par téléphone au <a href="tel:<?= $call_phone ?>"><?= $conf_phone ?></a> ou par email à <a href="mailto:<?= $conf_email ?>"><?= $conf_email ?></a> pour découvrir nos ateliers, explorer nos collections et discuter de votre projet.</p>
                <p>Voici quelques exemples concrets de réalisations <?= $conf_name ?> :</p>
                <ul>
                    <li>Une fresque murale représentant une forêt tropicale luxuriante dans une chambre d'enfant.</li>
                    <li>Un sol en vinyle imitation marbre dans un hall d'hôtel.</li>
                    <li>Une sculpture en vinyle représentant un animal sauvage dans un jardin.</li>
                    <li>Un tableau en vinyle reprenant les couleurs et les motifs d'un tableau de maître.</li>
                </ul>
                <p><?= $conf_name ?> a également collaboré avec de nombreux artistes, designers et architectes de renom pour créer des projets uniques et spectaculaires.</p>
                <p><strong>L'entreprise est fière de son engagement en faveur du développement durable</strong> et s'est engagée à utiliser des vinyles éco-responsables et des techniques de production durables.</p><br>
                <p><strong>Chez <?= $conf_name ?>, nous sommes convaincus que la création est un processus collaboratif.</strong> C'est pourquoi nous sommes fiers d'avoir une communauté active et passionnée de clients et de partenaires.</p>
                <a href="studio-kina" aria-label="Studio Kina">
                    <img src="<?= asset("img/icons/arrow-white-right.svg"); ?>" alt="Flèche blanche pointant vers la droite" loading="lazy">
                </a>
            </div>
        </div>
    </div>
</section>

<section class="categories">
    <div class="container">
        <div class="blocs">
            <div class="bloc1">
                <h2>Croquis : Donner vie à vos idées</h2>
                <p><strong>Le croquis est l'étape fondamentale où vos idées prennent forme.</strong> Nos designers expérimentés travaillent en étroite collaboration avec vous pour comprendre vos envies et les traduire en un visuel concret.</p>
                <p><strong>Que vous ayez une vision précise ou que vous soyez à la recherche d'inspiration, nous sommes là pour vous guider.</strong> Nous vous proposons différentes options de croquis, du simple dessin au rendu 3D réaliste, afin que vous puissiez visualiser votre projet en détail et apporter les modifications nécessaires.</p>
                <p>Lors de cette étape, nous prenons en compte :</p>
                <ul>
                    <li><strong>Vos besoins et vos envies</strong> : Quel est l'objectif de votre projet ? Quelle ambiance souhaitez-vous créer ?</li>
                    <li><strong>Les contraintes techniques</strong> : Quelles sont les dimensions de l'espace à habiller ? Quels types de revêtements en vinyle existent ?</li>
                    <li><strong>Votre budget</strong> : Quelles sont vos options en fonction de votre budget ?</li>
                </ul>
                <p><strong>Notre objectif est de créer un croquis qui correspond parfaitement à vos attentes et qui vous permettra de vous projeter dans votre futur espace.</strong></p>
                <a href="projets" aria-label="Production">
                    <img src="<?= asset("img/icons/arrow-white-right.svg"); ?>" alt="Flèche blanche pointant vers la droite" loading="lazy">
                </a>
            </div>
        </div>
        <div class="blocs">
            <div class="bloc2">
                <div class="title">
                    <h2>Production : Des solutions sur mesure pour chaque projet</h2>
                </div>
                <p><strong>Une fois le croquis validé, nous passons à la phase de production.</strong> Nos équipes de production utilisent des technologies de pointe et des matériaux de haute qualité pour garantir un résultat impeccable.</p>
                <p><strong>Chez <?= $conf_name ?>, nous nous engageons à vous proposer des solutions sur mesure pour chaque projet.</strong> C'est pourquoi nous utilisons un large éventail de techniques de production, notamment :</p>
                <ul>
                    <li><strong>Impression numérique</strong> : Permet de créer des motifs et des designs uniques sur mesure.</li>
                    <li><strong>Découpe laser</strong> : Assure une précision et une finition impeccables pour les formes complexes.</li>
                    <li><strong>Thermoformage</strong> : Permet de donner vie à des formes 3D originales et audacieuses.</li>
                </ul>
                <p><strong>Nous sommes également à la pointe des dernières tendances en matière de revêtements et de décorations en vinyle.</strong> Nous vous proposons ainsi une large gamme de produits innovants et éco-responsables pour répondre à tous vos besoins :</p>
                <ul>
                    <li><strong>Revêtements de sol en vinyle</strong> : Sols PVC, dalles et lames vinyles, sols stratifiés</li>
                    <li><strong>Revêtements muraux en vinyle</strong> : Papier peint vinyle, toile tendue, panneaux muraux</li>
                    <li><strong>Décorations en vinyle</strong> : Stickers muraux, lettrages adhésifs, fresques murales</li>
                </ul>
                <a href="projets" aria-label="Production virtuelle">
                    <img src="<?= asset("img/icons/arrow-white-right.svg"); ?>" alt="Flèche blanche pointant vers la droite" loading="lazy">
                </a>
            </div>
        </div>
        <div class="blocs">
            <div class="bloc3">
                <h2>Réalisation : Un travail de précision pour un résultat impeccable</h2>
                <p>La dernière étape est la réalisation de votre projet. Nos équipes de poseurs professionnels s'assurent que le résultat final est conforme à vos attentes et que le revêtement en vinyle est posé de manière impeccable.</p><br>
                <p>Nous sommes fiers de notre travail et nous nous engageons à vous fournir un service de qualité irréprochable. C'est pourquoi nous prenons le temps de bien préparer le chantier et de respecter les normes en vigueur.</p>
                <p>Lors de la pose, nous prenons soin de :</p>
                <ul>
                    <li><strong>Protéger votre mobilier et vos sols.</strong></li>
                    <li><strong>Respecter les délais impartis.</strong></li>
                    <li><strong>Vous fournir des conseils d'entretien pour votre revêtement en vinyle.</strong></li>
                </ul>
                <p><strong>Notre objectif est de vous garantir une satisfaction totale et de vous offrir un résultat qui vous fera rêver.</strong></p>
                <a href="projets" aria-label="Post-production">
                    <img src="<?= asset("img/icons/arrow-white-right.svg"); ?>" alt="Flèche blanche pointant vers la droite" loading="lazy">
                </a>
            </div>
        </div>
    </div>
</section>

<section class="information">
    <div class="container">
        <h2>Nos ateliers</h2>
        <p class="text-center pad-30"><strong>Plongez en bleu azur, revisitez le vintage ou créez un décor unique qui vous ressemble.</strong> Nos ateliers thématiques marient savoir-faire artisanal et technologies modernes pour des revêtements en vinyle sur mesure. Contactez-nous et donnez vie à vos envies.</p>
        <div class="toggle-box-region">
            <hr>
            <input class="toggle-box" id="toggleId-1" type="checkbox">
            <label for="toggleId-1">
                <h3><a href="studio-sens-vinylo" aria-label="LE STUDIO SENSVINYLO">LE STUDIO SENSVINYLO</a></h3>
            </label>
            <div class="toggle-box-content">
                <p>Donnez vie à vos rêves en vinyle ! L'atelier studio SensVinylo est un havre de créativité où nos artisans talentueux transforment vos idées en décors uniques et personnalisés.</p>
                <p>Technologie de pointe, savoir-faire traditionnel et large choix de vinyles : tout est réuni pour créer des revêtements muraux, des sols et des œuvres d'art qui racontent votre histoire.</p>
            </div>
            <hr>
            <input class="toggle-box" id="toggleId-2" type="checkbox">
            <label for="toggleId-2">
                <h3><a href="studio-echo" aria-label="LE STUDIO ECHO">LE STUDIO ECHO</a></h3>
            </label>
            <div class="toggle-box-content">
                <p>L'atelier Echo est à l'écoute de vos envies. Nos designers travaillent en étroite collaboration avec vous pour créer des décors en vinyle qui reflètent votre personnalité et vos aspirations.</p>
            </div>
            <hr>
            <input class="toggle-box" id="toggleId-3" type="checkbox">
            <label for="toggleId-3">
                <h3><a href="studio-vintage" aria-label="LE STUDIO VINTAGE">LE STUDIO VINTAGE</a></h3>
            </label>
            <div class="toggle-box-content">
                <p>L'atelier Vintage vous propose une plongée dans l'univers du vintage. Motifs rétro, couleurs d'antan et matériaux authentiques : revisitez le passé avec des décors uniques et plein de charme.</p>
            </div>
            <hr>
            <input class="toggle-box" id="toggleId-4" type="checkbox">
            <label for="toggleId-4">
                <h3><a href="studio-azur" aria-label="LE STUDIO AZUR">LE STUDIO AZUR</a></h3>
            </label>
            <div class="toggle-box-content">
                <p>L'atelier studio Azur est dédié à la création d'ambiances marines et relaxantes. Des bleus profonds aux turquoises cristallines, nos vinyles sur mesure donneront à votre espace une touche de fraîcheur et d'évasion.</p>
            </div>
        </div>
    </div>
</section>

<section class="map">
    <div class="container">
        <div class="df-fdcr">
            <ul id="map">
                <li id="position1" title="Atelier SensVinylo" style="top: 39%; left: 59%;"><a href="https://maps.app.goo.gl/9dXb1h5dZ1V766B59" target="_blank" aria-label="Atelier SensVinylo">Atelier SensVinylo</a></li>
                <li id="position2" title="Atelier Vintage" style="top:48.15%; left: 53.9%;"><a href="https://maps.app.goo.gl/9dXb1h5dZ1V766B59" target="_blank" aria-label="Atelier Vintage">Atelier Vintage</a></li>
                <li id="position3" title="Atelier Azur" style="top: 50.3%; left: 31.57%;"><a href="https://maps.app.goo.gl/9dXb1h5dZ1V766B59" target="_blank" aria-label="Atelier Azur">Atelier Azur</a></li>
                <li id="position4" title="Atelier Echo" style="top: 30.3%; left: 41.57%;"><a href="https://maps.app.goo.gl/9dXb1h5dZ1V766B59" target="_blank" aria-label="Atelier Echo">Atelier Echo</a></li>
                <li id="position5" title="Plateau virtuel à venir" style="top: 77.9%; left: 25.57%;"><span aria-label="Plateau virtuel à venir">Plateau virtuel à venir</span></li>
            </ul>
        </div>
    </div>
</section>