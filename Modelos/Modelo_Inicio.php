<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Db/ConexionDB.php';
    class Modelo_Inicio{//Modelo de Inicio que interactua con la base de datos
        private $db;

        public function __construct(){
            $this->db = Conexion::Conectar();
        }

        public function registro($data){//Funcion que llama el procedimiento almacenado crear_usuario para registrar un nuevo usuario
            $res = $this->db->query("Call crear_usuario('".$data['nombre']."','".$data['apellido']."','".$data['cedula']."','".$data['email']."','".$data['contraseña']."')");
            if($res){//Si el query fue ejecutado exitosamente...
                return true;
            }else{
                echo mysqli_error($this->db);
                return false;
            }
        }

        public function iniciarSesion($data){//Funcion que llama el procedimiento almacenado iniciar_sesion para iniciar la sesion de un usuario
            $res = $this->db->query("Call iniciar_sesion('".$data['usuario']."')");
            if($res->num_rows > 0){//Si el query devuelve por lo menos 1 fila...
                $usuario = $res->fetch_assoc();
                $contraseña_encriptada = $usuario['contraseña'];
                if(password_verify($data['contraseña'], $contraseña_encriptada)){//Si la contraseña enviada concuerda con la contraseña almacenada...
                    $_SESSION['id'] = $usuario['id'];//Se almacena el id del usuario en la session
                    $_SESSION['rol'] = $usuario['rol'];//Se almacena el rol del usuario en la sesion
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }
?>