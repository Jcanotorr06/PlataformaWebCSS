<?php
    //Maneja las rutas validas para un usuario con el rol de administrador
    $rutas = array('', '/', '/medicos', '/especialidades', '/clinicas', '/pacientes', '/404');
    if(in_array($accion, $rutas)){//Si la ruta a la que accede el usuario existe...
        require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/navbar.php';//Se incluye la barra de navegacion
    };
    switch($accion){//Dependiendo de la ruta accedida se ejecuta el metodo del controlador correspondiente
        case '/':
        case '':
            $controlador->index();
            break;
        case '/medicos':
            $controlador->medicos();
            break;
        case '/clinicas':
            $controlador->clinicas();
            break;
        case '/especialidades':
            $controlador->especialidades();
            break;
        case '/pacientes':
            $controlador->pacientes();
            break;
        case '/404':
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/404.php';
            break;
        default:// Si la ruta no se encuentra entre las listadas arriba, redirige a la pagina de error 404
            header('Location: /404');
            break;
    }
?>