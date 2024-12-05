<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "academia");

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Obtener datos del formulario
$estudiante_id = mysqli_real_escape_string($conexion, $_POST['estudiante_id']);
$asignatura_ids = $_POST['asignatura_ids']; // Esto será un array de asignaturas

// Verificar si el estudiante existe
$checkQuery = "SELECT id FROM estudiantes WHERE id = '$estudiante_id'";
$result = mysqli_query($conexion, $checkQuery);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('El estudiante no existe.'); window.history.back();</script>";
    exit; // Detener la ejecución si no existe el estudiante
}
if (empty($asignatura_ids)) {
    echo "<script>alert('Por favor, seleccione al menos una asignatura.'); window.history.back();</script>";
    exit; // Detener la ejecución si no hay asignaturas seleccionadas
}

// Comenzar la transacción
mysqli_begin_transaction($conexion);

try {
    // Insertar la asociación en la tabla intermedia para cada asignatura seleccionada
    foreach ($asignatura_ids as $asignatura_id) {
        $asignatura_id = mysqli_real_escape_string($conexion, $asignatura_id);
        
        // Verificar si la asignatura existe
        $checkAsignaturaQuery = "SELECT id FROM asignaturas WHERE id = '$asignatura_id'";
        $asignaturaResult = mysqli_query($conexion, $checkAsignaturaQuery);

        if (mysqli_num_rows($asignaturaResult) == 0) {
            throw new Exception('Una o más asignaturas no existen.');
        }

        // Insertar la asociación
        $query = "INSERT INTO estudiante_asignatura (estudiante_id, asignatura_id) VALUES ('$estudiante_id', '$asignatura_id')";
        if (!mysqli_query($conexion, $query)) {
            throw new Exception('Error al asociar: ' . mysqli_error($conexion));
        }
    }

    // Confirmar la transacción
    mysqli_commit($conexion);
    echo "<script>alert('Asociación guardada correctamente'); window.location.href='../../asociar_estudiante_asignatura.php';</script>";
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    mysqli_rollback($conexion);
    echo "<script>alert('Error: " . $e->getMessage() . "'); window.history.back();</script>";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
