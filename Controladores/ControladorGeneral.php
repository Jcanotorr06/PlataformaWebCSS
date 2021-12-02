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
                    $this->enviarEmailCancelar();//Se envia el email de notificacion al paciente y al medico
                    $mensaje_exito = "Cita cancelada exitosamente";//Mensaje de exito a mostrar en el modal
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


         //Funcion que envía correo para notificar cancelacion de la cita a pacientes y medicos
         public function enviarEmailCancelar(){
            $cedula_paciente = $_POST['cedula_paciente'];
            $cedula_medico = $_POST['cedula_medico'];
            $nombre_paciente = $_POST['nombre_paciente'];
            $nombre_medico = $_POST['nombre_medico'];
            $fecha = $_POST['fecha'];

            $general = new Modelo_General();
            $paciente = $general->buscarUsuario($cedula_paciente);
            $medico = $general->buscarUsuario($cedula_medico);
            
            if($paciente && $medico){//Si el paciente y medico existen
                $email_paciente = $paciente['email'];
                $email_medico = $medico['email'];

                //Se importa la plantilla de citas canceladas
                $body_paciente = $body_medico = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Emails/cita_cancelada.html');

                //Se reemplazan los campos nombre y fecha con la informacion correspondiente
                $body_paciente = str_replace(['{{ nombre }}', '{{ fecha }}'], [$nombre_medico, $fecha], $body_paciente);
                $body_medico = str_replace(['{{ nombre }}', '{{ fecha }}'], [$nombre_paciente, $fecha], $body_medico);

                //Se inporta el archivo para enviar correos
                require_once $_SERVER['DOCUMENT_ROOT'].'/Emails/enviar.php';

                //Se envian ambos correos
                enviarEmail($email_paciente, 'Cita Cancelada', $body_paciente);
                enviarEmail($email_medico, 'Cita Cancelada', $body_medico);
            }
         }
    }

?>