<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Modelos/Modelo_General.php';//Se importa el modelo de inicio

    class test{
        public $nombre;

        function __construct($nombre){
            $this->nombre = $nombre;
        }
    }

    //Controlador que maneja los metodos correspondientes a un usuario paciente o medico
    abstract class ControladorGeneral{
        public $test;
        function __construct(){
            
        }

        //Funcion para la pagina de inicio de un usuario paciente o medico
        function index(){
            $general = new Modelo_General();
            if(isset($_POST['cancelar'])){
                if($general->cancelarCita($_POST['id_cita'])){
                    $mensaje_error = "Cita cancelada exitosamente";//Mensaje de error a mostrar en el modal
                }else{
                    $mensaje_error = "Ha ocurrido un error al cancelar su cita";//Mensaje de error a mostrar en el modal
                }
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
            if($citas = $general->listarCitas($_SESSION['id'], $_SESSION['rol'])){//Si el usuario en sesion tiene citas existentes...
                //Se importa la pagina de inicio general
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/index.php';
            }else{
                //Se importa la pagina de inicio vacia
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/vacio.php';
            }
        }

        //Funcion para mostrar las paginas de agendar cita 
        function agendar(){
            if(isset($_POST['siguiente'])){
                $this->test = new test('fuck');
            }else{
                $general = new Modelo_General();
                $provincias = $general->listarProvincias();
                $distritos = $general->listarDistritos();
                $corregimientos = $general->listarCorregimientos();
                $clinicas = $general->listarClinicas();
                $especialidades = $general->listarEspecialidades();
                $medicos = $general->listarMedicos();
            }
            //Se importa la pagina de agendar citas
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/agendar.php';
         }

    }
?>