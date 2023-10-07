<?php
// Incluir el archivo de conexión a la base de datos
require_once("conexion.php");

// Verificar si se recibió un ID válido en la solicitud
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];

    // Obtener los datos del formulario de edición
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];

    // Actualizar el usuario en la base de datos
    $sql = "UPDATE usuarios SET nombre=?, apellido=?, email=? WHERE id=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $apellido, $email, $id);

    if ($stmt->execute()) {
        // La actualización fue exitosa

        // Obtener los datos actualizados del usuario
        $sql = "SELECT * FROM usuarios WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Devuelve los datos del usuario como respuesta JSON
            echo json_encode($row);
        } else {
            echo "Error al obtener datos actualizados.";
        }
    } else {
        echo "Error al actualizar el usuario: " . $stmt->error;
    }
} else {
    echo "ID de usuario no válido.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
