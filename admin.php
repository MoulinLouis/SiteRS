<?php
session_start();
include("app/utilisateur_management.php");
include("app/postevent_management.php");
require_once('app/functions.php');

// Si l'utilisateur n'est pas connecté ou n'est pas le rôle administrateur, on le redirige à l'index
if(!isset($_COOKIE['user']) || !isset($_COOKIE['role']) || $_COOKIE['role'] != 2) {
    header('location: index.php');
}

// On fait appel à la classe utilisateur_management
$utilisateur_management = new utilisateur_management();
// On fait appel à la classe postevent_management
$postevent_management = new postevent_management();

$utilisateurs = $utilisateur_management->getUtilisateurs();
$mails = $utilisateur_management->getMails();
$nb_user = $utilisateur_management->countAllUser();
$nb_user_online = $utilisateur_management->countUserOnline();
$users_online = $utilisateur_management->listUserOnline();

$events = $postevent_management->getEvents();

?>

<?php require_once("app/include/header.php"); ?>

<?php showMessage(); ?>


<body>
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">



        <div class="collapse navbar-collapse" id="sidenav-collapse-main">


            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" onclick="toPanelAdmin()" href="javascript:void(0)">
                        <i class="fa fa-home"></i> Panel admin
                    </a>
                    <a class="nav-link" onclick="toListeUser()" href="javascript:void(0)">
                        <i class="fa fa-users"></i> Liste utilisateurs
                    </a>
                    <a class="nav-link" onclick="toListeEvent()" href="javascript:void(0)">
                        <i class="fa fa-calendar"></i> Liste évènements
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>




<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-tp navbar-expand-md navbar-dark bg-primary" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h5 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.php">Accueil</a>
            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="traitement/utilisateur/deconnexion-traitement.php" role="button">
                        <div class="media align-items-center">

                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">Déconnexion</span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Panel admin -->
    <div class="container-fluid" id="panel_admin"><br>
        <p>Nombre d'utilisateur inscrit : <?php echo $nb_user[0] ?></p>
        <p>Il y a actuellement <?php echo $nb_user_online[0] ?> utilisateur(s) actuellement en ligne</p>
        <p>Liste des utilisateur(s) connectée(s) : </p>
        <?php
        foreach($users_online as $user_online) { ?>
            <p> - <?php echo $user_online[0] ?></p>
        <?php
        }
        ?>

    </div>

    <!-- Liste utilisateurs -->
    <div style="display: none;"  class="container-fluid" id="liste_users"><br/>
        <button type="button" class="btn btn-dark offset-5" onclick="show_form_mail()" id="btn_add_mail">Envoyer un Email</button>

        <button type="button" class="btn btn-dark offset-5" onclick="hide_form_mail()" id="btn_retour_mail" style="display: none;">Retour</button><br/>
        <div class="row" id="mail_form" style="display: none;">
            <div class="col-lg-4 offset-4">
                <form method="post" action="traitement/post/sendmail_traitement.php">
                    <div class="form-group">
                        <label for="mail_select">Choix du destinataire</label>

                        <select name="mail" id="mail_select" required>
                            <option value="">Aucun</option>
                            <?php
                            foreach($mails as $mail) {
                                if($mail['email'] != 'admin@admin') { ?>
                            <option ><?php echo $mail['email'] ?></option>
                            <?php
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Objet</label>
                        <input name="objet" type="text" class="form-control" placeholder="Objet" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="texte" class="form-control" rows="6" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Envoyer mon Email </button>
                    </div> <!-- form-group// -->
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <h4 class="mt-5 black">Tableau avec les utilisateurs</h4><br>
                <button type="button" name="btn_add_user2" id="btn_add_user2" class="btn btn-xs btn-success">Ajouter un utilisateur &nbsp;<i class="fa fa-plus"></i></button>
                <br />
                <br />

                <div class="table-responsive">
                    <span id="result"></span>
                    <div id="live_data_user"></div>
                </div>
            </div>

        </div>

    </div>

        <!-- Liste évènements -->
        <div class="container-fluid" id="liste_events" style="display: none;"><br>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="mt-5 black">Tableau avec les évènements</h4><br>
                    <button type="button" name="btn_add_event2" id="btn_add_event2" class="btn btn-xs btn-success">Ajouter un évènement &nbsp;<i class="fa fa-plus"></i></button>
                    <br />
                    <br />
                    <div class="table-responsive">
                        <span id="result"></span>
                        <div id="live_data_event"></div>
                    </div>

                </div>
            </div>
        </div>
        </div>


</body>

<?php require_once("app/include/footer.php"); ?>

<script>


    $(document).ready(function(){
        $(document).on('click', '#btn_add_event2', function(){
            Swal.mixin({
                input: 'text',
                confirmButtonText: 'Suivant &rarr;',
                cancelButtonText: "Annuler",
                showCancelButton: true,
                progressSteps: ['1', '2']
            }).queue([
                {
                    title: 'Titre',
                    text: 'Veuillez insérer du texte',
                    inputValidator: function(value) {
                        if(value === '') {
                            return !value && 'Vous devez écrire quelque chose!'}
                    }
                },
                {
                    title: 'Texte',
                    text: 'Veuillez insérer du texte',
                    confirmButtonText: 'Ajouter &plus;',
                    inputValidator: function(value) {
                        if(value === '') {
                            return !value && 'Vous devez écrire quelque chose!'}
                    }
                }
            ]).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: "traitement/table_event/ajout_event.php",
                        method: "POST",
                        data: {reponse: result.value},
                        dataType: "text",
                        success: function (data) {
                            Swal.fire({
                                type: 'success',
                                title: 'Validation',
                                text: data,
                            });
                            fetch_data_event();
                        }
                    });
                }
            })
        });

            function fetch_data_event() {
            $.ajax({
                url:"traitement/table_event/recup_event.php",
                method:"POST",
                success:function(data){
                    $('#live_data_event').html(data);
                }
            });
        }
        fetch_data_event();

        function edit_data_event(id, text, column_name)
        {
            $.ajax({
                url:"traitement/table_event/modif_event.php",
                method:"POST",
                data:{id:id, text:text, column_name:column_name},
                dataType:"text",
                success:function(data){
                    Swal.fire({
                        type: 'success',
                        title: 'Validation',
                        text: data,
                    });
                }
            });
        }

        $(document).on('blur', '.titre_event', function(){
            var id = $(this).data("id1");
            var titre = $(this).text();
            edit_data_event(id, titre, "titre");
        });
        $(document).on('blur', '.texte_event', function(){
            var id = $(this).data("id2");
            var texte = $(this).text();
            edit_data_event(id,texte, "texte");
        });


        $(document).on('click', '.btn_delete_event', function(){
            var id=$(this).data("id3");
            if(confirm("Êtes-vous sur de vouloir supprimer ceci ?"))
            {
                $.ajax({
                    url:"traitement/table_event/suppr_event.php",
                    method:"POST",
                    data:{id:id},
                    dataType:"text",
                    success:function(data){
                        Swal.fire({
                            type: 'success',
                            title: 'Validation',
                            text: data,
                        });
                        fetch_data_event();
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        $(document).on('click', '#btn_add_user2', function(){
            Swal.mixin({
                input: 'text',
                confirmButtonText: 'Suivant &rarr;',
                cancelButtonText: "Annuler",
                showCancelButton: true,
                progressSteps: ['1', '2', '3', "4"]
            }).queue([
                {
                    title: 'Nom',
                    text: 'Veuillez insérer un nom',
                    inputValidator: function(value) {
                        if(value === '') {
                            return !value && 'Vous devez écrire quelque chose!'}
                    }
                },
                {
                    title: 'Prénom',
                    text: 'Veuillez insérer un prénom',
                    inputValidator: function(value) {
                        if(value === '') {
                            return !value && 'Vous devez écrire quelque chose!'}
                    }
                },
                {
                    title: 'Email',
                    text: 'Veuillez insérer une adresse email',
                    inputValidator: function(value) {
                        if(value === '') {
                            return !value && 'Vous devez écrire quelque chose!'}
                    }
                },
                {
                    title: 'Mot de passe',
                    text: 'Veuillez entrer un mot de passe',
                    input: 'password',
                    confirmButtonText: 'Ajouter &plus;',
                    inputValidator: function(value) {
                        if(value === '') {
                            return !value && 'Vous devez écrire quelque chose!'}
                    }
                }
            ]).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "traitement/table_user/ajout_user.php",
                        method: "POST",
                        data: {reponse: result.value},
                        dataType: "text",
                        success: function (data) {
                            Swal.fire({
                                type: 'success',
                                title: 'Validation',
                                text: data,
                            });
                            fetch_data_user();
                        }
                    });
                }
            })
        });


        function fetch_data_user() {
            $.ajax({
                url:"traitement/table_user/recup_user.php",
                method:"POST",
                success:function(data){
                    $('#live_data_user').html(data);
                }
            });
        }
        fetch_data_user();
        $(document).on('click', '#btn_add_user', function(){
            var nom = $('#nom_user').text();
            var prenom = $('#prenom_user').text();
            var email = $('#email_user').text();
            var mdp = $('#mdp_user').text();
            if(nom == '') {
                Swal.fire(
                    'Attention',
                    'Veuillez entrer un nom',
                    'warning'
                );
                return false;
            }
            if(prenom == '') {
                Swal.fire(
                    'Attention',
                    'Veuillez entrer un prénom',
                    'warning'
                );
                return false;
            }
            if(email == '') {
                Swal.fire(
                    'Attention',
                    'Veuillez entrer un email',
                    'warning'
                );
                return false;
            }
            if(mdp == '') {
                Swal.fire(
                    'Attention',
                    'Veuillez entrer un mot de passe',
                    'warning'
                );
                return false;
            }
            $.ajax({
                url:"traitement/table_user/ajout_user.php",
                method:"POST",
                data:{nom:nom, prenom:prenom, email:email, mdp:mdp},
                dataType:"text",
                success:function(data) {
                    Swal.fire({
                        type: 'success',
                        title: 'Validation',
                        text: data,
                    });
                    fetch_data_user();
                }
            })
        });

        function edit_data_user(id, text, column_name)
        {
            $.ajax({
                url:"traitement/table_user/modif_user.php",
                method:"POST",
                data:{id:id, text:text, column_name:column_name},
                dataType:"text",
                success:function(data){
                    Swal.fire({
                        type: 'success',
                        title: 'Validation',
                        text: data,
                    });
                }
            });
        }
        $(document).on('blur', '.nom_user', function(){
            var id = $(this).data("id4");
            var nom = $(this).text();
            edit_data_user(id, nom, "nom");
        });
        $(document).on('blur', '.prenom_user', function(){
            var id = $(this).data("id5");
            var prenom = $(this).text();
            edit_data_user(id,prenom, "prenom");
        });
        $(document).on('blur', '.email_user', function(){
            var id = $(this).data("id6");
            var email = $(this).text();
            edit_data_user(id,email, "email");
        });

        $(document).on('click', '#btn_classe', function(){
            var id=$(this).data("id7");
            var id_classe=$(this).data("id9");
            const { value: classe } = Swal.fire({
                title: 'Attribution de classe',
                input: 'select',
                inputOptions: {
                    15: 'SLAM',
                    16: 'SISR',
                    17: 'SEN',
                    18: 'TU',
                    19: 'MEI',
                    20: 'CPRP',
                },
                inputValue: id_classe,
                inputPlaceholder: 'Selectionner une classe',
                showCancelButton: true,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value) {
                            $.ajax({
                                url:"traitement/table_user/classe_user.php",
                                method:"POST",
                                data:{id:id,classe:value},
                                dataType:"text",
                                success:function(data){
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Validation',
                                        text: data,
                                    });
                                    fetch_data_user();
                                }
                            });
                            resolve();
                        } else {
                            resolve('Veuillez choisir une classe')
                        }
                    })
                }
            });
        });

        $(document).on('click', '.btn_delete_user', function(){
            var id=$(this).data("id8");
            if(confirm("Êtes-vous sur de vouloir supprimer ceci ?"))
            {
                $.ajax({
                    url:"traitement/table_user/suppr_user.php",
                    method:"POST",
                    data:{id:id},
                    dataType:"text",
                    success:function(data){
                        Swal.fire({
                            type: 'success',
                            title: 'Validation',
                            text: data,
                        });
                        fetch_data_user();
                    }
                });
            }
        });
    });
</script>

</html>