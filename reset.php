<?php
    require './session.php';
    require './DB.php';

    enviarResetContraseña();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset</title>
</head>
<body>
    <h1>Restablecer Contraseña</h1>
    <form action="./reset.php" method="post">
        <label for="cedula">Cedula</label>
        <input type="text" name="cedula">
        <input type="submit" value="Enviar" name="reset">
    </form>
</body>
</html>