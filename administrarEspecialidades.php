<?php
    require './session.php';
    require './DB.php';
    if($_SESSION['rol'] == 'paciente' || $_SESSION['rol'] == 'medico'){
        header('Location: index.php');
        exit();
    }
    $especialidades = administrarEspecialidades();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Especialidades</title>
</head>
<body>
    <?php require './componentes/navegacion/nav.php'?>
    <h1>Especialidades</h1>
    <?php if(is_string($especialidades)): ?>
        <h1><?php echo($especialidades)?></h1>
    <?php else: ?>
        <table>
            <tr>
                <th>Id</th>
                <th>Especialidad</th>
            </tr>
            <?php while($row = $especialidades->fetch_assoc()): ?>
                <tr>
                    <td><?php echo($row['id']) ?></td>
                    <td><?php echo($row['especialidad']) ?></td>
                </tr>
            <?php endwhile ?>
        </table>
    <?php endif ?>
</body>
</html>