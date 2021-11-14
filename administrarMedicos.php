<?php
    require './session.php';
    require './DB.php';
    if($_SESSION['rol'] == 'paciente' || $_SESSION['rol'] == 'medico'){
        header('Location: index.php');
        exit();
    }
    $medicos = administrarMedicos();
    agregarMedicos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Medicos</title>
</head>
<body>
    <?php require './componentes/navegacion/nav.php'?>
    <h1>Medicos</h1>
    <?php if(is_string($medicos)): ?>
        <h1><?php echo($medicos)?></h1>
    <?php else: ?>
        <table>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cedula</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Especialidad</th>
                <th>Clinica</th>
            </tr>
            <?php while($row = $medicos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo($row['id']) ?></td>
                    <td><?php echo($row['nombre']) ?></td>
                    <td><?php echo($row['apellido']) ?></td>
                    <td><?php echo($row['cedula']) ?></td>
                    <td><?php echo($row['email']) ?></td>
                    <td><?php echo($row['contraseña']) ?></td>
                    <td><?php echo($row['especialidad']) ?></td>
                    <td><?php echo($row['clinica']) ?></td>
                </tr>
            <?php endwhile ?>
        </table>
    <?php endif ?>
    <br>
    <br>
    <form action="administrarMedicos.php" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" placeholder="Nombre"><br>
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" placeholder="Apellido"><br>
        <label for="cedula">Cedula</label>
        <input type="text" name="cedula" placeholder="Cedula"><br>
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email"><br>
        <label for="contraseña">Contraseña</label>
        <input type="password" name="contraseña" placeholder="Contraseña"><br>
        <label for="especialidad">Especialidad</label>
        <select name="especialidad">
            <?php 
                $especialidades = administrarEspecialidades(); 
                while($esp = $especialidades->fetch_assoc()){
                    $id_esp = $esp['id'];
                    $nom_esp = $esp['especialidad'];
                    echo("<option value='$id_esp'>$nom_esp</option>");
                }
            ?>
        </select><br>
        <label for="clinica">Clinica</label>
        <select name="clinica">
            <?php 
                $clinicas = administrarClinicas(); 
                while($cli = $clinicas->fetch_assoc()){
                    $id_cli = $cli['id'];
                    $nom_cli = $cli['clinica'];
                    echo("<option value='$id_cli'>$nom_cli</option>");
                }
            ?>
        </select><br>
        <label for="hora_entrada">Hora de Entrada</label>
        <input type="time" name="hora_entrada"><br>
        <label for="hora_salida">Hora de Salida</label>
        <input type="time" name="hora_salida"><br>
        <input type="submit" value="Agregar" name="submit">
    </form>
</body>
</html>