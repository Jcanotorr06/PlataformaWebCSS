<?php

function enviarEmail($to, $subject, $body){
    $headers = "From: notificaciones@csspanama.online";
    return mail($to, $subject, $body, $headers);
}

?>
