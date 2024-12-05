<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "academia");

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Obtener el ID del estudiante desde el parámetro de consulta
$studentId = $_GET['id'];

// Consulta para buscar el estudiante por su ID, incluyendo el promedio
$query = "SELECT nombre, email, dni, telefono, promedio FROM estudiantes WHERE id = ?";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "i", $studentId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Mostrar los datos del estudiante si se encuentra
if ($row = mysqli_fetch_assoc($result)) {
    echo "<p><strong>Nombre:</strong> " . htmlspecialchars($row['nombre']) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
    echo "<p><strong>DNI:</strong> " . htmlspecialchars($row['dni']) . "</p>";
    echo "<p><strong>Teléfono:</strong> " . htmlspecialchars($row['telefono']) . "</p>";
    
    // Mostrar el promedio
    echo "<p><strong>Promedio:</strong> " . htmlspecialchars($row['promedio']) . "</p>";
    
    // Consulta para obtener las asignaturas en las que está inscrito el estudiante
    $queryAsignaturas = "SELECT asignaturas.id, asignaturas.nombre, asignaturas.horas 
                         FROM asignaturas
                         JOIN estudiante_asignatura ON asignaturas.id = estudiante_asignatura.asignatura_id
                         WHERE estudiante_asignatura.estudiante_id = ?";
    $stmtAsignaturas = mysqli_prepare($conexion, $queryAsignaturas);
    mysqli_stmt_bind_param($stmtAsignaturas, "i", $studentId);
    mysqli_stmt_execute($stmtAsignaturas);
    $resultAsignaturas = mysqli_stmt_get_result($stmtAsignaturas);

    if (mysqli_num_rows($resultAsignaturas) > 0) {
        echo "<h5>Asignaturas Inscritas:</h5><ul>";
        while ($asignatura = mysqli_fetch_assoc($resultAsignaturas)) {
            echo "<li data-asignatura-id='" . htmlspecialchars($asignatura['id']) . "'>" . htmlspecialchars($asignatura['nombre']) . " (" . htmlspecialchars($asignatura['horas']) . " horas)</li>";
        }
        
        echo "</ul>";
    } else {
        echo "<p>El estudiante no está inscrito en ninguna asignatura.</p>";
    }
} else {
    echo "<p>No se encontró ningún estudiante con ese ID.</p>";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
