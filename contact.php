<?php require_once("app/functions.php"); ?>
<?php require_once("app/include/header.php"); ?>
<?php require_once("app/include/navbar.php"); ?>

<?php showMessage(); ?>



<!-- Hero section -->
<section class="hero-section set-bg" data-setbg="lib/img/4.jpg">
    <div class="container">
        <div class="hero-text text-white">
            <h2>Pour nous contacter</h2>
            <!-- A rendre beau + responsive
            <div class="col-md-2 offset-5">
                <a href="#contact" class="js-scroll-trigger btn btn-primary btn-block" onclick="scrollTo(event)"> Clique ici </a>
            </div>
            -->
        </div>

</div>
</section>
<!-- Hero section end -->

<!-- Page -->
<section class="contact-page spad pb-0" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-warp">
                    <div class="section-title text-white text-left">
                        <h2>Contactez-nous</h2>
                        <p>Si vous avez un quelconque soucis ou envi de nous faire part un retour, n'hésitez pas
                            <!doctype html>
                            <html lang="fr">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport"
                                      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                <title>Document</title>
                            </head>
                            <body>

                            </body>
                            </html></p>
                    </div>
                    <form method="post" action="traitement/post/contact_traitement.php" class="contact-form">
                        <input name="nom" type="text" placeholder="Votre nom">
                        <input name="mail" type="text" placeholder="Votre adresse email">
                        <input name="objet" type="text" placeholder="Objet">
                        <textarea name="texte" placeholder="Message">Bonjour, </textarea>
                        <button type="submit" class="site-btn">Envoyer le message</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info-area">
                    <div class="section-title text-left p-0">
                        <h2>Information de contact</h2>
                        <p>Vous retrouverez ci-dessous nos informations pour nous contacter directement</p>
                    </div>
                    <div class="phone-number">
                        <span>Ligne direct</span>
                        <h2>+33 6 59 73 74 57</h2>
                    </div>
                    <ul class="contact-list">
                        <li>5 avenue du Général de Gaulles<br>Paris, le Bourget</li>
                        <li>+33 6 59 73 74 57</li>
                        <li>lycee@robertschuman.fr</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page end -->

</body>


<?php require_once("app/include/footer.php"); ?>

</html>