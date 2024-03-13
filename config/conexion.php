<?php 

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "roma";

    $conectar = new mysqli($host, $user, $pass, $db);

    if (!$conectar){
        echo 'Conexion fallida';
    }
?>