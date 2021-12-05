<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



function enviarEmail($to, $subject, $body){
$mail = new PHPMailer(true);

try { 
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp-relay.sendinblue.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'defienema@gmail.com';                     
    $mail->Password   = 'cVKAs8g3m5wprRN0';           
    $mail->Port       = 587;                                    

    
    $mail->setFrom('defienema@gmail.com', 'Allan Carr');
    $mail->addAddress($to);     

    
    $mail->isHTML(true);                                  
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = $subject.'www.csspanama.online';

    if($mail->send()){
        return true;
    }else{
        return false;
    }
} catch (Exception $e) {
    return false;
}
}
