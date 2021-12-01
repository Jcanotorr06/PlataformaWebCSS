<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Db/ConexionDB.php';//Se importa la clase de conexion a la base de datos
    
    //Modelo que maneja las funcionalidades generales de los pacientes y medicos
    class Modelo_General{
        private $db;
        private $citas;

        public function __construct(){
            $this->db = Conexion::Conectar();
            $this->citas = array();
        }

        //Lista las citas de un usuario utilizando el procedimiento almacenado listar_citas
        public function listarCitas($id, $rol){
            $res = $this->db->query("Call listar_citas_$rol('$id')");
            if($res->num_rows > 0){// Si el usuario tiene alguna cita...
                while($fila = $res->fetch_assoc()){
                    $this->citas[] = $fila; //Se añade la cita al arreglo citas de la clase
                }
                return $this->citas;
            }else{
                return false;
            }
        }

        //Utiliza el procedimiento almacenado agendar_cita para agendar una cita
        //Parametro  $data, debe ser un arreglo con los elementos id_usuario, id_medico, fecha, hora y duracion
        public function agendarCita($data){
            $res = $this->db->query("Call agendar_cita('".$data['id_usuario']."','".$data['id_medico']."','".$data['fecha']."','".$data['hora']."','".$data['duracion']."')");
            if($res){
                return true;
            }else{
                return false;
            }
        }

        //Lista las provincias en las que hayan medicos existentes la base de datos
        public function listarProvincias(){
            $res = $this->db->query("Select * From listar_provincias_validas");
            if($res->num_rows > 0){//Si la provincia tiene medicos...
                while($provincia = $res->fetch_assoc()){
                    $provincias[] = $provincia;
                }
                return $provincias;
            }else{
                return false;
            }
        }

        //Lista los distritos en los que hayan medicos existentes en la base de datos
        public function listarDistritos(){
            $res = $this->db->query("Select * From listar_distritos_validos");
            if($res->num_rows > 0){//Si el distrito tiene medicos...
                while($distrito = $res->fetch_assoc()){
                    $distritos[] = $distrito;
                }
                return $distritos;
            }else{
                return false;
            }
        }

        //Lista los corregimientos en los que hayan medicos existentes en la base de datos
        public function listarCorregimientos(){
            $res = $this->db->query("Select * From listar_corregimientos_validos");
            if($res->num_rows > 0){///Si el corregimientos tiene medicos...
                while($corregimiento = $res->fetch_assoc()){
                    $corregimientos[] = $corregimiento;
                }
                return $corregimientos;
            }else{
                return false;
            }
        }

        //Lista las clinicas en las que hayan medicos existentes en la base de datos
        public function listarClinicas(){
            $res = $this->db->query("Select * From listar_clinicas_validas");
            if($res->num_rows > 0){//Si la clinica tiene medicos...
                while($clinica = $res->fetch_assoc()){
                    $clinicas[] = $clinica;
                }
                return $clinicas;
            }else{
                return false;
            }
        }

        //Lista las especialiddes que correspondan a medicos en la base de datos
        public function listarEspecialidades(){
            $res = $this->db->query("Select * From listar_especialidades_clinica");
            if($res->num_rows > 0){//Si hay medicos con alguna especialidad...
                while($especialidad = $res->fetch_assoc()){
                    $especialidades[] = $especialidad;
                }
                return $especialidades;
            }else{
                return false;
            }
        }

        //Lista los medicos en la base de datos
        public function listarMedicos(){
            $res = $this->db->query("Select * From listar_medicos");
            if($res->num_rows > 0){//Si hay medicos...
                while($medico = $res->fetch_assoc()){
                    $medicos[] = $medico;
                }
                return $medicos;
            }else{
                return false;
            }
        }

        public function cancelarCita($id_cita){
            $res = $this->db->query("Delete From citas Where id='$id_cita'");
            if($res){
                return true;
            }else{
                return false;
            }
        }


    }
?>