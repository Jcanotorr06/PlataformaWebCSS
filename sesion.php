<?php
    if(session_status() === PHP_SESSION_NONE){//Si no hay una sesion activa...
        session_start();
    };

    if(isset($_POST['logout']) || $_SERVER['REQUEST_URI'] == '/logout'){// Si se envia la señal logout para cerrar sesion...
        session_destroy();
        header("Location: /");
        exit();
    }
?>