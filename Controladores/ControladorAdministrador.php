<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Modelos/Modelo_Administrador.php';//Se importa el modelo de inicio

    class ControladorAdministrador{

        function __construct(){
            
        }

        function index(){
            $admin = new Modelo_Administrador();
            $datos = $admin->listarDatosGenerales();
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/index.php';
        }
        
        function medicos(){
            $admin = new Modelo_Administrador();
            if($medicos = $admin->administrarMedicos()){
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/medicos.php';
            }else{
                header('Location: /404');
                exit();
            }
        }

        function especialidades(){
            $admin = new Modelo_Administrador();
            if($especialidades = $admin->administrarEspecialidades()){
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/especialidades.php';
            }else{
                header('Location: /404');
                exit();
            }
        }
        
        function clinicas(){
            $admin = new Modelo_Administrador();
            if($clinicas = $admin->administrarClinicas()){
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/clinicas.php';
            }else{
                header('Location: /404');
                exit();
            }
        }
        
        function pacientes(){
            $admin = new Modelo_Administrador();
            if($pacientes = $admin->administrarPacientes()){
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/pacientes.php';
            }else{
                header('Location: /404');
                exit();
            }
        }
    }
?>