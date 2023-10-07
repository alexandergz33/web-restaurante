<?php
                    // Incluir el archivo de conexión a la base de datos
                    require_once("conexion.php");

                    // Realizar la consulta SQL para seleccionar las reservas
                    $sql = "SELECT * FROM reservas";
                    $resultado = $conexion->query($sql);

                    // Comprobar si hay registros en la tabla
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $fila['id'] . "</td>";
                            echo "<td>" . $fila['nombre'] . "</td>";
                            echo "<td>" . $fila['telefono'] . "</td>";
                            echo "<td>" . $fila['fecha'] . "</td>";
                            echo "<td>" . $fila['hora'] . "</td>";
                            echo "<td>" . $fila['personas'] . "</td>";
                            echo "<td>" . $fila['mesa'] . "</td>";
                            echo "<td>" . $fila['comentarios'] . "</td>";
                            echo "<td><button class='editar-button' data-reserva-id='" . $fila['id'] . "'><i class='fas fa-edit'></i> Editar</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No hay reservas.</td></tr>";
                    }

                    // Cerrar la conexión a la base de datos
                    $conexion->close();
                    ?>