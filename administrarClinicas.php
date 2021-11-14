<?php
    require './session.php';
    require './DB.php';
    if($_SESSION['rol'] == 'paciente' || $_SESSION['rol'] == 'medico'){
        header('Location: index.php');
        exit();
    }
    $clinicas = administrarClinicas();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Clinicas</title>
</head>
<body>
    <?php require './componentes/navegacion/nav.php'?>
    <h1>Clinicas</h1>
    <?php if(is_string($clinicas)): ?>
        <h1><?php echo($clinicas)?></h1>
    <?php else: ?>
        <table>
            <tr>
                <th>Id</th>
                <th>Clinica</th>
                <th>Corregimiento</th>
                <th>Distrito</th>
                <th>Provincia</th>
            </tr>
            <?php while($row = $clinicas->fetch_assoc()): ?>
                <tr>
                    <td><?php echo($row['id']) ?></td>
                    <td><?php echo($row['clinica']) ?></td>
                    <td><?php echo($row['corregimiento']) ?></td>
                    <td><?php echo($row['distrito']) ?></td>
                    <td><?php echo($row['provincia']) ?></td>
                </tr>
            <?php endwhile ?>
        </table>
    <?php endif ?>
</body>
</html>