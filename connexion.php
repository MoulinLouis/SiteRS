<?php

session_start();
require_once("app/functions.php"); ?>
<?php require_once("app/include/header.php"); ?>
<?php require_once("app/include/navbar.php"); ?>

<?php showMessage(); ?>
<!-- Hero section -->
<section class="hero-section set-bg" data-setbg="lib/img/1.png">
    <div class="container">
        <br><br>
        <br><br>
        <br><br>
        <br><br>
        <center>
            <div class="card col-md-6 align-content-center">
                <article class="card-body mx-auto" id="connexion_form">
                    <h4 class="card-title mt-3 text-center">Connexion</h4>
                    <form action="traitement/utilisateur/connexion-traitement.php" method="post">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="email" class="form-control" placeholder="Adresse email" type="email">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="mdp" class="form-control" placeholder="Mot de passe" type="password">
                        </div> <!-- form-group// -->
                        <p class="text-center text-white">Mot de passe oublié ? <a class="text-link" onclick="hide_login_form()" href="#">Cliquer ici</a> </p>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Se connecter </button>
                        </div> <!-- form-group// -->
                        <p class="text-center text-white">Pas encore inscrit ? <a class="text-link" href="inscription.php">S'inscrire</a> </p>
                    </form>


                </article>

                <article class="card-body mx-auto" id="forget_password_form_1" style="display: none;">
                    <h4 class="card-title mt-3 text-center">Mot de passe oublié</h4>
                    <form action="traitement/utilisateur/forget-password.php" method="post">
                        <p class="text-center text-white">Saisissez l'adresse e-mail associé à votre compte.</p>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="email" class="form-control" placeholder="Adresse email" type="email" required oninvalid="setCustomValidity('Veuillez entrer une adresse mail valide ex: test@gmail.com')" oninput="setCustomValidity('')>
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <button name="mdp_forget" type="submit" class="btn btn-primary btn-block"> Envoyer la clé </button>
                        </div> <!-- form-group// -->
                    </form>
                </article>


            </div>
        </center>
    </div>
</section>
<!-- Hero section end -->

<?php require_once("app/include/footer.php"); ?>
