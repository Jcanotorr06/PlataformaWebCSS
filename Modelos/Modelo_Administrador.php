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
                return $pacientes;
            }else{
                return false;
            }
        }
    }
?>