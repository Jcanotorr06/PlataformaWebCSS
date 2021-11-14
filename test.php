<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function resetContraseña($to, $key){
$mail = new PHPMailer(true);

try { 
    $mail->isSMTP();                                            
    $mail->Host       = 'in-v3.mailjet.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = $_ENV['SMTP_USER'];                     
    $mail->Password   = $_ENV['SMTP_PASSWORD'];           
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
