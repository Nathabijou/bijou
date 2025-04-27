<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Assure-toi que le chemin est correct vers ton dossier PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécurisation des données
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Adresse de réception (remplace par la tienne)
    $to = "nathabijou@mail.com"; // <-- MODIFIE CETTE LIGNE

    // Création de l'objet PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();  // Utilise SMTP
        $mail->Host = 'smtp.gmail.com';  // Serveur SMTP Gmail
        $mail->SMTPAuth = true;  // Authentification SMTP
        $mail->Username = 'nathabijou@gmail.com';  // Ton email Gmail
        $mail->Password = 'ALGOPass1234';  // Ton mot de passe Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Sécurisation par TLS
        $mail->Port = 587;  // Port pour TLS

        // Expéditeur et destinataire
        $mail->setFrom($email, 'Nom');
        $mail->addAddress(nathabijou@gmail.com);  // Ajouter ton adresse de réception

        // Contenu de l'email
        $mail->isHTML(false);  // Utilisation de texte brut
        $mail->Subject = "Contact depuis le site : $subject";
        $mail->Body    = "Vous avez reçu un message depuis le formulaire de contact.\n\n" .
                         "Nom : $name\n" .
                         "Email : $email\n\n" .
                         "Sujet : $subject\n\n" .
                         "Message :\n$message\n";

                         //ikoa idbi tjar ucmo

        // Envoi de l'email
        if ($mail->send()) {
            echo "Message envoyé avec succès.";
        } else {
            echo "Erreur lors de l’envoi du message.";
        }
    } catch (Exception $e) {
        echo "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
    }
}
?>
