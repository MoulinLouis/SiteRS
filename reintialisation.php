<?php require_once("app/functions.php"); ?>
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

                <article class="card-body mx-auto" id="forget_password_form_2">
                    <h4 class="card-title mt-3 text-center">Mot de passe oublié</h4>
                    <form action="traitement/utilisateur/forget-password.php" method="post">
                        <p class="text-center text-white">Saisissez la clé qui vous a été envoyé par email</p>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-key"></i> </span>
                            </div>
                            <input name="decryptKey" class="form-control" placeholder="Clé (exemple : xXx123)" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="mdp" class="form-control" placeholder="Nouveau mot de passe" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <button name="modif_mdp" type="submit" class="btn btn-primary btn-block"> Soumettre </button>
                        </div> <!-- form-group// -->
                    </form>
                </article>

            </div>
        </center>
    </div>
</section>
<!-- Hero section end -->

<?php require_once("app/include/footer.php"); ?>
