<?php
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $rol = $_POST["rol"];

    // Verificar si las contraseñas coinciden
    if ($password !== $confirmPassword) {
        echo "Las contraseñas no coinciden. Por favor, intenta de nuevo.";
    } else {
        // Hash de la contraseña
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Verificar si el correo electrónico ya está registrado
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "El correo electrónico ya está registrado. Inicia sesión o utiliza otro correo electrónico.";
        } else {
            // Insertar el nuevo usuario en la base de datos
            $insertQuery = "INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($insertQuery);
            $stmt->bind_param("sssss", $nombre, $apellido, $email, $passwordHash, $rol);

            if ($stmt->execute()) {
                echo "¡Registro exitoso!";
                // Redirigir al usuario a la página de inicio de sesión
                header("Location: login.html");
                exit();
            } else {
                echo "Error al registrar usuario: " . $stmt->error;
            }
        }
    }

    $stmt->close();
}

$conexion->close();
?>
