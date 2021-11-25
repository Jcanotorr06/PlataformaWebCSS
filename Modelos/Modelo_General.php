<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Db/ConexionDB.php';
    
    class Modelo_General{
        private $db;
        private $citas;

        public function __construct(){
            $this->db = Conexion::Conectar();
            $this->citas = array();
        }

        public function listarCitas($id, $rol){
            $res = $this->db->query("Call listar_citas_$rol('$id')");
            if($res->num_rows > 0){
                while($fila = $res->fetch_assoc()){
                    $this->citas[] = $fila;
                }
                return $this->citas;
            }else{
                return false;
            }
        }
    }
?>