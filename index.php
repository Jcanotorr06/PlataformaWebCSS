<?php
    require './session.php';
    require './DB.php';
    if(!isset($_SESSION['nombre'])){
        header("Location: iniciarSesion.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    <?php require './componentes/navegacion/nav.php'?>
    <?php if($_SESSION['rol'] == 'paciente'): ?>
        <script src="https://unpkg.com/petite-vue" defer init></script>
        <h1>Bienvenido paciente <?php echo($_SESSION['nombre'].' '.$_SESSION['apellido']); ?></h1>
    <?php elseif($_SESSION['rol'] == 'medico'): ?>
        <script src="https://unpkg.com/petite-vue" defer init></script>
        <h1>Bienvenido medico <?php echo($_SESSION['nombre'].' '.$_SESSION['apellido']); ?></h1>
    <?php else: ?>
        <?php require './componentes/admin/dashboard.php' ?>
    <?php endif ?>
</body>
</html>