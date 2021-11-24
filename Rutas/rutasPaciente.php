<?php
    //Maneja las rutas validas para un usuario que no tiene una sesion activa
    switch($accion){
        case '/':
            $controlador->index();
            break;
        case '':
            $controlador->index();
            break;
        case '/404':
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/404.php';
            break;
        default:// Si la ruta no se encuentra entre las listadas arriba, redirige a la pagina de inicio "/"
            header('Location: /404');
            break;
    }
?>