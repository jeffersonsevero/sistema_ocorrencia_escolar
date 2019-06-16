<?php

require "phpmailer/PHPMailer.php";
require "phpmailer/POP3.php";
require "phpmailer/SMTP.php";
require "phpmailer/OAuth.php";
require "phpmailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mensagem{
    private $para = null;
    private $assunto = null;
    private $mensagem = null;


    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    public function mensagemValida(){
        if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)){
            return false;
        }
        return true;
    }


    public function enviarEmail($emailResponsavel, $nomeResponsavel, $nomeEscola){
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'jeffersonsevero08@gmail.com';                     // SMTP username
            $mail->Password   = 'jefinho1234';                               // SMTP password
            $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 465;                                    // TCP port to connect to
    
            //Recipients
            $mail->setFrom('jeffersonsevero08@gmail.com', 'Jefferson');
            $mail->addAddress($emailResponsavel, $nomeResponsavel);     // Add a recipient
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
    
            // Attachments
            $mail->addAttachment('/var/www/html/soe/arquivos/arquivo.pdf');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'SOE';
            $mail->Body    = 'Segue em anexo ofício vindo da instituição ' . $nomeEscola;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
            $mail->send();
            echo 'Mensagem enviada com sucesso';
            return true;
        } catch (Exception $e) {
            echo "A mensagem não pôde ser enviada. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}





?>