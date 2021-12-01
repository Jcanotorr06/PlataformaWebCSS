<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Modelos/Modelo_Inicio.php';//Se importa el modelo de inicio

    class ControladorInicio{//Controlador que maneja los metodos correspondientes a un usuario que no está en sesion
        function __construct(){
            
        }

        function index(){//Funcion para la pagina de inicio de sesion
            if(isset($_POST['iniciar'])){
                $this->iniciarSesion();
            }
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Inicio/index.php';
        }

        function registro(){//Funcion para la pagina de registro
            if(isset($_POST['registro'])){
                $this->registrarPaciente();
            }
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Inicio/registro.php';
        }

        function recuperar(){//Funcion para la pagina de recuperacion de contraseña
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Inicio/recuperar.php';
        }

        public function registrarPaciente(){// Funcion que procesa el registro de un paciente
            $data['nombre'] = $_POST['nombre'];
            $data['apellido'] = $_POST['apellido'];
            $data['cedula'] = $_POST['cedula'];
            $data['email'] = $_POST['email'];
            $data['contraseña'] = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);//Se encripta la contraseña antes de almacenarla

            $inicio = new Modelo_Inicio();
            if($inicio->registro($data)){//Si el registro fue completado exitosamente...
                $this->registroExitoso(1, $_POST['email']);
            }else{
                $this->error('/registro',1);
            } 
        }

        public function iniciarSesion(){// Funcion que procesa el inicio de sesion de un usuario
            $data['usuario'] = $_POST['usuario'];
            $data['contraseña'] = $_POST['contraseña'];

            $inicio = new Modelo_Inicio();
            if($inicio->iniciarSesion($data)){//Si el inicio de sesion se completó con exito...
                header('Location: /');
                exit();
            }else{
                $this->error('/',1);
            }
        }

        public function registroExitoso($status_num, $email){//Funcion utilizada para indicar un registro exitoso
            //Se importa el archivo para enviar correos
            require_once $_SERVER['DOCUMENT_ROOT'].'/Emails/enviar.php';
            $body = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Emails/registro_exitoso.html');//Se convierte la plantilla html en una cadena de texto
            enviarEmail($email, 'Registro Exitoso', $body);//Se envia el correo

            header("Location: /?status=$status_num");// Redirige al usuario a la pagina de inicio con un query status para indicar el exito
            exit();
        }

        public function error($ruta, $err_num){//Funcion utiliada para indicar un proceso fallido
            header("Location: $ruta?err=$err_num");//Redirige al usuario a la ruta especificada con un query err para indicar que ocurrio un error
            exit();
        }
    }
?>