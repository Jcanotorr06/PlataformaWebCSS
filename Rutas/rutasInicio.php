<?php
    //Maneja las rutas validas para un usuario que no tiene una sesion activa
    switch($accion){//Dependiendo de la ruta accedida se ejecuta el metodo del controlador correspondiente
        case '/':
            $controlador->index();
            break;
        case '':
            $controlador->index();
            break;
        case '/registro':
            $controlador->registro();
            break;
        case '/recuperar':
            $controlador->recuperar();
            break;
        case '/enviado':
            $controlador->enviado();
            break;
        case '/404':
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/404.php';
            break;
        default:// Si la ruta no se encuentra entre las listadas arriba, redirige a la pagina de error 404
            header('Location: /404');
            break;
    }
?>