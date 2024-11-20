<?php
    $conexion = new mysqli("localhost","root","","multimedia");
    if($conexion->connect_error){
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $id = $_GET['id'];
    $query = "SELECT nombre,imagen FROM imagenes WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt -> bind_param('i', $id);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($nombre, $imagen);

    echo $nombre;
    if($stmt -> fetch()){
        header("Content-Type: image/jpg");
        echo $imagen;
    }else{
        echo "Imagen no encontrada";
    }   

    $stmt->close();
    $conexion->close();
?>