<?php
include("app/functions.php");

include("app/message_management.php");
$message_management = new message_management();
$messages = $message_management->getMessage();

session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require_once("app/include/header.php"); ?>
<?php require_once("app/include/navbar.php"); ?>
<?php showMessage(); ?>

<body>
<!-- Hero section -->
<section class="hero-section set-bg" data-setbg="lib/img/2.jpeg">
    <div class="container">
        <div class="hero-text text-white">
            <h2>Les messages</h2>
            <p>Postez tous types de messages <br> ici.</p><br>
            <div class="col-md-2 offset-5">
            <a href="#chat" class="js-scroll-trigger btn btn-primary btn-block" onclick="scrollTo(event)"> Voir les messages </a>
            </div>
        </div>

    </div>
</section>
<!-- Hero section end -->



<!-- categories section -->
<section class="categories-section spad" id="chat">
    <div class="container">
        <?php if(isset($_COOKIE['user'])) { ?>
        <button type="button" class="btn btn-dark offset-5" onclick="show_form_msg()" id="btn_add_msg">Ajouter un message</button>

        <button type="button" class="btn btn-dark offset-5" onclick="hide_form_msg()" id="btn_retour_msg" style="display: none;">Retour</button>

            <br><br>
<div id="msg_form" style="display: none">
        <div class="col-md-4 offset-4">
            <form id="form_msg" action="traitement/post/message_traitement.php" method="post">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="titre" class="form-control" placeholder="Titre" type="text">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <textarea rows="10" name="texte" class="form-control" placeholder="Texte du message" type="text"></textarea>
                </div> <!-- form-group// -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Poster </button>
                </div> <!-- form-group// -->
            </form>
        </div>
</div>
        <?php } ?>

        <?php
        if(!empty($messages)) {
            foreach ($messages as $message) { ?>

                <div class="featured-course course-item col-md-8 offset-2">
                    <div class="course-info">
                        <div class="course-text">
                            <h5 class="black"><?php echo $message['titre']; ?></h5>
                            <p><?php echo $message['texte']; ?></p>
                            <div class="students"><?php echo $message['date']; ?></div>
                        </div>

                        <div class="course-author">
                            <p><?php echo $message['nom'] . ' ' . $message['prenom'] ?>
                                <span><?php echo $message['nom_classe']; ?></span></p>
                        </div>
                        <?php if(isset($_COOKIE['user']) && $_COOKIE['user'] == $message['utilisateur']) { ?>
                            <form action="traitement/post/delete_msg-traitement.php" method="post">
                                <button type="submit" value="<?php echo $message['id_message'] ?>" name="id_message" id="btn_delete_msg" class="btn btn-xs btn-danger">Supprimer &nbsp;<i class="fa fa-trash"></i></button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            <?php }
        } else { ?>
                <div class="section-title mb-0">
                    <h2 style="color: black">Pas de message postés</h2>
                </div>
        <?php } ?>
    </div>
</section>
<!-- categories section end -->

</body>

<script type="text/javascript">

</script>
<script src="lib/js/customJS.js"></script>
<?php require_once("app/include/footer.php"); ?>


</html>