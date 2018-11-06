<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_mail($teacher_mail){
    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'smtp-190217.m17.wedos.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'test@charvatpetr.cz';
        $mail->Password = '#FNec3sCZ';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('test@charvatpetr.cz', 'Hodnocení učitele');
        $mail->smtpConnect(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            )
        );
        $mail->addAddress($teacher_mail, '');     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Ověření emailu';
        $mail->Body    = 'Toto je můj mail - ' . $teacher_mail;

        $mail->send();
        session_unset();
        session_destroy();
        session_write_close();
        header("Location: ../login/?status=verify");
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
