<?php
// Incluir el archivo de conexión a la base de datos
require_once("conexion.php");

// Verificar si se recibió un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar la reserva de la base de datos
    $sql = "DELETE FROM reservas WHERE id=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirigir a la página principal de gestión de reservas
        header("Location: greserva.html");
        exit();
    } else {
        echo "Error al eliminar la reserva: " . $stmt->error;
    }
} else {
    echo "ID de reserva no válido.";
    exit();
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
