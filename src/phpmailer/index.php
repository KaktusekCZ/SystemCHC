<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_mail($teacher_mail, $hash, $domain)
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
        $mail->Body = '<body>
<table style="table-layout:fixed" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F5F5">
    <tbody>
    <tr>
        <td width="100%" bgcolor="#F5F5F5" align="center">

            <table width="620" cellspacing="0" cellpadding="0" border="0" align="center">
                <tbody>
                <tr>
                    <td width="620">


                        <div>
                            <table style="width:100%;min-width:100%" width="100%" cellspacing="0" cellpadding="0"
                                   border="0" bgcolor="#ffd500" align="center">
                                <tbody>
                                <tr>
                                    <td width="30"></td>
                                    <td valign="middle" height="80" align="left">
                                        <a href="https://www.creativehill.cz/"
                                           target="_blank">
                                            <img style="display:block;border:0 none;width:76px;height:auto"
                                                 src="https://creativehill.cz/resources/images/chc-logo-black.svg"
                                                 alt="CHC logo" width="76">
                                        </a>
                                    </td>
                                    <td width="30"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div style="border-style:none">
                            <table style="width:100%;min-width:100%" width="100%" cellspacing="0" cellpadding="0"
                                   border="0" bgcolor="#FFFFFF" align="center">
                                <tbody>
                                <tr>
                                    <td width="30"></td>
                                    <td style="padding:20px 0 20px 0;color:#222c37;font-family:\'Roboto\',Arial,sans-serif;font-weight:100;font-size:24px;line-height:30px;margin:0;text-align:center">
                                        Dobrý den,
                                    </td>
                                    <td width="30"><br></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                        <div>
                            <table style="width:100%;min-width:100%" width="100%" cellspacing="0" cellpadding="0"
                                   border="0" bgcolor="#FFFFFF" align="center">
                                <tbody>
                                <tr>
                                    <td width="30"></td>
                                    <td style="padding:0px 0px 20px;color:rgb(34,44,55);font-family:&quot;Roboto&quot;,Arial,sans-serif;font-weight:300;font-size:15px;line-height:21px;margin:0px;text-align:center;border-style:none">
                                        Děkujeme za Vaši registraci. Pro ověření emailu prosím klikněte na<br>
                                        následující odkaz
                                    </td>
                                    <td width="30"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <table style="width:100%;min-width:100%" width="100%" cellspacing="0" cellpadding="0"
                                   border="0" bgcolor="#FFFFFF" align="center">

                                <tbody>
                                <tr>
                                    <td width="30"></td>
                                    <td style="padding:0 0 20px 0;color:#222c37;font-family:\'Roboto\',Arial,sans-serif;font-weight:500;font-size:15px;line-height:21px;margin:0"
                                        align="center">

                                        <table style="background-color:#ffd500;border-radius:3px" cellspacing="0"
                                               cellpadding="0" border="0">
                                            <tbody>
                                            <tr>
                                                <td style="color:#ffffff;font-family:\'Roboto\',Arial,sans-serif;font-size:14px;font-weight:500;line-height:150%;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px"
                                                    valign="middle" align="center">
                                                    <a style="color:#000;text-decoration:none"
                                                       href="' . $domain . 'verify/?code=' . $hash . '"
                                                       target="_blank">
                                                        Ověřit</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </td>
                                    <td width="30"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>';

        $mail->send();
        session_unset();
        session_destroy();
        session_write_close();
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
