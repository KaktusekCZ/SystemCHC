<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_mail($teacher_mail, $hash)
{
    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    try {
        //Server settings
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pcharvat346@gmail.com';
        $mail->Password = 'X&\t(4tp2;zae,SA';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('hodnoceni@creativehill.cz', 'Hodnocení učitele');
        $mail->smtpConnect(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            )
        );
        $mail->addAddress($teacher_mail, '');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Ověření emailu';
        $mail->Body = '<h1>Toto je můj hash - ' . $teacher_mail . '              ' . $hash . '</h1>';

        $mail->send();
        session_unset();
        session_destroy();
        session_write_close();
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
