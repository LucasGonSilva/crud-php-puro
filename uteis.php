<?php

include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/vendor/autoload.php';

class Uteis
{
    public function sendEmail($link, $dados)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $GLOBALS['hostServer'];                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $GLOBALS['usernameServer'];                       //SMTP username
            $mail->Password   = $GLOBALS['passwordServer'];                       //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = $GLOBALS['portServer'];                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('suporte@lsgontecnologia.com.br', 'Suporte');
            $mail->addAddress($dados['email'], $dados['name']);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Recuperar senha';
            $mail->Body    = 'Prezado(a) ' . $dados['name'] . '. <br><br>Você solicitou alteração de senha.<br><br>
                              Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br>
                              <a href="' . $link . '" target="_blank">' . $link . '</a><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br>';
            $mail->AltBody = 'Prezado(a) ' . $dados['name'] . "\n\nVocê solicitou alteração de senha.
            \n\nPara continuar o processo de recuperação de sua senha, clique no link abaixo ou 
            cole o endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n";

            $mail->send();

            return $dados = [
                'msg' => 'ok',
                'error' => false
            ];
            
        } catch (Exception $e) {
            echo "Error: E-mail não enviado com sucesso. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
