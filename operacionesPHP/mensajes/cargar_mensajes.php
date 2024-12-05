<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "academia", "3306");

// Verificar conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Consulta para obtener los mensajes
$sql = "SELECT nombre, asunto, mensaje, fecha FROM mensajes ORDER BY fecha DESC";
$result = mysqli_query($conexion, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Iterar sobre los resultados y generar el HTML para cada mensaje
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="message">';
        echo '<div class="message-header">';
        echo '<span>' . htmlspecialchars($row['nombre']) . '</span>';
        echo '<span>' . htmlspecialchars($row['fecha']) . '</span>';
        echo '</div>';
        echo '<div><strong>Asunto:</strong> ' . htmlspecialchars($row['asunto']) . '</div>';
        echo '<div class="message-content">' . htmlspecialchars($row['mensaje']) . '</div>';
        echo '</div>';
    }
} else {
    // Si no hay mensajes, mostrar un mensaje por defecto
    echo '<p>No hay mensajes disponibles.</p>';
}


// Cerrar la conexión
mysqli_close($conexion);
?>
