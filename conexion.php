<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "midelicia";

$conexion = new mysqli($server, $user, $pass, $db);

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
    
} else {
    echo "Conexión exitosa a la base de datos.";
}
?>