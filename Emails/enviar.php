<?php

function enviarEmail($to, $subject, $body){
    /*$ headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= "From: notificaciones@csspanama.online" . "\r\n";
    return mail($to, $subject, $body, $headers); */
    exec("echo '$body' | mail -s '$subject' -f 'notificaciones@csspanama.online' -F 'Notificacion Del Sistema' $to");
}

?>
