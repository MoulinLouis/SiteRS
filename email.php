<?php
require 'app/phpmailer/class.phpmailer.php';
require 'app/phpmailer/class.smtp.php';
define('GMailUser', 'siters93440@gmail.com');
define('GMailPWD', 'Robertschuman');

function smtpMailer($to, $from, $from_name, $subject, $body) {
    $mail = new PHPMailer();  // Cree un nouvel objet PHPMailer
    $mail->IsSMTP(); // active SMTP
    $mail->SMTPDebug = 0;  // debogage: 1 = Erreurs et messages, 2 = messages seulement
    $mail->SMTPAuth = true;  // Authentification SMTP active
    $mail->SMTPSecure = 'ssl'; // Gmail REQUIERT Le transfert securise
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = GMailUser;
    $mail->Password = GMailPWD;
    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    if(!$mail->Send()) {
        return 'Mail error: '.$mail->ErrorInfo;
    } else {
        return true;
    }
}
$result = smtpmailer('playfade93@gmail.com', 'siters93440@gmail.com', 'Playfade', 'Votre Message', 'Le sujet de votre message');
if (true !== $result)
{
    // erreur -- traiter l'erreur
    echo $result;
}

?>