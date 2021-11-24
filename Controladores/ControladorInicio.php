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

        public function registrarPaciente(){
            $data['nombre'] = $_POST['nombre'];
            $data['apellido'] = $_POST['apellido'];
            $data['cedula'] = $_POST['cedula'];
            $data['email'] = $_POST['email'];
            $data['contraseña'] = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

            $inicio = new Modelo_Inicio();
            if($inicio->registro($data)){
                $this->registroExitoso(1);
            }else{
                $this->error('/registro',1);
            } 
        }

        public function iniciarSesion(){
            $data['usuario'] = $_POST['usuario'];
            $data['contraseña'] = $_POST['contraseña'];

            $inicio = new Modelo_Inicio();
            if($inicio->iniciarSesion($data)){
                header('Location: /');
                exit();
            }else{
                $this->error('/',1);
            }
        }

        public function registroExitoso($status_num){
            header("Location: /?status=$status_num");
            exit();
        }

        public function error($ruta, $err_num){
            header("Location: $ruta?err=$err_num");
            exit();
        }
    }
?>