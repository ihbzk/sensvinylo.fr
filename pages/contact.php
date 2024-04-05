<?php include("functions/footer-contact-form.php"); ?>

<section class="contact">
    <div class="container" id="scroll-down-contact">
        <h2>Nous contacter</h2>
        <div class="contact-center">
            <div class="form-outer">
                <form method="post" id="footer-contact-form">
                    <div class="page slide-page">
                        <p class="text-contact">Vous avez un projet en tête ou besoin de renseignements supplémentaires ? N'hésitez pas à nous joindre directement via le formulaire de contact ci-dessous, ou par e-mail à <br><a href="mailto:<?= $conf_email ?>" class="footer-link"><?= $conf_email ?></a>.</p><br>
                        <div class="field">
				            <?= form_error($data["email"]); ?>
                            <input type="email" class="simple-form" name="email" placeholder="Entrez votre e-mail" value="<?= $data["email"]["value"]; ?>" required />
                        </div>
                        <div class="field">
				            <?= form_error($data["phone"]); ?>
                            <input type="tel" class="simple-form" name="phone" placeholder="Entrez votre téléphone" value="<?= $data["phone"]["value"]; ?>" required >
                        </div>
                        <div class="field">
                            <?= form_error($data["lastname"]); ?>
                            <input type="text" class="simple-form" name="lastname" placeholder="Entrez votre nom" value="<?= $data["lastname"]["value"]; ?>">
                        </div>
                        <div class="field">
                            <?= form_error($data["firstname"]); ?>
                            <input type="text" class="simple-form" name="firstname" placeholder="Entrez votre prénom" value="<?= $data["firstname"]["value"]; ?>">
                        </div>
                        <div class="field">
		                    <?= form_error($data["message"], "Veuillez fournir un message."); ?>
                            <textarea class="simple-form" name="message" placeholder="Entrez votre message" rows="8" required><?= $data["message"]["value"]; ?></textarea>
                        </div>
                        <?= form_error($data["rgpd"], "Veuillez accepter les conditions"); ?>
                        <label for="rgpd">
                            <input type="checkbox" class="simple-form" name="rgpd" <?php if ($data["rgpd"]["value"]) echo "checked"; ?>>
                            En utilisant ce formulaire, vous acceptez le stockage et la gestion de vos données par ce site *
                        </label><br><br>
                        <div class="field btns">
                            <button type="submit" value="Demande de contact" class="submit form-submit" name="footer-contact">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>