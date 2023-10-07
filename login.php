<?php
session_start();

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recopila los datos del formulario
$usernameOrEmail = $_POST['username'];
$password = $_POST['password'];

// Consulta para verificar el inicio de sesión
$query = "SELECT * FROM usuarios WHERE (nombre = ? OR email = ?)";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Inicio de sesión exitoso, redirigir a la página principal
        session_start();
        $_SESSION['username'] = $row['nombre'];
        header("Location: principal.html");
        exit();
    } else {
        // Contraseña incorrecta
        echo "Contraseña incorrecta";
    }
} else {
    // Usuario no existe
    echo "Usuario no existe";
}

$stmt->close();
}
?>
