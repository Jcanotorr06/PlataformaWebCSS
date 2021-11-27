<?php
    
    include_once $_SERVER['DOCUMENT_ROOT'].'/Controladores/ControladorGeneral.php';//Se incluye el ControladorGeneral

    //Controlador que maneja los metodos correspondientes a un usuario 
    //Extiende al ControladorGeneral para heredar funcionalidades que comparte con ControladorMedico
    class ControladorPaciente extends ControladorGeneral{
        function __construct(){
            
        }

        public function test(){
            echo 'PRUEBA PACIENTE';
        }
    }
?>