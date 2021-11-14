<?php 
    require_once './vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $connection = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_DB']);

    if(!$connection){
        throw new Exception("conexion con el host de la base de datos fallida");
    }
?>