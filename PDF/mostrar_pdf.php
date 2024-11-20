<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "multimedia");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id = $_GET['id']; // Obtener el id desde la URL

// Consulta para obtener el nombre del archivo y el contenido PDF
$query = "SELECT nombre, pdf FROM documentos WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param('i', $id);  // Vincular el parámetro 'id' como entero
$stmt->execute();

// Guardar los resultados
$stmt->store_result();
$stmt->bind_result($nombre, $pdf);

// Verificar si se encontró el archivo
if ($stmt->fetch()) {
    // Enviar los encabezados para el archivo PDF
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=\"" . $nombre . "\"");

    // Calcular el tamaño del archivo PDF y enviarlo en Content-Length
    header("Content-Length: " . strlen($pdf)); // strlen() está bien para obtener el tamaño del contenido binario

    // Enviar el contenido del archivo PDF
    echo $pdf;
} else {
    echo "Documento no encontrado";
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conexion->close();
?>
