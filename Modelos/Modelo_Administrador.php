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

        //Lista las provincias en las que hayan medicos existentes la base de datos
        public function listarProvincias(){
            $res = $this->db->query("Select * From provincias");
            if($res->num_rows > 0){//Si la provincia tiene medicos...
                while($provincia = $res->fetch_assoc()){
                    $provincias[] = $provincia;
                }
                $this->db->close();
                $this->db = Conexion::Conectar();
                return $provincias;
            }else{
                return false;
            }
        }

        //Lista los distritos en los que hayan medicos existentes en la base de datos
        public function listarDistritos(){
            $res = $this->db->query("Select * From distritos");
            if($res->num_rows > 0){//Si el distrito tiene medicos...
                while($distrito = $res->fetch_assoc()){
                    $distritos[] = $distrito;
                }
                $this->db->close();
                $this->db = Conexion::Conectar();
                return $distritos;
            }else{
                return false;
            }
        }

        //Lista los corregimientos en los que hayan medicos existentes en la base de datos
        public function listarCorregimientos(){
            $res = $this->db->query("Select * From corregimientos");
            if($res->num_rows > 0){///Si el corregimientos tiene medicos...
                while($corregimiento = $res->fetch_assoc()){
                    $corregimientos[] = $corregimiento;
                }
                $this->db->close();
                $this->db = Conexion::Conectar();
                return $corregimientos;
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

        public function añadirClinica($clinica, $id_corregimiento){
            $res = $this->db->query("Insert Into clinicas(clinica, id_corregimiento) values('$clinica','$id_corregimiento');");
            if($res){
                return true;
            }else{
                return false;
            }
        }

        public function modificarClinica($id, $clinica, $id_corregimiento){
            $res = $this->db->query("Call modificar_clinica('$id','$clinica','$id_corregimiento');");
            if($res){
                return true;
            }else{
                return false;
            }
        }

        public function eliminarClinica($id){
            $res = $this->db->query("Delete From clinicas Where id = '$id'");
            if($res){
                return true;
            }else{
                echo $this->db->error;
                return false;
            }
        }

        public function añadirEspecialidad($especialidad){
            $res = $this->db->query("Insert Into especialidades(especialidad) Values('$especialidad');");
            if($res){
                return true;
            }else{
                return false;
            }
        }

        public function modificarEspecialidad($id, $especialidad){
            $res = $this->db->query("Call modificar_especialidad('$id','$especialidad');");
            if($res){
                return true;
            }else{
                return false;
            }
        }

        public function eliminarEspecialidad($id){
            $res = $this->db->query("Delete From especialidades Where id = '$id';");
            if($res){
                return true;
            }else{
                return false;
            }
        }
        
    }
?>