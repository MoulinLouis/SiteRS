// Pour la modification de mot de passe lors de l'édition de son profil
var modif_mdp = document.getElementById("modif_mdp");
var form_modif_mdp = document.getElementById("form_modif_mdp");
var form_modif_user = document.getElementById("form_modif_user");
function show_modif_mdp() {
    form_modif_mdp.style.display = 'block';
    form_modif_user.style.display = 'none';
    modif_mdp.style.display = 'none';
}
function hide_modif_mdp() {
    form_modif_mdp.style.display = 'none';
    form_modif_user.style.display = 'block';
    modif_mdp.style.display = 'block';
}
// FIN

// Pour séparer l'affichage entre les différents onglets du panel admin
var panel_admin = document.getElementById("panel_admin");
var liste_users = document.getElementById("liste_users");
var liste_events = document.getElementById("liste_events");

// On cache les autres affichages des onglets et on affiche celui qu'on veut (Liste utilisateur)
function toListeUser() {
    panel_admin.style.display = 'none';
    liste_events.style.display = 'none';
    liste_users.style.display = 'block';
}
// On cache les autres affichages des onglets et on affiche celui qu'on veut (Panel Admin)
function toPanelAdmin() {
    liste_users.style.display = 'none';
    liste_events.style.display = 'none';
    panel_admin.style.display = 'block';
}
// On cache les autres affichages des onglets et on affiche celui qu'on veut (Liste évènements)
function toListeEvent() {
    liste_users.style.display = 'none';
    panel_admin.style.display = 'none';
    liste_events.style.display = 'block';
}
// FIN

// Pour mot de passe oublié
var connexion_form = document.getElementById("connexion_form");
var forget_password_form_1 = document.getElementById("forget_password_form_1");
var forget_password_form_2 = document.getElementById("forget_password_form_2");
function hide_login_form() {
    connexion_form.style.display='none';
    forget_password_form_1.style.display='block';
}
function hide_forget_password_form_1() {
    forget_password_form_2.style.display='block';
    forget_password_form_1.style.display='none';
}
// Edite user au panel admin

// FIN

// Formulaire message
var msg_form = document.getElementById("msg_form");
var btn_add_msg = document.getElementById("btn_add_msg");
var btn_retour_msg = document.getElementById("btn_retour_msg");

// On affiche le formulaire pour créer un message
// On affiche le bouton "Retour"
// On cache le bouton "Ajouter un message"
function show_form_msg() {
    msg_form.style.display='block';
    btn_retour_msg.style.display='block';
    btn_add_msg.style.display='none';
}
// On cache le formulaire pour créer un message
// On cache le bouton "Retour"
// On affiche le bouton "Ajouter un message"
function hide_form_msg() {
    msg_form.style.display='none';
    btn_retour_msg.style.display='none';
    btn_add_msg.style.display='block';

}
// FIN

// Formulaire évènement
var event_form = document.getElementById("event_form");
var btn_add_event = document.getElementById("btn_add_event");
var btn_retour_event = document.getElementById("btn_retour_event");

// On affiche le formulaire pour créer un évènement
// On affiche le bouton "Retour"
// On cache le bouton "Ajouter un évènement"
function show_form_event() {
    event_form.style.display='block';
    btn_retour_event.style.display='block';
    btn_add_event.style.display='none';
}
// On cache le formulaire pour créer un évènement
// On cache le bouton "Retour"
// On affiche le bouton "Ajouter un évènement"
function hide_form_event() {
    event_form.style.display='none';
    btn_retour_event.style.display='none';
    btn_add_event.style.display='block';
}
// On affiche le formulaire pour envoyer un email
// On affiche le bouton "Retour"
// On cache le bouton "Envoyer un email"
function show_form_mail() {
    mail_form.style.display='block';
    btn_retour_mail.style.display='block';
    btn_add_mail.style.display='none';
}
// On cache le formulaire pour envoyer un email
// On cache le bouton "Retour"
// On affiche le bouton "Envoyer un email"
function hide_form_mail() {
    mail_form.style.display='none';
    btn_retour_mail.style.display='none';
    btn_add_mail.style.display='block';
}
// FIN

// Gestion d'erreur pour le mot de passe à l'inscription
var mdp1 = document.getElementById("mdp1");
var mdp2 = document.getElementById("mdp2");
function checkForm(form) {
    if(form.mdp1.value !== "" && form.mdp1.value === form.mdp2.value) {
        if(form.mdp1.value.length < 6) {
            Swal.fire(
                'Erreur',
                'Le mot de passe doit contenir au moins 6 caractères',
                'error'
            );
            form.mdp1.focus();
            return false;
        }
        re = /[0-9]/;
        if(!re.test(form.mdp1.value)) {
            Swal.fire(
                'Erreur',
                'Le mot de passe doit au moins contenir un chiffre (0-9)',
                'error'
            );
            form.mdp1.focus();
            return false;
        }
        re = /[a-z]/;
        if(!re.test(form.mdp1.value)) {
            Swal.fire(
                'Erreur',
                'Le mot de passe doit contenir au moins une minuscule',
                'error'
            );
            form.mdp1.focus();
            return false;
        }
        re = /[A-Z]/;
        if(!re.test(form.mdp1.value)) {
            Swal.fire(
                'Erreur',
                'Le mot de passe doit contenir au moins une majuscule',
                'error'
            );
            form.mdp1.focus();
            return false;
        }
    } else {
        Swal.fire(
            'Erreur',
            'Vérifiez que les 2 mots de passes correspondent',
            'error'
        );
        form.mdp1.focus();
        return false;
    }
}