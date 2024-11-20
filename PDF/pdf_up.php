<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdf'])){
        
        $conexion = new mysqli("localhost","root","","multimedia");
        if($conexion->connect_error){
            die("Conexión fallida: " . $conexion->connect_error);
        }
        
        $nombre = $_FILES['pdf']['name'];

        $pdf = file_get_contents($_FILES['pdf']['tmp_name']);

        $query = "INSERT INTO documentos (nombre, pdf) VALUES (?,?)";

        $stmt = $conexion->prepare($query);
        $stmt -> bind_param('sb', $nombre, $pdf);
        $stmt -> send_long_data(1, $pdf);
        $stmt -> execute();

        echo "Documento subido correctamente";
        $stmt->close();
        $conexion->close();
    }
?>