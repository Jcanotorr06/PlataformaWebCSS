<?php
    class Conexion{
        public static function Conectar(){
            $conexion = mysqli_connect("localhost", "root", "password", "csss");
            if($conexion){
                return $conexion;
            }else{
                return false;
            }
        }
    }
?>