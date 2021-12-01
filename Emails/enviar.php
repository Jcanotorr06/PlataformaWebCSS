<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



function enviarEmail($to, $subject, $body){
$mail = new PHPMailer(true);

try { 
    $mail->isSMTP();                                            
    $mail->Host       = 'in-v3.mailjet.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = '745fbf69394d2557cb6ff626db9eb6a2';                     
    $mail->Password   = 'd506b0053aee5304daf906a3930286c6';           
    $mail->Port       = 587;                                    

    
    $mail->setFrom('yijerew969@slvlog.com', 'Mailer');
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
