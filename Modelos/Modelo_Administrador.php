<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Db/ConexionDB.php';//Se importa la clase de conexion a la base de datos

    class Modelo_Administrador{
        private $db;

        public function __construct(){
            $this->db = Conexion::Conectar();
        }

        public function listarDatosGenerales(){
            $res = $this->db->query('Select * From datos_generales');
            if($res->num_rows > 0){
                $datos = $res->fetch_assoc();
                return $datos;
            }else{
                return false;
            }
        }

        public function administrarMedicos(){
            $res = $this->db->query('Select * From administrar_medicos');
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    $medicos[] = $row;
                }
                $this->db->close();
                $this->db = Conexion::Conectar();
                return $medicos;
            }else{
                return false;
            }
        }

        public function administrarEspecialidades(){
            $res = $this->db->query('Select * From administrar_especialidades');
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    $especialidades[] = $row;
                }
                $this->db->close();
                $this->db = Conexion::Conectar();
                return $especialidades;
            }else{
                return false;
            }
        }

        public function administrarClinicas(){
            $res = $this->db->query('Select * From administrar_clinicas');
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    $clinicas[] = $row;
                }
                $this->db->close();
                $this->db = Conexion::Conectar();
                return $clinicas;
            }else{
                return false;
            }
        }
        
        public function administrarPacientes(){
            $res = $this->db->query('Select * From administrar_pacientes');
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    $pacientes[] = $row;
                }
                $this->db->close();
                $this->db = Conexion::Conectar();
                return $pacientes;
            }else{
                return false;
            }
        }

        public function añadirMedico($nombre, $apellido, $cedula, $email, $contraseña, $id_especialidad, $id_clinica, $duracion_citas){
            $res = $this->db->query("Call añadir_medico('$nombre','$apellido','$cedula','$email','$contraseña',$id_especialidad,$id_clinica,$duracion_citas);");
            if($res){
                return true;
            }else{
                return false;
            }
        }

        public function modificarMedico($id, $nombre, $apellido, $cedula, $email, $contraseña, $id_especialidad, $id_clinica, $duracion_citas){
            $res = $this->db->query("Call modificar_medico('$id','$nombre','$apellido','$cedula','$email','$contraseña',$id_especialidad,$id_clinica,$duracion_citas);");
            if($res){
                return true;
            }else{
                echo $this->db->error;
                return false;
            }
        }

        public function añadirPaciente($nombre, $apellido, $cedula, $email, $contraseña){
            $res = $this->db->query("Call crear_usuario('$nombre','$apellido','$cedula','$email','$contraseña');");
            if($res){
                return true;
            }else{
                return false;
            }
        }

        public function modificarPaciente($id, $nombre, $apellido, $cedula, $email, $contraseña){
            $res = $this->db->query("Call modificar_paciente('$id','$nombre','$apellido','$cedula','$email','$contraseña');");
            if($res){
                return true;
            }else{
                echo $this->db->error;
                return false;
            }
        }

        public function eliminarUsuario($id){
            $res = $this->db->query("Delete From usuarios Where id = '$id'");
            if($res){
                return true;
            }else{
                echo $this->db->error;
                return false;
            }
        }
        
    }
?>