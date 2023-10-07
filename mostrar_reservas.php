<?php
// Incluir el archivo de conexión a la base de datos
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $personas = $_POST["personas"];
    $mesa = $_POST["mesa"];
    $comentarios = $_POST["comentarios"];

    // Realizar la inserción en la base de datos (debes ajustar esto según tu estructura de base de datos)
    $sql = "INSERT INTO reservas (nombre, telefono, fecha, hora, personas, mesa, comentarios) VALUES ('$nombre', '$telefono', '$fecha', '$hora', '$personas', '$mesa', '$comentarios')";
    if ($conexion->query($sql) === TRUE) {
        // Redirigir al usuario a Greserva.html
        header("Location: Greserva.html");
        exit;
    } else {
        echo "Error al realizar la reserva: " . $conexion->error;
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
