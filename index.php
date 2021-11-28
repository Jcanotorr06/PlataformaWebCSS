<?php
    /* Por medio de este archivo se accede a la aplicacion */
    require_once $_SERVER['DOCUMENT_ROOT'].'/sesion.php'; //Se incliye el archivo que contiene la creación de la sesion
    require_once $_SERVER['DOCUMENT_ROOT'].'/Db/ConexionDB.php'; // Se incluye el archivo que contiene la conexion a la base de datos
    
    if(isset($_SESSION['rol'])){// Si hay un rol definido en la sesion...
        switch($_SESSION['rol']){//Dependiendo del rol en la sesion se asigna un valor a la variable controlador
            case 'admin':
                $controlador = 'Administrador';
                break;
            case 'paciente':
                $controlador = 'Paciente';
                break;
            case 'medico':
                $controlador = 'Medico';
                break;
            default:
                $controlador = 'Inicio';
        }
    }else{//Si no se ha definido un id de rol (caso cuando se accede por primera vez, se cierra o expira la sesion)...
        $controlador = 'Inicio';
    }
    
    require_once './Vistas/Layouts/index.php'; // Se incluye el layout general que encapsula todas las rutas
?>