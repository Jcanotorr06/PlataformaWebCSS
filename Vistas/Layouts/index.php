<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="public/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="public/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        <?php include "styles.css"?>
    </style>
</head>
<body>
    <header class=" flex-grow-0">
        <?php 
            if(isset($_SESSION['rol'])){
                if($_SESSION['rol'] == ('paciente' || 'medico')){
                    require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/navbar.php';
                }
            } 
        ?>
    </header>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/router.php'?>
</body>
</html>