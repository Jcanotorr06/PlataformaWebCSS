<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Modelos/Modelo_General.php';//Se importa el modelo de inicio

    //Controlador que maneja los metodos correspondientes a un usuario paciente o medico
    abstract class ControladorGeneral{
        function __construct(){
            
        }

        //Funcion para la pagina de inicio de un usuario paciente o medico
        function index(){
            $general = new Modelo_General();
            if(isset($_POST['cancelar'])){
                if($general->cancelarCita($_POST['id_cita'])){
                    $this->enviarEmailCancelar();//Se envia el email de notificacion al paciente y al medico
                    $mensaje_exito = "Cita cancelada exitosamente";//Mensaje de exito a mostrar en el modal
                }else{
                    $mensaje_error = "Ha ocurrido un error al cancelar su cita";//Mensaje de error a mostrar en el modal
                }
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
            if($citas = $general->listarCitas($_SESSION['id'], $_SESSION['rol'])){//Si el usuario en sesion tiene citas existentes...
                //Se importa la pagina de inicio general
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/index.php';
            }else{
                //Se importa la pagina de inicio vacia
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/vacio.php';
            }
        }

        //Funcion para mostrar las paginas de agendar cita 
        function agendar(){
            if(isset($_POST['agendar']) || isset($_POST['agendar2'])){
                $this->agendarCita();
            }
            if(isset($_POST['siguiente']) || isset($_POST['medico'])){
                $this->listarHorasHabiles();
            }else{
                $general = new Modelo_General();
                $provincias = $general->listarProvincias();
                $distritos = $general->listarDistritos();
                $corregimientos = $general->listarCorregimientos();
                $clinicas = $general->listarClinicas();
                $especialidades = $general->listarEspecialidades();
                $medicos = $general->listarMedicos();
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/agendar.php';
            }
            //Se importa la pagina de agendar citas
        }

        function reprogramar(){
            if(isset($_POST['reprogramar']) || isset($_POST['reprogramar2'])){
                $this->reprogramarCita();
            }
            if(isset($_POST['id_medico'])){
                $this->listarHorasReprogramar();
            }
            else{
                header('Location: /');
            }
        }

         //Funcion que envía correo para notificar cancelacion de la cita a pacientes y medicos
         public function enviarEmailCancelar(){
            $cedula_paciente = $_POST['cedula_paciente'];
            $cedula_medico = $_POST['cedula_medico'];
            $nombre_paciente = $_POST['nombre_paciente'];
            $nombre_medico = $_POST['nombre_medico'];
            $fecha = $_POST['fecha'];

            $general = new Modelo_General();
            $paciente = $general->buscarUsuario($cedula_paciente);
            $medico = $general->buscarUsuario($cedula_medico);
            
            if($paciente && $medico){//Si el paciente y medico existen
                $email_paciente = $paciente['email'];
                $email_medico = $medico['email'];

                //Se importa la plantilla de citas canceladas
                $body_paciente = $body_medico = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Emails/cita_cancelada.html');

                //Se reemplazan los campos nombre y fecha con la informacion correspondiente
                $body_paciente = str_replace(['{{ nombre }}', '{{ fecha }}'], [$nombre_medico, $fecha], $body_paciente);
                $body_medico = str_replace(['{{ nombre }}', '{{ fecha }}'], [$nombre_paciente, $fecha], $body_medico);

                //Se inporta el archivo para enviar correos
                require_once $_SERVER['DOCUMENT_ROOT'].'/Emails/enviar.php';

                //Se envian ambos correos
                enviarEmail($email_paciente, 'Cita Cancelada', $body_paciente);
                enviarEmail($email_medico, 'Cita Cancelada', $body_medico);
            }
         }

         //Funcion lista las horas y fechas habiles de el medico seleccionado
         public function listarHorasHabiles(){
            $id_medico = $_POST['medico'];
            $general = new Modelo_General();

            if($semana = $general->listarHorasHabiles($id_medico)){//Si el medico tiene un horario en la BD...
                $duracion =  $semana[0]['duracion_citas'];//Se almacena la duracion de las citas
                
                //Por cada día en el horario del medico...
                foreach($semana as $dia){
                    $id_dia = $dia['id_dia'];
                    $hora_entrada = strtotime($dia['hora_entrada']);
                    $hora_salida = strtotime($dia['hora_salida']);
                    $horas_habiles = array();

                    while($hora_entrada < $hora_salida){
                        $horas_habiles[] = date('H:i:s', $hora_entrada);
                        $hora_entrada = $hora_entrada + $duracion*60;
                    }
                    //Se crea un arreglo asociativo de arreglos con el id del día.
                    //El arreglo de cada día contiene las horas habiles de ese día
                    $dias_habiles[$id_dia] = $horas_habiles;
                }
                //Se codifica el arreglo en json para ser utilizado en javascript
                $dias_habiles_json = json_encode($dias_habiles);
                
                //Se importa el paso 2 de agendar citas
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/agendar2.php';
            }else{
                header('Location: /?err=4');
                exit();
            }
         }

         //Funcion lista las horas y fechas habiles de el medico de la cita a reprogramar
         public function listarHorasReprogramar(){
            $hora = $_POST['hora'];
            $fecha = $_POST['fecha'];
            $id_cita = $_POST['id_cita'];
            $id_medico = $_POST['id_medico'];
            $general = new Modelo_General();

            if($semana = $general->listarHorasHabiles($id_medico)){
                $duracion =  $semana[0]['duracion_citas'];
                foreach($semana as $dia){
                    $id_dia = $dia['id_dia'];
                    $hora_entrada = strtotime($dia['hora_entrada']);
                    $hora_salida = strtotime($dia['hora_salida']);
                    $horas_habiles = array();
                    while($hora_entrada < $hora_salida){
                        $horas_habiles[] = date('H:i:s', $hora_entrada);
                        $hora_entrada = $hora_entrada + $duracion*60;
                    }
                    $dias_habiles[$id_dia] = $horas_habiles;
                }
                $dias_habiles_json = json_encode($dias_habiles);
                
                //Se importa la pagina de reprogramar citas
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/reprogramar.php';
            }else{
                header('Location: /?err=4');
                exit();
            }
         }

         //Funcion que permite agendar citas
         public function agendarCita(){
            $data['id_usuario'] = $_SESSION['id'];
            $data['id_medico'] = $_POST['medico'];
            $data['fecha'] = $_POST['fecha'];
            $data['hora'] = $_POST['hora'];

            $general = new Modelo_General();
            if($general->agendarCita($data)){//Si se agendó la cita exitosamente...
                $paciente = $general->BuscarEmail($data['id_usuario']);
                $medico = $general->BuscarEmail($data['id_medico']);

                //Se importa la plantilla de citas agendadas
                $body_paciente = $body_medico = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Emails/cita_agendada.html');

                //Se reemplazan los campos nombre y fecha con la informacion correspondiente
                $body_paciente = str_replace(['{{ fecha }}', '{{ hora }}'], [$data['fecha'], $data['hora']], $body_paciente);
                $body_medico = str_replace(['{{ fecha }}', '{{ hora }}'], [$data['fecha'], $data['hora']], $body_medico);

                //Se inporta el archivo para enviar correos
                require_once $_SERVER['DOCUMENT_ROOT'].'/Emails/enviar.php';

                //Se envian ambos correos
                enviarEmail($paciente['email'], 'Cita Agendada', $body_paciente);
                enviarEmail($medico['email'], 'Cita Agendada', $body_medico);

                //Se redirige en 3 segundos con javascript
                echo "<script>window.setTimeout(()=>{window.location.href = '/'},3000)</script>";

                $mensaje_exito = 'Cita agendada exitosamente. Redirigiendo a la pagina de inicio';
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa el modal
            }else{
                $mensaje_error = 'Fecha y hora no disponible. Por favor intentelo de nuevo.';
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }

        //Funcion que permite reprogramar una cita
        public function reprogramarCita(){
            $data['id_cita'] = $_POST['id_cita'];
            $data['id_medico'] = $_POST['id_medico'];
            $data['fecha'] = $_POST['fecha'];
            $data['hora'] = $_POST['hora'];

            $general = new Modelo_General();
            if($general->reprogramarCita($data)){//Si se reprogramó la cita exitosamente...
                $paciente = $general->BuscarEmail($_SESSION['id']);
                $medico = $general->BuscarEmail($data['id_medico']);

                //Se importa la plantilla de citas reprogramadas
                $body_paciente = $body_medico = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Emails/cita_reprogramada.html');

                //Se reemplazan los campos nombre y fecha con la informacion correspondiente
                $body_paciente = str_replace(['{{ fecha }}', '{{ hora }}'], [$data['fecha'], $data['hora']], $body_paciente);
                $body_medico = str_replace(['{{ fecha }}', '{{ hora }}'], [$data['fecha'], $data['hora']], $body_medico);

                //Se inporta el archivo para enviar correos
                require_once $_SERVER['DOCUMENT_ROOT'].'/Emails/enviar.php';

                //Se envian ambos correos
                enviarEmail($paciente['email'], 'Cita Reprogramada', $body_paciente);
                enviarEmail($medico['email'], 'Cita Reprogramada', $body_medico);
                
                //Se redirige en 3 segundos con javascript
                echo "<script>window.setTimeout(()=>{window.location.href = '/'},3000)</script>";
                $mensaje_exito = 'Cita reprogramada exitosamente. Redirigiendo a la pagina de inicio';
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }else{
                $mensaje_error = 'Fecha y hora no disponible. Por favor intentelo de nuevo.';
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modal1Boton.php';//Se importa elm modal
            }
        }
    }

?>