<?php
include("app/utilisateur_management.php");

$result = new utilisateur_management();
$classes = $result->getClasses();
$utilisateur = $result->getUtilisateur($_COOKIE['user']);
?>

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
                <article class="card-body mx-auto">
                    <h4 class="card-title mt-3 text-center">Informations personnelles</h4>
                    <form action="traitement/utilisateur/modif_utilisateur-traitement.php" method="post" id="form_modif_user">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="nom" class="form-control" placeholder="Nom" value="<?php echo $utilisateur['nom'] ?>" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="prenom" class="form-control" placeholder="Prénom" value="<?php echo $utilisateur['prenom'] ?>" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="email" class="form-control" placeholder="Email" value="<?php echo $utilisateur['email'] ?>" type="text">
                        </div> <!-- form-group// -->
                        <a href="#" id="modif_mdp" class="modif_mdp" onclick="show_modif_mdp()">Modifier son mot de passe</a>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <button name="form_info" type="submit" class="btn btn-primary btn-block"> Enregistrer </button>
                            </div> <!-- form-group// -->
                            <div class="form-group col-md-6">
                                <input class="btn btn-primary btn-block" onclick="window.location='index.php';" value="Annuler">
                            </div> <!-- form-group// -->
                        </div>
                    </form>

                    <form name="form_mdp" action="traitement/utilisateur/modif_utilisateur-traitement.php" method="post" id="form_modif_mdp" style="display:none">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="old_mdp" class="form-control" placeholder="Ancien mot de passe" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="mdp1" class="form-control" placeholder="Mot de passe" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="mdp2" class="form-control" placeholder="Confirmer mot de passe" type="text">
                        </div> <!-- form-group// -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <button name="form_mdp" type="submit" class="btn btn-primary btn-block"> Enregistrer </button>
                            </div> <!-- form-group// -->
                            <div class="form-group col-md-6">
                                <input class="btn btn-primary btn-block" onclick="hide_modif_mdp()" value="Retour">
                            </div> <!-- form-group// -->
                        </div>
                    </form>
                </article>
            </div>
        </center>
    </div>
</section>
<!-- Hero section end -->

<?php require_once("app/include/footer.php"); ?>


