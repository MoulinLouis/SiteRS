<?php
// Fonction permettant d'afficher un message de succès
function getSuccess($message, $chemin) {
    $_SESSION['message'] = $message;
    $_SESSION['success'] = True;
    header('location: '.$chemin.'');
}

// Fonction permettant d'afficher une erreur
function getError($message, $chemin) {
    $_SESSION['message'] = $message;
    $_SESSION['error'] = True;
    header('location: '.$chemin.'');
}
// Fonction à insérer sur les pages recevant des messages de succès / d'erreur afin des les afficher
function showMessage() {
    if(isset($_SESSION['message']) && isset($_SESSION['success'])) { ?>
        <script type="text/javascript">
            Swal.fire(
                'Succès',
                '<?php echo $_SESSION['message'] ?>',
                'success'
            )
        </script>
        <?php
        unset($_SESSION['message']);
        unset($_SESSION['success']);
    }
    if(isset($_SESSION['message']) && isset($_SESSION['error'])) { ?>
        <script type="text/javascript">
            Swal.fire(
                'Erreur',
                '<?php echo $_SESSION['message'] ?>',
                'error'
            )
        </script>
    <?php
        unset($_SESSION['message']);
        unset($_SESSION['error']);
    }

}

/**
 * @param int $longueur
 * @return string
 */
// Retourne une chaîne de caractère aléatoire de longueur $longueur (par défaut à 6)
function genererChaineAleatoire($longueur = 6) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longueurMax = strlen($caracteres);
    $chaineAleatoire = '';
    for ($i = 0; $i < $longueur; $i++) {
        $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
    }
    return $chaineAleatoire;
}

/**
 * @param $to
 * @param $from
 * @param $from_name
 * @param $subject
 * @param $body
 * @return bool|string
 * @throws phpmailerException
 */
// Fonction permettant d'envoyer un email par le SMTP de gmail
function smtpMailer($to, $from, $from_name, $subject, $body) {
    $mail = new PHPMailer();  // Cree un nouvel objet PHPMailer
    $mail->IsSMTP(); // active SMTP
    $mail->SMTPDebug = 0;  // debogage: 1 = Erreurs et messages, 2 = messages seulement
    $mail->SMTPAuth = true;  // Authentification SMTP active
    $mail->SMTPSecure = 'ssl'; // Gmail REQUIERT Le transfert securise
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8';
    $mail->Username = GMailUser;
    $mail->Password = GMailPWD;
    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->IsHTML(true);
    $mail->AddAddress($to);
    if(!$mail->Send()) {
        return 'Mail error: '.$mail->ErrorInfo;
    } else {
        return true;
    }
}
?>


