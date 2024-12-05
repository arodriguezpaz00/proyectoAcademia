<?php
// Mostrar todos los errores y advertencias
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "academia");

if (!$conexion) {
    echo json_encode(['error' => 'Error en la conexión a la base de datos']);
    exit;
}

// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);
$studentId = $data['studentId'] ?? null;
$notas = $data['notas'] ?? [];
$asignaturaIds = $data['asignaturaIds'] ?? []; // Obtener IDs de asignaturas

// Validar datos
if (!$studentId || empty($notas) || empty($asignaturaIds)) {
    echo json_encode(['error' => 'ID de estudiante, notas o asignaturas no proporcionadas']);
    exit;
}

// Calcular el promedio
$sumaNotas = array_sum($notas);
$cantidadNotas = count($notas);
$promedio = ($cantidadNotas > 0) ? $sumaNotas / $cantidadNotas : 0;

// Actualizar el promedio en la tabla de estudiantes
$query = "UPDATE estudiantes SET promedio = ? WHERE id = ?";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "di", $promedio, $studentId);

if (mysqli_stmt_execute($stmt)) {
    // Actualizar notas en la tabla estudiante_asignatura
    foreach ($notas as $index => $nota) {
        $asignaturaId = $asignaturaIds[$index] ?? null; // Obtener el ID de asignatura correspondiente
        if ($asignaturaId) {
            $queryNota = "UPDATE estudiante_asignatura SET nota = ? WHERE estudiante_id = ? AND asignatura_id = ?";
            $stmtNota = mysqli_prepare($conexion, $queryNota);
            mysqli_stmt_bind_param($stmtNota, "iii", $nota, $studentId, $asignaturaId);
            if (!mysqli_stmt_execute($stmtNota)) {
                echo json_encode(['error' => 'Error al actualizar la nota de la asignatura ' . $asignaturaId]);
                exit;
            }
        }
    }

    echo json_encode(['success' => true, 'promedio' => $promedio]); // Devolver el promedio actualizado
} else {
    echo json_encode(['error' => 'Error al guardar el promedio']);
}

mysqli_close($conexion);
?>
