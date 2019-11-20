<?php
session_start();
require_once("app/functions.php"); ?>
<?php require_once("app/include/header.php"); ?>
<?php require_once("app/include/navbar.php"); ?>

<?php showMessage(); ?>

<div class="background_parallax">
<!-- Hero section -->
<section class="hero-section set-bg" data-setbg="lib/img/1.png">
    <div class="container">
        <br><br>
        <br><br>
        <br><br>
        <br><br>
        <center>
            <div class="card col-md-6 bg-light">
                <article class="card-body mx-auto">
                    <h4 class="card-title mt-3 text-center">Créer un compte</h4>
                    <form action="traitement/utilisateur/inscription-traitement.php" method="post" onsubmit="return checkForm(this);">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="nom" class="form-control" placeholder="Nom" type="text" required>
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="prenom" class="form-control" placeholder="Prénom" type="text" required>
                        </div> <!-- form-group// -->

                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="email" class="form-control" placeholder="Adresse email" type="email" required oninvalid="setCustomValidity('Veuillez entrer une adresse mail valide ex: test@gmail.com')" oninput="setCustomValidity('')">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="mdp1" class="form-control" placeholder="Mot de passe" type="password" required>
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="mdp2" class="form-control" placeholder="Entrer le à nouveau" type="password" required>
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> S'inscrire  </button>
                        </div> <!-- form-group// -->
                        <p class="text-center text-white">Déjà inscrit ? <a class="text-link" href="connexion.php">Se connecter</a> </p>
                    </form>
                </article>
            </div>
        </center>
    </div>
</section>
<!-- Hero section end -->
</div>

<?php require_once("app/include/footer.php"); ?>
<script>

</script>





