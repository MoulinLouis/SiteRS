<!-- Header section -->
<center>
    <header class="header-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <nav class="main-menu">
                        <ul>
                            <li><a href="index.php">Accueil</a></li>
                            <?php
                            if(isset($_COOKIE['role'])) {
                                if($_COOKIE['role'] == 2) { ?>
                                    <li><a href="admin.php">Panel admin</a></li>
                                <?php } elseif($_COOKIE['role'] == 1) { ?>
                                    <li><a href="membre.php">Espace membre</a></li>
                                <?php } }?>

                            <li><a href="chat.php">Chat membres</a></li>

                            <li><a href="event.php">Evènements</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <?php if(empty($_COOKIE['user'])) { ?>
                                <li><a href="connexion.php">Connexion</a></li>
                                <li><a href="inscription.php">Inscription</a></li>
                            <?php } ?>
                            <?php if(isset($_COOKIE['user'])) { ?>
                                <li><a href="traitement/utilisateur/deconnexion-traitement.php">Deconnexion</a></li>
                            <?php } ?>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</center>
<!-- Header section end -->