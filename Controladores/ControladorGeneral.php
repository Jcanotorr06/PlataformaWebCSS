<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Modelos/Modelo_General.php';//Se importa el modelo de inicio

    class ControladorGeneral{//Controlador que maneja los metodos correspondientes a un usuario 
        function __construct(){
            
        }

        function index(){//Funcion para la pagina de inicio de un paciente
            $general = new Modelo_General();
            if($citas = $general->listarCitas($_SESSION['id'], $_SESSION['rol'])){
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/index.php';
            }else{
                $test = "Funciona";
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/vacio.php';
            }
        }

    }
?>