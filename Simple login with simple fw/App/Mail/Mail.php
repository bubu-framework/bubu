<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    /**
     * @param string $to
     * @param string $subject
     * @param string $message
     * 
     * @return bool
     */
    public static function sendMail(
        string $to,
        string $subject,
        string $message
    ): bool {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->SMTPOptions = [
            'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
        ];

        $mail->SMTPDebug = $_ENV['SMTP_DEBUG'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->Port = $_ENV['SMTP_PORT'];
        $mail->Username = $_ENV['SMTP_USERNAME'];
        $mail->Password = $_ENV ['SMTP_PASSWORD'];

        $mail->setFrom($_ENV['FROM'], $_ENV['FROM_NAME']);
        $mail->addReplyTo($_ENV['REPLY'], $_ENV['REPLY_NAME']);
        $mail->Subject = $subject;

        $mail->msgHTML($message, __DIR__);
        $mail->AltBody = 'Error to view message';
        $mail->AddAddress($to);

        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
}
