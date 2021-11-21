<?php
    require './DBconnection.php';

    function registro(){
        if(isset($_POST['submit'])){
            global $connection;
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $email = $_POST['email'];
            $contraseña = $_POST['contraseña'];
            $hash = password_hash($contraseña, PASSWORD_DEFAULT);

            $query = "CALL crear_usuario('$nombre','$apellido','$cedula','$email','$hash')";

            $res_query = mysqli_query($connection, $query);

            if($res_query){
                header("Location: iniciarSesion.php");
                exit();
            }else{
                throw new Exception("Error al crear usuario");
                header("Location: registro.php");
                exit();
            }
        }
    }

    function iniciarSesion(){
        if(isset($_POST['cedula']) && isset($_POST['contraseña'])){
            global $connection;
            $cedula = $_POST['cedula'];
            $contraseña = $_POST['contraseña'];

            $query = "CALL iniciar_sesion('$cedula')";

            $res_query = mysqli_query($connection, $query);

            if($res_query->num_rows > 0){
                $row = $res_query->fetch_assoc();
                $hash = $row['contraseña'];
                if(password_verify($contraseña, $hash)){
                    $id = $row['id'];
                    $nombre = $row['nombre'];
                    $apellido = $row['apellido'];
                    $rol = $row['rol'];

                    $_SESSION['id'] = $id;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['apellido'] = $apellido;
                    $_SESSION['rol'] = $rol;
                    header('Location: index.php');
                    exit();
                }else{
                    header('Location: iniciarSesion.php?err=1');
                    exit();
                }
            }else{
                header('Location: iniciarSesion.php?err=1');
                exit();
            }
            
        }
    }

    function getDatosGenerales(){
        global $connection;
        $query = "SELECT * FROM datos_generales";

        $res_query = mysqli_query($connection, $query);

        if($res_query->num_rows > 0){
            $row = $res_query->fetch_assoc();
            return $row;
        }
    }

    function administrarPacientes(){
        global $connection;
        $query = "SELECT * FROM administrar_pacientes";

        $res_query = mysqli_query($connection, $query);

        if($res_query->num_rows > 0){
            return $res_query;
        }else{
            return ('No hay pacientes en el sistema');
        }
    }

    function administrarMedicos(){
        global $connection;
        $query = "SELECT * FROM administrar_medicos";

        $res_query = mysqli_query($connection, $query);

        if($res_query->num_rows > 0){
            return $res_query;
        }else{
            return ('No hay medicos en el sistema');
        }
    }

    function administrarClinicas(){
        global $connection;
        $query = "SELECT * FROM administrar_clinicas";

        $res_query = mysqli_query($connection, $query);

        if($res_query->num_rows > 0){
            return $res_query;
        }else{
            return ('No hay clinicas en el sistema');
        }
    }

    function administrarEspecialidades(){
        global $connection;
        $query = "SELECT * FROM administrar_especialidades";

        $res_query = mysqli_query($connection, $query);

        if($res_query->num_rows > 0){
            return $res_query;
        }else{
            return ('No hay especialidades en el sistema');
        }
    }

    function listarProvincias(){
        global $connection;
        $query = "SELECT * FROM provincias";

        $res_query = mysqli_query($connection, $query);

        if($res_query->num_rows > 0){
            return $res_query;
        }else{
            return ('No hay provincias');
        }
    }

    function listarDistritos(){
        global $connection;
        $query = "SELECT * FROM distritos";

        $res_query = mysqli_query($connection, $query);

        if($res_query->num_rows > 0){
            return $res_query;
        }else{
            return ('No hay distritos');
        }
    }

    function listarCorregimientos(){
        global $connection;
        $query = "SELECT * FROM corregimientos";

        $res_query = mysqli_query($connection, $query);

        if($res_query->num_rows > 0){
            return $res_query;
        }else{
            return ('No hay corregimientos');
        }
    }

    function listarClinicas(){
        global $connection;
        $query = "SELECT * FROM clinicas";

        $res_query = mysqli_query($connection, $query);

        if($res_query->num_rows > 0){
            return $res_query;
        }else{
            return ('No hay clinicas');
        }
    }

    function listarEspecialidades(){
        global $connection;
        $query = "SELECT * FROM especialidades";

        $res_query = mysqli_query($connection, $query);

        if($res_query->num_rows > 0){
            return $res_query;
        }else{
            return ('No hay especialidades');
        }
    }

    function listarMedicos(){
        global $connection;
        $query = "SELECT * FROM listar_medicos";

        $res_query = mysqli_query($connection, $query);

        if($res_query->num_rows > 0){
            return $res_query;
        }else{
            return ('No hay medicos');
        }
    }
    
    function listarCitasPaciente(){
        global $connection;
        $query = "CALL ver_citas_paciente_sesion('".$_SESSION['id']."')";

        $res_query = mysqli_query($connection, $query);

        if($res_query->num_rows > 0){
            return $res_query;
        }else{
            return ('No tiene citas agendadas');
        }
    }

    function agregarMedicos(){
        if(isset($_POST['submit'])){
            global $connection;
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $email = $_POST['email'];
            $contraseña = $_POST['contraseña'];
            $hash = password_hash($contraseña, PASSWORD_DEFAULT);
            $especialidad = $_POST['especialidad'];
            $clinica = $_POST['clinica'];

            $query = "CALL agregar_medico('$nombre','$apellido','$cedula','$email','$hash','$especialidad','$clinica')";

            $res_query = mysqli_query($connection, $query);

            if($res_query){
                header("Location: administrarMedicos.php");
                exit();
            }else{
                header("Location: administrarMedicos.php?err=1");
                exit();
            }
        }
    }

    function agendarCita(){
        if(isset($_POST['agendar'])){
            global $connection;
            $id_usuario = $_POST['id_usuario'];
            $id_medico = $_POST['medicos'];
            $fecha_str = $_POST['fecha'];
            $fecha = date("Y-m-d", strtotime($fecha_str));
            $hora_str = $_POST['hora'];
            $hora = date("H:i:s", strtotime($hora_str));
            $duracion = $_POST['duracion'];

            $query = "CALL agendar_cita('$id_usuario','$id_medico','$fecha','$hora','$duracion')";

            $res_query = mysqli_query($connection, $query);
            if($res_query){
                header("Location: index.php");
                exit();
            }else{
                header("Location index.php?err=1");
                exit();
            }
        }
    }

    function cancelarCita(){
        if(isset($_POST['cancelar'])){
            global $connection;
            $id_cita = $_POST['id_cita'];

            $query = "DELETE FROM citas WHERE id=$id_cita";

            $res_query = mysqli_query($connection, $query);

            if($res_query){
                echo'Cita Eliminada Exitosamente';
            }else{
                echo mysqli_error($connection);
            }
        }
    }

    function enviarResetContraseña(){
        if(isset($_POST['reset'])){
            global $connection;
            $cedula = $_POST['cedula'];

            $query = "SELECT id, email FROM usuarios WHERE cedula='$cedula'";
            $res_query = mysqli_query($connection, $query);

            if($res_query->num_rows > 0){
                $row = $res_query->fetch_assoc();
                $email = $row['email'];
                $id = $row['id'];
                $expira = date('Y-m-d H:i:s', strtotime("+1 hour"));
                require './test.php';
                $key = bin2hex(random_bytes(32));
                $query2 = "INSERT INTO recuperar_contraseña(id_usuario, llave, expira) VALUES($id, '$key', '$expira')";
                $res_query2 = mysqli_query($connection, $query2);
                if($res_query2){
                    if(resetContraseña($email, $key)){
                        echo 'Mensaje enviado exitosamente';
                    }else{
                        echo 'error';
                    }
                }else{
                    echo 'error al crear token';
                }
            }else{
                header('Location: index.php?err=2');
                exit();
            }
        }
    }
?>