<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Modelos/Modelo_Administrador.php';//Se importa el modelo de inicio

    class ControladorAdministrador{

        function __construct(){
            
        }

        //Funcion para la pantalla de inicio de un administrador
        function index(){
            $admin = new Modelo_Administrador();
            $datos = $admin->listarDatosGenerales();//Se buscan los datos generales
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/index.php';
        }
        
        //Funcion para la pantalla de administración de medicos
        function medicos(){
            $admin = new Modelo_Administrador();
            if(isset($_POST['añadir'])){//Si se envia la señal para añadir...
                $this->añadirMedico();
            }
            if(isset($_POST['editar'])){//Si se envia la señal para editar...
                $this->modificarMedico();
            }
            if(isset($_POST['eliminar'])){//Si se envia la señal para eliminar...
                $this->eliminarUsuario();
            }
            //Si hay medicos especialidades y clinicas en el sistema...
            if(($medicos = $admin->administrarMedicos()) && ($especialidades = $admin->administrarEspecialidades()) && ($clinicas = $admin->administrarClinicas())){
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/medicos.php';
            }else{
                header('Location: /404');
                exit();
            }
        }

        //Funcion para la pantalla de administación de especialidades
        function especialidades(){
            $admin = new Modelo_Administrador();
            if(isset($_POST['añadir'])){//Si se envia la señal para añadir...
                $this->añadirEspecialidad();
            }
            if(isset($_POST['editar'])){//Si se envia la señal para editar...
                $this->modificarEspecialidad();
            }
            if(isset($_POST['eliminar'])){//Si se envia la señal para eliminar...
                $this->eliminarEspecialidad();
            }
            //Si hay especialidades existentes en el sistema...
            if($especialidades = $admin->administrarEspecialidades()){
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/especialidades.php';
            }else{
                header('Location: /404');
                exit();
            }
        }
        
        //Funcion para la pantalla de administración de clinicas
        function clinicas(){
            $admin = new Modelo_Administrador();
            if(isset($_POST['añadir'])){//Si se envia la señal para añadir...
                $this->añadirClinica();
            }
            if(isset($_POST['editar'])){//Si se envia la señal para editar...
                $this->modificarClinica();
            }
            if(isset($_POST['eliminar'])){//Si se envia la señal para eliminar...
                $this->eliminarClinica();
            }
            //Si hay clinicas provincias distritos y corregimientos existentes en el sistema...
            if(($clinicas = $admin->administrarClinicas()) && ($provincias = $admin->listarProvincias()) && ($distritos = $admin->listarDistritos()) && ($corregimientos = $admin->listarCorregimientos())){
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/clinicas.php';
            }else{
                header('Location: /404');
                exit();
            }
        }
        
        //Funcion para la pagina de administracion de pacientes
        function pacientes(){
            $admin = new Modelo_Administrador();
            if(isset($_POST['añadir'])){//Si se envia la señal para añadir...
                $this->añadirPaciente();
            }
            if(isset($_POST['editar'])){//Si se envia la señal para editar...
                $this->modificarPaciente();
            }
            if(isset($_POST['eliminar'])){//Si se envia la señal para eliminar...
                $this->eliminarUsuario();
            }
            //Si hay pacientes existentes en el sistema...
            if($pacientes = $admin->administrarPacientes()){
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/pacientes.php';
            }else{
                header('Location: /404');
                exit();
            }
        }

        //Funcion que permite añadir un medico
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

        //Funcion que permite modificar un medico
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
                $mensaje_exito = "Usuario modificado exitosamente";//Mensaje de exito a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        //Funcion que permite añadir un paciente
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

        //Funcion que permite modificar un paciente
        public function modificarPaciente(){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $email = $_POST['email'];
            $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

            $admin = new Modelo_Administrador();

            if($admin->modificarPaciente($id,$nombre, $apellido, $cedula, $email, $contraseña)){
                $mensaje_exito = "Usuario modificado exitosamente";//Mensaje de exito a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        //Funcion que permite eliminar un usuario
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

        //Funcion que permite añadir una clinica
        public function añadirClinica(){
            $clinica = $_POST['clinica'];
            $id_corregimiento = $_POST['corregimiento'];

            $admin = new Modelo_Administrador();
            if($admin->añadirClinica($clinica, $id_corregimiento)){
                $mensaje_exito = "Clinica creada exitosamente";
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        //Funcion que permite modificar una clinica
        public function modificarClinica(){
            $id = $_POST['id'];
            $clinica = $_POST['clinica'];
            $id_corregimiento = $_POST['corregimiento'];

            $admin = new Modelo_Administrador();
            if($admin->modificarClinica($id, $clinica, $id_corregimiento)){
                $mensaje_exito = "Clinica creada exitosamente";
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        //Funcion que permite eliminar una clinica
        public function eliminarClinica(){
            $id = $_POST['id'];

            $admin = new Modelo_Administrador();
            if($admin->eliminarClinica($id)){
                $mensaje_exito = "Clinica eliminada exitosamente";
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        //Funcion que permite añadir una especialidad
        public function añadirEspecialidad(){
            $especialidad = $_POST['especialidad'];

            $admin = new Modelo_Administrador();
            if($admin->añadirEspecialidad($especialidad)){
                $mensaje_exito = "Especialidad creada exitosamente";
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        //Funcion que permite modificar una especialidad
        public function modificarEspecialidad(){
            $id = $_POST['id'];
            $especialidad = $_POST['especialidad'];

            $admin = new Modelo_Administrador();
            if($admin->modificarEspecialidad($id, $especialidad)){
                $mensaje_exito = "Especialidad editada exitosamente";
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        //Funcion que permite eliminar una especialidad
        public function eliminarEspecialidad(){
            $id = $_POST['id'];

            $admin = new Modelo_Administrador();
            if($admin->eliminarEspecialidad($id)){
                $mensaje_exito = "Especialidad eliminada exitosamente";
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        
    }
?>