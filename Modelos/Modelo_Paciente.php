<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Db/ConexionDB.php';
    
    class Modelo_Paciente{
        private $db;

        public function __construct(){
            $this->db = Conexion::Conectar();
        }

        public function agendarCita($data){
            $res = $this->db->query("Call agendar_cita('".$data['id_usuario']."','".$data['id_medico']."','".$data['fecha']."','".$data['hora']."','".$data['duracion']."')");
            if($res){
                return true;
            }else{
                return false;
            }
        }
    }
?>