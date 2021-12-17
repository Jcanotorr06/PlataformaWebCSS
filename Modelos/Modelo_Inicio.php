<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Db/ConexionDB.php';
    class Modelo_Inicio{//Modelo de Inicio que interactua con la base de datos
        private $db;

        public function __construct(){
            $this->db = Conexion::Conectar();
        }

        //Funcion que llama el procedimiento almacenado crear_usuario para registrar un nuevo usuario
        public function registro($data){
            $res = $this->db->query("Call crear_usuario('".$data['nombre']."','".$data['apellido']."','".$data['cedula']."','".$data['email']."','".$data['contraseña']."')");
            if($res){//Si el query fue ejecutado exitosamente...
                return true;
            }else{
                return false;
            }
        }

        //Funcion que llama el procedimiento almacenado iniciar_sesion para iniciar la sesion de un usuario
        public function iniciarSesion($data){
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

        //Busca datos generales del usuario por su cedula
        public function buscarUsuario($cedula){
            $res = $this->db->query("Call listar_datos_usuario('$cedula')");
            if($res->num_rows > 0){//Si el usuario existe...
                while($x = $res->fetch_assoc()){
                    $usuario = $x;
                }
                $this->db->close();//Se cierra la conexion a la BD
                $this->db = Conexion::Conectar();//Se restablece la conexion a la BD
                return $usuario;
            }else{
                return false;
            }
        }

        //Inserta una nueva llave de recuperacion para el usuario con su fecha de expiracion
        public function crearLlaveRecuperar($id, $llave, $expira){
            $res = $this->db->query("INSERT INTO recuperar_contraseña(id_usuario, llave, expira) VALUES('$id', '$llave', '$expira')");
            if($res){
                return true;
            }else{
                return $this->db->error;
            }
        }

        //Valida si la llave ha expiado
        public function validarLlaveVigente($llave){
            $res = $this->db->query("Call validar_recuperar_contraseña('$llave')");
            if($res->num_rows > 0){
                while($x = $res->fetch_assoc()){
                    $data = $x;
                }
                $this->db->close();
                $this->db = Conexion::Conectar();
                return $data;
            }else{
                return false;
            }
        }

        //Actualiza la contraseña del usuario
        public function cambiarContraseña($cedula, $contraseña){
            $res = $this->db->query("Update usuarios Set contraseña = '$contraseña' Where cedula = '$cedula'");
            if($res){
                return true;
            }else{
                return false;
            }
        }
    }
?>