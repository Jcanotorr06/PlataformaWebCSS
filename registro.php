<?php
    require './session.php';
    require './DB.php';
    registro();
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
    <title>Registro</title>
</head>
<body>
    <a href="./iniciarSesion.php">Iniciar Sesion</a>
    <a href="./index.php">Inicio</a>
    <h1>Registro</h1>
    <form action="registro.php" method="POST">
        <label for="nombre">Nombre</label> <br>
        <input type="text" name="nombre" placeholder="Nombre" required><br>
        <label for="apellido">Apellido</label> <br>
        <input type="text" name="apellido" placeholder="Apellido" required><br>
        <label for="cedula">Cedula</label> <br>
        <input type="text" name="cedula" placeholder="0-0000-00000" required><br>
        <label for="email">Email</label><br>
        <input type="email" name="email" placeholder="correo@email.com" required><br>
        <label for="contraseña">Contraseña</label><br>
        <input type="password" name="contraseña" placeholder="Contraseña" required><br>
        <input type="submit" value="Registrarse" name="submit">
    </form>
</body>
</html>