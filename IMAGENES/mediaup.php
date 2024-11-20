<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagen'])){
        
        $conexion = new mysqli("localhost","root","","multimedia");
        if($conexion->connect_error){
            die("Conexión fallida: " . $conexion->connect_error);
        }
        
        $nombre = $_FILES['imagen']['name'];
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
        $query = "INSERT INTO imagenes (nombre, imagen) VALUES (?,?)";
        $stmt = $conexion->prepare($query);
        $stmt -> bind_param('sb', $nombre, $imagen);
        $stmt -> send_long_data(1, $imagen);
        $stmt -> execute();

        echo "Imagen subida correctamente";
        $stmt->close();
        $conexion->close();
    }
?>