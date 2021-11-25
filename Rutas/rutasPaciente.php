<?php
    //Maneja las rutas validas para un usuario con el rol de paciente
    $rutas = array('', '/', '/404');
    if(in_array($accion, $rutas)){//Si la ruta a la que accede el usuario existe...
        require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/navbar.php';//Se incluye la barra de navegacion
    };
    switch($accion){//Dependiendo de la ruta accedida se ejecuta el metodo del controlador correspondiente
        case '/':
            $controlador->index();
            break;
        case '':
            $controlador->index();
            break;
        case '/404':
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/404.php';
            break;
        default:// Si la ruta no se encuentra entre las listadas arriba, redirige a la pagina de error 404
            header('Location: /404');
            break;
    }
?>