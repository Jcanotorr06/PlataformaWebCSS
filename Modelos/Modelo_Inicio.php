<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Db/ConexionDB.php';
    class Modelo_Inicio{//Modelo de Inicio que interactua con la base de datos
        private $db;

        public function __construct(){
            $this->db = Conexion::Conectar();
        }

        public function registro($data){//Funcion que llama el procedimiento almacenado crear_usuario para registrar un nuevo usuario
            $query = "Call crear_usuario('".$data['nombre']."','".$data['apellido']."','".$data['cedula']."','".$data['email']."','".$data['contraseña']."')";
            $res = mysqli_query($this->db, $query);
            if($res){//Si el query fue ejecutado exitosamente...
                return true;
            }else{
                echo mysqli_error($this->db);
                return false;
            }
        }

        public function iniciarSesion($data){
            $res = $this->db->query("Call iniciar_sesion('".$data['usuario']."')");
            if($res->num_rows > 0){
                $usuario = $res->fetch_assoc();
                $contraseña_encriptada = $usuario['contraseña'];
                if(password_verify($data['contraseña'], $contraseña_encriptada)){
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['rol'] = $usuario['rol'];
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