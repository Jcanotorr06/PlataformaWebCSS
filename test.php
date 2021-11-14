<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

function resetContraseña($to, $key){
$mail = new PHPMailer(true);

try { 
    $mail->isSMTP();                                            
    $mail->Host       = 'in-v3.mailjet.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = '269fbf24bd17c96355eb77730f35f31f';                     
    $mail->Password   = 'b785c4d36a99c8afec522854916e0d90';           
    $mail->Port       = 587;                                    

    
    $mail->setFrom('dobeh22641@d3ff.com', 'Mailer');
    $mail->addAddress($to);     

    
    $mail->isHTML(true);                                  
    $mail->Subject = 'Here is the subject';
    $mail->Body    = "Link: <a href='http://localhost/css/recuperar.php?key=$key'>Recuperar Contraseña</a>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    return true;
} catch (Exception $e) {
    return false;
}
}
