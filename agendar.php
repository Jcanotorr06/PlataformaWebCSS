<?php
    require './session.php';
    require './DB.php';
    if(!isset($_SESSION['nombre'])){
        header("Location: iniciarSesion.php");
        exit();
    }
    function toArray($dbQuery){
        if(!is_string($dbQuery) || !is_bool($dbQuery)){
            $i = 0;
            $dbQueryArray = array();
            while($r = $dbQuery->fetch_assoc()){
                $dbQueryArray[$i] = $r;
                $i++;
            }
            return $dbQueryArray;
        }
    }
    $provincias = listarProvincias();
    $distritos = listarDistritos();
    $corregimientos = listarCorregimientos();

    $provincias_arr = toArray($provincias);
    $provincias_json = json_encode($provincias_arr);

    $distritos_arr = toArray(listarDistritos());
    $corregimientos_arr = toArray(listarCorregimientos());
    $clinicas_arr = toArray(listarClinicas());
    $especialidades_arr = toArray(listarEspecialidades());
    $medicos_arr = toArray(listarMedicos());

    agendarCita();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
</head>
<body>
    <?php require './componentes/navegacion/nav.php' ?>
    <h1>Agendar Cita</h1>
    <?php if(is_string($provincias) || is_string($distritos)): ?>
        <h1>Error</h1>
    <?php else: ?>
        <form action="agendar.php" method="post">
            <?php echo("<input type='hidden' name='id_usuario' value='".$_SESSION['id']."'/>")?>
            <label for="provincias">Provincias</label><br>
            <select required name="provincias" id="select_provincia" onchange="logProvinciaId()">
                <option value="" disabled selected hidden>Seleccione una Provincia</option>
                <?php foreach($provincias_arr as $provincia): ?>
                    <?php echo("<option value='".$provincia['id']."'>".$provincia['provincia']."</option>");?>
                <?php endforeach?>
            </select><br>
    
            <label for="distritos">Distrito</label><br>
            <select required name="distritos" id="select_distrito">
                <option value="" disabled selected hidden>Seleccione un Distrito</option>
                <?php foreach($distritos_arr as $distrito): ?>
                    <?php echo("<option value='".$distrito['id']."'>".$distrito['distrito']."</option>");?>
                <?php endforeach?>
            </select><br>
    
            <label for="corregimientos">Corregimientos</label><br>
            <select required name="corregimientos" id="select_corregimiento">
                <option value="" disabled selected hidden>Seleccione un Corregimiento</option>
                <?php foreach($corregimientos_arr as $corregimiento): ?>
                    <?php echo("<option value='".$corregimiento['id']."'>".$corregimiento['corregimiento']."</option>");?>
                <?php endforeach?>
            </select><br>
    
            <label for="clinicas">Clinicas</label><br>
            <select required name="clinicas" id="select_clinica">
                <option value="" disabled selected hidden>Seleccione una Clinica</option>
                <?php foreach($clinicas_arr as $clinica): ?>
                    <?php echo("<option value='".$clinica['id']."'>".$clinica['clinica']."</option>");?>
                <?php endforeach?>
            </select><br>
    
            <label for="especialidades">Especialidades</label><br>
            <select required name="especialidades" id="select_especialidad">
                <option value="" disabled selected hidden>Seleccione una Especialidad</option>
                <?php foreach($especialidades_arr as $especialidad): ?>
                    <?php echo("<option value='".$especialidad['id']."'>".$especialidad['especialidad']."</option>");?>
                <?php endforeach?>
            </select><br>
    
            <label for="medicos">Medicos</label><br>
            <select required name="medicos" id="select_medico">
                <option value="" disabled selected hidden>Seleccione una Medico</option>
                <?php foreach($medicos_arr as $medico): ?>
                    <?php echo("<option value='".$medico['id']."'>".$medico['nombre']."</option>");?>
                <?php endforeach?>
            </select><br>
    
            <label for="fecha">Fecha</label><br>
            <input required type="date" name="fecha"><br>
    
            <label for="hora">Hora</label><br>
            <input required type="time" name="hora"><br>

            <label for="duracion">Duracion(Minutos)</label><br>
            <input type="number" name="duracion" required><br>

            <input type="submit" name="agendar" value="Agendar Cita">
        </form>
        
    <?php endif ?>
    <script>
        var provincia_id = document.getElementById("select_provincia").value;
        const logProvinciaId = () => {
            var provincia_id = document.getElementById("select_provincia").value;
            console.log(provincia_id);
        }

        /* const hey = () => {
            var x = (<?php echo($provincias_json)?>);
            Object.keys(x).map(i => {
                console.log(x[i].provincia)
            })  
        } */
    </script>
</body>
</html>