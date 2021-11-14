<?php
    require './session.php';
    require './DB.php';
    iniciarSesion();
    if(isset($_SESSION['nombre'])){
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
</head>
<body>
    <?php 
        if(isset($_GET['err'])){
            if($_GET['err'] == '1'){
                echo('cedula o contraseña incorrectos </br>');
            }
        }
    ?>
    <a href="./registro.php">Registro</a>
    <a href="./index.php">Inicio</a>
    <h1>Iniciar Sesion</h1>
    <form action="./iniciarSesion.php" method="POST">
        <label for="cedula">Cedula</label> <br>
        <input type="text" name="cedula" placeholder="00-0000-00000" required><br>
        <label for="contraseña">Contraseña</label><br>
        <input type="password" name="contraseña" placeholder="Contraseña" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
    <a href="./reset.php">Olvido su contraseña?</a>
</body>
</html>