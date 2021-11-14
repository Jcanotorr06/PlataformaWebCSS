<?php
    require './session.php';
    require './DB.php';
    if($_SESSION['rol'] == 'paciente' || $_SESSION['rol'] == 'medico'){
        header('Location: index.php');
        exit();
    }
    $pacientes = administrarPacientes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Pacientes</title>
</head>
<body>
    <?php require './componentes/navegacion/nav.php'?>
    <h1>Pacientes</h1>
    <?php if(is_string($pacientes)): ?>
        <h1><?php echo($pacientes)?></h1>
    <?php else: ?>
        <table>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cedula</th>
                <th>Email</th>
                <th>Contraseña</th>
            </tr>
            <?php while($row = $pacientes->fetch_assoc()): ?>
                <tr>
                    <td><?php echo($row['id']) ?></td>
                    <td><?php echo($row['nombre']) ?></td>
                    <td><?php echo($row['apellido']) ?></td>
                    <td><?php echo($row['cedula']) ?></td>
                    <td><?php echo($row['email']) ?></td>
                    <td><?php echo($row['contraseña']) ?></td>
                </tr>
            <?php endwhile ?>
        </table>
    <?php endif ?>
</body>
</html>