<?php
/**
 * Requires the "PHP Email Form" library
 * The "PHP Email Form" library is available only in the pro version of the template
 * The library should be uploaded to: vendor/php-email-form/php-email-form.php
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'lazraksiwar3@gmail.com';

require '../assets/vendor/php-email-form/php-email-form.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'lazraksiwar3@gmail.com';
$mail->Password = 'dfblakxtpwefulik';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->SMTPSecure = false;
$mail->SMTPAutoTLS = false;

$mail->setFrom($_POST['email'], $_POST['name']);
$mail->addAddress($receiving_email_address);

$mail->isHTML(true);
$mail->Subject = $_POST['subject'];
$mail->Body = $_POST['message'];

try {
    $mail->send();
    echo 'Message sent successfully.';
} catch (Exception $e) {
    echo 'An error occurred while sending the message: ' . $e->getMessage();
}
?>
