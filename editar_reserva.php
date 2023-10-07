<?php
// Incluir el archivo de conexión a la base de datos
require_once("conexion.php");

// Verificar si se recibió un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar si se envió el formulario de edición
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $personas = $_POST['personas'];
        $mesa = $_POST['mesa'];
        $comentarios = $_POST['comentarios'];

        // Actualizar la reserva en la base de datos
        $sql = "UPDATE reservas SET nombre=?, telefono=?, fecha=?, hora=?, personas=?, mesa=?, comentarios=? WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssssiiis", $nombre, $telefono, $fecha, $hora, $personas, $mesa, $comentarios, $id);

        if ($stmt->execute()) {
            // Redirigir a la página principal de gestión de reservas
            header("Location: greserva.html");
            exit();
        } else {
            echo "Error al actualizar la reserva: " . $stmt->error;
        }
    }

    // Obtener los datos de la reserva a editar
    $sql = "SELECT * FROM reservas WHERE id=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $reserva = $result->fetch_assoc();
    } else {
        echo "Reserva no encontrada.";
        exit();
    }
} else {
    echo "ID de reserva no válido.";
    exit();
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    <link rel="stylesheet" type="text/css" href="Greserva.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        h1 {
            margin: 0;
        }

        main {
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
    input[type="tel"],
    input[type="date"],
    input[type="time"],
    input[type="number"],
    textarea {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 1000%; /* Ancho del 100% del contenedor */
        max-width: 400px; /* Máximo ancho permitido */
    }
        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #555;
        }
        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 380px; /* Ajusta el espaciado del ícono a la izquierda */
        }
    </style>
<body>
    <header>
        <h1>Editar Reserva</h1>
    </header>
    <main>
        <div class="container">
            <h2>Detalles de la Reserva</h2>
            <form method="post" action="editar_reserva.php?id=<?php echo $id; ?>">
                <!-- Campo de entrada con ícono -->
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $reserva['nombre']; ?>" required>
                </div>
                <!-- Campo de entrada con ícono -->
                <div class="input-icon">
                    <i class="fas fa-phone"></i>
                    <input type="tel" id="telefono" name="telefono" value="<?php echo $reserva['telefono']; ?>" required>
                </div>
                <!-- Campo de entrada con ícono -->
                <div class="input-icon">
                    
                    <input type="date" id="fecha" name="fecha" value="<?php echo $reserva['fecha']; ?>" required>
                </div>
                <!-- Campo de entrada con ícono -->
                <div class="input-icon">
              
                    <input type="time" id="hora" name="hora" value="<?php echo $reserva['hora']; ?>" required>
                </div>
                <!-- Campo de entrada con ícono -->
                <div class="input-icon">
                    <i class="fas fa-users"></i>
                    <input type="number" id="personas" name="personas" value="<?php echo $reserva['personas']; ?>" required>
                </div>
                <!-- Campo de entrada con ícono -->
                <div class="input-icon">
                    <i class="fas fa-chair"></i> <!-- Cambia al ícono de una silla o mesa -->
                    <input type="number" id="mesa" name="mesa" value="<?php echo $reserva['mesa']; ?>" required>
                </div>
                <!-- Campo de entrada con ícono -->
                <div class="input-icon">
                    <i class="fas fa-comment"></i>
                    <textarea id="comentarios" name="comentarios"><?php echo $reserva['comentarios']; ?></textarea>
                </div>
                
                <button type="submit">Guardar Cambios</button>
            <br>
            </form>
            <form method="post" action="eliminar_reserva.php?id=<?php echo $id; ?>">
    <button type="submit" class="eliminar-button">Eliminar Reserva</button>
</form>

           
           
        </div>
    </main>
</body>
</html>
