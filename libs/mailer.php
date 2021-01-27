<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';
require __DIR__. "/mail.templates.php";


function send_email($receivers){
    // passing true in constructor enables exceptions in PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mail->isSMTP();
        $mail->SMTPKeepAlive = true; //keep smtp alive
        $mail->SmtpConnect();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username = 'vgecehostel@gmail.com'; // YOUR gmail email
        $mail->Password = 'Vgec@2020'; // YOUR gmail password

        // Sender and recipient settings
        $mail->setFrom('vgecehostel@gmail.com', 'VGEC eHostel');

        //clients
        $address = $receivers;
        
        $mail->IsHTML(true);
        $mail->Subject = "eHostel Registration";
        foreach ($address as $email => $name) {
            $mail->ClearAllRecipients();
            $mail->addAddress($email,$name);
            $mail->Body = success_templete($name);

            if($mail->send()){
                return true;        
            }
            else{
                return false;
            }
        }
       
        
    } catch (Exception $e) {
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
}

function mail_warden_password_reset($data){
    // passing true in constructor enables exceptions in PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mail->isSMTP();
        $mail->SMTPKeepAlive = true; //keep smtp alive
        $mail->SmtpConnect();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username = 'vgecehostel@gmail.com'; // YOUR gmail email
        $mail->Password = 'Vgec@2020'; // YOUR gmail password

        // Sender and recipient settings
        $mail->setFrom('vgecehostel@gmail.com', 'VGEC eHostel');

        
        $mail->IsHTML(true);
        $mail->Subject = $data['subject'];
        $mail->ClearAllRecipients();
        $mail->addAddress($data['email'],$data['name']);
        $mail->Body = password_reset_templete($data['link']);

        if($mail->send()){
            return true;        
        }
        else{
            return false;
        }
   
        
    } catch (Exception $e) {
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
}

function mail_registration_rejected($data){
     // passing true in constructor enables exceptions in PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mail->isSMTP();
        $mail->SMTPKeepAlive = true; //keep smtp alive
        $mail->SmtpConnect();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username = 'vgecehostel@gmail.com'; // YOUR gmail email
        $mail->Password = 'Vgec@2020'; // YOUR gmail password

        // Sender and recipient settings
        $mail->setFrom('vgecehostel@gmail.com', 'VGEC eHostel');

        
        $mail->IsHTML(true);
        $mail->Subject = $data['subject'];
        $mail->ClearAllRecipients();
        $mail->addAddress($data['email'],$data['name']);
        $mail->Body =registration_rejected($data);

        if($mail->send()){
            return true;        
        }
        else{
            return false;
        }
   
        
    } catch (Exception $e) {
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
