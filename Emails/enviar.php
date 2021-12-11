<?php

function enviarEmail($to, $subject, $body){
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= "From: notificaciones@csspanama.online" . "\r\n";
    exec("echo '$body' | mail -a 'MIME-Version: 1.0\r\nContent-type: text/html; charset=UTF-8\r\nFrom: notificaciones@csspanama.online' -r 'notificaciones@csspanama.online' -s '$subject' $to");
    return mail($to, $subject, $body, $headers); 
}

?>
