<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Modelos/Modelo_Inicio.php';//Se importa el modelo de inicio

    class ControladorInicio{//Controlador que maneja los metodos correspondientes a un usuario que no está en sesion
        function __construct(){
            
        }

        function index(){//Funcion para la pagina de inicio de sesion
            if(isset($_POST['iniciar'])){
                $this->iniciarSesion();
            }

            //Si hay un query en la url, se almacena el en la variable query y...
            if($query = isset(parse_url($_SERVER['REQUEST_URI'])['query']) ? parse_url($_SERVER['REQUEST_URI'])['query'] : false){
                parse_str($query, $query_array);
                if(isset($query_array['status'])){
                    $mensaje_exito = "Usuario creado exitosamente";//Mensaje de exito a mostrar en el modal
                    require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
                }
            }
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Inicio/index.php';
        }

        function registro(){//Funcion para la pagina de registro
            if(isset($_POST['registro'])){
                $this->registrarPaciente();
            }
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Inicio/registro.php';
        }

        function recuperar(){//Funcion para la pagina de recuperacion de contraseña

            //Si se existe la señar 'recuperar' se ejecuta la funcion que envia el correo de recuperacion
            if(isset($_POST['recuperar']) || isset($_POST['recuperarr'])){
                $this->enviarCambiarContraseña();
            }

            //Si existe la señal 'cambiar' se ejecuta la funcion que cambia la contraseña
            if(isset($_POST['cambiar']) || isset($_POST['cambiarr'])){
                $this->cambiarContraseña();
            }

            //Si hay un query en la url, se almacena el en la variable query y...
            if($query = isset(parse_url($_SERVER['REQUEST_URI'])['query']) ? parse_url($_SERVER['REQUEST_URI'])['query'] : false){
                parse_str($query, $query_array);

                //Si existe el query 'llave' se ejecuta la funcion para verificar si la llave ha expirado
                if(isset($query_array['llave'])){
                    $this->validarRecuperarContraseña($query_array['llave']);
                }
            } 
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Inicio/recuperar.php';
        }

        function enviado(){//Funcion para la pagina de mensaje de correo enviado
            require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Inicio/enviado.php';
        }

        public function registrarPaciente(){// Funcion que procesa el registro de un paciente
            $data['nombre'] = $_POST['nombre'];
            $data['apellido'] = $_POST['apellido'];
            $data['cedula'] = $_POST['cedula'];
            $data['email'] = $_POST['email'];
            $data['contraseña'] = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);//Se encripta la contraseña antes de almacenarla

            $inicio = new Modelo_Inicio();
            if($inicio->registro($data)){//Si el registro fue completado exitosamente...
                $this->registroExitoso(1, $_POST['email']);
            }else{
                $mensaje_error = "Esta cédula ya se encuentra en uso. Por favor intente de nuevo";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            } 
        }

        public function iniciarSesion(){// Funcion que procesa el inicio de sesion de un usuario
            $data['usuario'] = $_POST['usuario'];
            $data['contraseña'] = $_POST['contraseña'];

            $inicio = new Modelo_Inicio();
            if($inicio->iniciarSesion($data)){//Si el inicio de sesion se completó con exito...
                header('Location: /');
                exit();
            }else{
                $mensaje_error = "Usuario o contraseña incorrecta. Por favor intente de nuevo";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        public function registroExitoso($status_num, $email){//Funcion utilizada para indicar un registro exitoso
            //Se importa el archivo para enviar correos
            require_once $_SERVER['DOCUMENT_ROOT'].'/Emails/enviar.php';
            $body = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Emails/registro_exitoso.html');//Se convierte la plantilla html en una cadena de texto
            enviarEmail($email, 'Registro Exitoso', $body);//Se envia el correo

            header("Location: /?status=$status_num");// Redirige al usuario a la pagina de inicio con un query status para indicar el exito
            exit();
        }

        //Funcion que envía el correo para cambiar contraseña
        public function enviarCambiarContraseña(){
            $cedula = $_POST['cedula'];

            $inicio = new Modelo_Inicio();

            //Si el usuario con la cedula introducida existe...
            if($usuario = $inicio->buscarUsuario($cedula)){
                $id = $usuario['id'];
                $email = $usuario['email'];
                $nombre = $usuario['nombre'];
                $expira = date('Y-m-d H:i:s', strtotime("+1 hour"));//Se establece la fecha de expiracion como  ahora + 1 hora
                $llave = bin2hex(random_bytes(32));//Se una llave aleatoria

                $creada = $inicio->crearLlaveRecuperar($id, $llave, $expira);//Se crea la llave de recuperacion en la BD
                if(!is_string($creada)){
                    require_once $_SERVER['DOCUMENT_ROOT'].'/Emails/enviar.php';//Se importa el archivo para enviar emails

                    //Se importa la plantilla
                    $body = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Emails/cambiar_contraseña.html');
                    $body = str_replace(['{{ nombre }}', '{{ llave }}'], [$nombre, $llave], $body);//Se reemplazan los campos

                    //Si el email se envia correctamente...
                    if(enviarEmail($email, 'Cambiar Contraseña', $body)){
                        header('Location: /enviado');
                        exit();
                    }else{
                        $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                        require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
                    }
                }else{
                    $mensaje_error = "Ha ocurrido un error, por favor intentelo de nuevo.";//Mensaje de error a mostrar en el modal
                    require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
                }
            }else{
                $mensaje_error = "Este usuario no existe.";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        //Funcion que valida la vigencia de la llave de recuperacion
        public function validarRecuperarContraseña($llave){
            $inicio = new Modelo_Inicio();

            //Si la llave es vigente...
            if($data = $inicio->validarLlaveVigente($llave)){
                $usuario = $data['cedula'];
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Inicio/recuperar.php';
            }else{
                $mensaje_error = 'Su vinculo de recuperación ha expirado. Por favor intente de nuevo.';
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }

        }

        //Funcion que actualiza la contraseña del usuario
        public function cambiarContraseña(){
            $cedula = $_POST['cedula'];
            $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

            $inicio = new Modelo_Inicio();

            //Si la contraseña se actualizó exitosamente...
            if($inicio->cambiarContraseña($cedula, $contraseña)){
                $mensaje_exito = 'Contraseña actualizada exitosamente';
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }else{
                $mensaje_error = 'Ha ocurrido un error, por favor intentelo de nuevo.';
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        public function error($ruta, $err_num){//Funcion utiliada para indicar un proceso fallido
            header("Location: $ruta?err=$err_num");//Redirige al usuario a la ruta especificada con un query err para indicar que ocurrio un error
            exit();
        }
    }
?>