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
            if(isset($_POST['añadir'])){
                $this->añadirMedico();
            }
            if(isset($_POST['editar'])){
                $this->modificarMedico();
            }
            if(isset($_POST['eliminar'])){
                $this->eliminarUsuario();
            }
            if(($medicos = $admin->administrarMedicos()) && ($especialidades = $admin->administrarEspecialidades()) && ($clinicas = $admin->administrarClinicas())){
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
            if(isset($_POST['añadir'])){
                $this->añadirPaciente();
            }
            if(isset($_POST['editar'])){
                $this->modificarPaciente();
            }
            if(isset($_POST['eliminar'])){
                $this->eliminarUsuario();
            }
            if($pacientes = $admin->administrarPacientes()){
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/pacientes.php';
            }else{
                header('Location: /404');
                exit();
            }
        }

        public function añadirMedico(){
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $email = $_POST['email'];
            $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
            $id_especialidad = $_POST['especialidad'];
            $id_clinica = $_POST['clinica'];
            $duracion_citas = $_POST['duracion_citas'];

            $admin = new Modelo_Administrador();

            if($admin->añadirMedico($nombre, $apellido, $cedula, $email, $contraseña, $id_especialidad, $id_clinica, $duracion_citas)){
                require_once $_SERVER['DOCUMENT_ROOT'].'/Emails/enviar.php';
                $body = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Emails/registro_exitoso.html');//Se convierte la plantilla html en una cadena de texto
                enviarEmail($data['email'], 'Registro Exitoso', $body);//Se envia el correo

                $mensaje_exito = "Usuario creado exitosamente";//Mensaje de exito a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        public function modificarMedico(){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $email = $_POST['email'];
            $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
            $id_especialidad = $_POST['especialidad'];
            $id_clinica = $_POST['clinica'];
            $duracion_citas = $_POST['duracion_citas'];

            $admin = new Modelo_Administrador();

            if($admin->modificarMedico($id,$nombre, $apellido, $cedula, $email, $contraseña, $id_especialidad, $id_clinica, $duracion_citas)){
/*                 require_once $_SERVER['DOCUMENT_ROOT'].'/Emails/enviar.php';
                $body = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Emails/registro_exitoso.html');//Se convierte la plantilla html en una cadena de texto
                enviarEmail($data['email'], 'Registro Exitoso', $body);//Se envia el correo */

                $mensaje_exito = "Usuario modificado exitosamente";//Mensaje de exito a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        public function añadirPaciente(){
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $email = $_POST['email'];
            $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

            $admin = new Modelo_Administrador();

            if($admin->añadirPaciente($nombre, $apellido, $cedula, $email, $contraseña)){
                require_once $_SERVER['DOCUMENT_ROOT'].'/Emails/enviar.php';
                $body = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Emails/registro_exitoso.html');//Se convierte la plantilla html en una cadena de texto
                enviarEmail($data['email'], 'Registro Exitoso', $body);//Se envia el correo

                $mensaje_exito = "Usuario creado exitosamente";//Mensaje de exito a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        public function modificarPaciente(){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $email = $_POST['email'];
            $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

            $admin = new Modelo_Administrador();

            if($admin->modificarPaciente($id,$nombre, $apellido, $cedula, $email, $contraseña)){
/*                 require_once $_SERVER['DOCUMENT_ROOT'].'/Emails/enviar.php';
                $body = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Emails/registro_exitoso.html');//Se convierte la plantilla html en una cadena de texto
                enviarEmail($data['email'], 'Registro Exitoso', $body);//Se envia el correo */

                $mensaje_exito = "Usuario modificado exitosamente";//Mensaje de exito a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        public function eliminarUsuario(){
            $id = $_POST['id'];

            $admin = new Modelo_Administrador();
            if($admin->eliminarUsuario($id)){
                $mensaje_exito = "Usuario eliminado exitosamente";
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }
    }
?>