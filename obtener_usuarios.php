<?php
// Incluir el archivo de conexión a la base de datos
require_once("conexion.php");

// Realizar una consulta SQL para obtener los usuarios
$sql = "SELECT id, nombre, apellido, email FROM usuarios";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    // Iniciar la tabla HTML
    echo '<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo Electrónico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

    while ($fila = $resultado->fetch_assoc()) {
        // Generar una fila de la tabla para cada usuario
        echo '<tr data-cliente-id="' . $fila["id"] . '">';
        echo '<td>' . $fila["id"] . '</td>';
        echo '<td class="nombre">' . $fila["nombre"] . '</td>';
        echo '<td class="apellido">' . $fila["apellido"] . '</td>';
        echo '<td class="email">' . $fila["email"] . '</td>';
        // Agregar botones "Editar" y "Eliminar" a cada fila
        echo '<td>
                <button class="editar-button"><i class="fas fa-edit"></i> Editar</button>
                <button class="eliminar-button"><i class="fas fa-trash"></i> Eliminar</button>
              </td>';
        echo '</tr>';
    }

    // Cerrar la tabla HTML
    echo '</tbody></table>';
} else {
    echo "No se encontraron usuarios.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
