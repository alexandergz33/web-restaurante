<?php
// Incluir el archivo de conexión a la base de datos
require_once("conexion.php");

// Verificar si se recibió un ID válido en la solicitud
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];

    // Eliminar el usuario de la base de datos
    $sql = "DELETE FROM usuarios WHERE id=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // La eliminación fue exitosa
        echo "Usuario eliminado exitosamente.";
    } else {
        echo "Error al eliminar el usuario: " . $stmt->error;
    }
} else {
    echo "ID de usuario no válido.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
