<?php
include("app/postevent_management.php");
$result = new postevent_management();
$posts = $result->getEvents();

session_start();
?>

<?php require_once("app/functions.php"); ?>
<?php require_once("app/include/header.php"); ?>
<?php require_once("app/include/navbar.php"); ?>

<?php showMessage(); ?>

<!-- Hero section -->
<section class="hero-section set-bg" data-setbg="lib/img/3.jpeg">
    <div class="container">
        <div class="hero-text text-white">
            <h2>Les évènements</h2>
            <p>Vous pourrez retrouver tous types d'évènements <br> proposés par l'école. <br></p>
            <!-- A rendre beau + responsive
            <div class="col-md-2 offset-5">
                <a href="#event" class="js-scroll-trigger btn btn-primary btn-block" onclick="scrollTo(event)"> Voir les events </a>
            </div>
            -->

        </div>

    </div>
</section>
<!-- Hero section end -->

<!-- categories section -->
<section id="event" class="categories-section spad">
    <div class="container">
        <div class="row">
            <?php foreach($posts as $post) { ?>
            <!-- categorie -->
            <div class="col-lg-4 col-md-6 event">
                <div class="categorie-item">
                    <div class="ci-text">
                        <h5 class="black"><?php echo $post['titre']; ?></h5>
                        <p><?php echo $post['texte']; ?></p>
                        <span>Posté le <?php echo $post['date']; ?></span>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- categories section end -->












</body>


<?php require_once("app/include/footer.php"); ?>


</html>