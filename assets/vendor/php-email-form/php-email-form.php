<?php
/**
 * PHP Email Form
 * Version 2.3
 * https://bootstrapmade.com/php-email-form/
 **/

namespace PHPMailer;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class PHP_Email_Form
{
    private $toEmail;
    private $subject;
    private $fromEmail;
    private $fromName;
    private $message;
    private $smtp;

    public function __construct($toEmail, $subject, $fromEmail, $fromName, $smtp = null)
    {
        $this->toEmail = $toEmail;
        $this->subject = $subject;
        $this->fromEmail = $fromEmail;
        $this->fromName = $fromName;
        $this->smtp = $smtp;
    }

    public function send()
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';

        try {
            // Server settings
            if ($this->smtp) {
                $mail->isSMTP();
                $mail->Host       = $this->smtp['host'];
                $mail->SMTPAuth   = true;
                $mail->Username   = $this->smtp['username'];
                $mail->Password   = $this->smtp['password'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = $this->smtp['port'];
            }

            // Recipients
            $mail->setFrom($this->fromEmail, $this->fromName);
            $mail->addAddress($this->toEmail);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body    = $this->message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}
