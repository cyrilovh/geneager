<?php

namespace class;

class email{

    public static function send(string $subject, string $recipientEmail, string $recipientName, string $HTMLContent, string $textContent):bool{
        $mail = new \PHPMailer\PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                                    //Send using SMTP
            $mail->Host       = SMTP_HOST;                                      //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                           //Enable SMTP authentication
            $mail->Username   = SMTP_USERNAME;                                  //SMTP username
            $mail->Password   = SMTP_PASSWORD;                                  //SMTP password
            $mail->SMTPSecure = (SMTP_SECURE=="ssl" ? \PHPMailer\PHPMailer::ENCRYPTION_SMTPS : \PHPMailer\PHPMailer::ENCRYPTION_STARTTLS );          //Enable implicit TLS encryption
            $mail->Port       = SMTP_PORT;                                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
            $mail->addAddress($recipientEmail, $recipientName);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $HTMLContent;
            $mail->AltBody = $textContent;
        
            if($mail->send()){
                return true;
            }else{
                return false;
            }
        } catch (\PHPMailer\Exception $e) {
            if(PROD == FALSE){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            return false;
        }
    }

}