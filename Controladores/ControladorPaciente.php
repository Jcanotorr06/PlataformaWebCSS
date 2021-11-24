<?php
    /* require_once 'Modelos/Modelo_Inicio.php';//Se importa el modelo de inicio */

    class ControladorPaciente{//Controlador que maneja los metodos correspondientes a un usuario 
        function __construct(){
            
        }

        function index(){//Funcion para la pagina de inicio de un paciente
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/index.php';
        }

    }
?>