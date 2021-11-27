<?php
    $url = parse_url($_SERVER['REQUEST_URI']);//Se almacena la url a la que se intenta acceder
    $accion = $url['path']; //Se extrae la ruta deseada de la url con el parametro 'path'

    require_once $_SERVER['DOCUMENT_ROOT'].'/Controladores/Controlador'.$controlador.'.php';//Se incluye el controlador correspondiente a la situacion del usuario (Administrador, Paciente, Medico o Inicio)
    

    //Dependiendo del 'controlador' definido por el rol...
    switch($controlador){
        //Si se utiliza uno de los controladores validos...
        case 'Inicio' || 'Paciente' || 'Medico' || 'Administrador':
            $tipo = $controlador;
            $controlador_nombre = 'Controlador'.$tipo;//Se crea una variable con el nombre del archivo del controlador correspondiente
            $controlador = new $controlador_nombre();//Se inicializa el controlador seleccionado

            //Si el archivo enrutador del tipo seleccionado existe...
            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/Rutas/rutas'.$tipo.'.php')){

                // Se incluye el enrutador de respectivo al controlador
                require_once $_SERVER['DOCUMENT_ROOT'].'/Rutas/rutas'.$tipo.'.php';

            }else{
                
                // Se incluye el enrutador de usuarios general
                require_once $_SERVER['DOCUMENT_ROOT'].'/Rutas/rutasGeneral.php';
            }
            break;

            // Si se utiliza un controlador no valido
        default:
            $controlador = new ControladorInicio();//Se inicializa el controlador de Inicio
            
            // Se incluye el enrutador de inicio
            require_once $_SERVER['DOCUMENT_ROOT'].'/Rutas/rutasInicio.php';
            break;
    }
    
?>