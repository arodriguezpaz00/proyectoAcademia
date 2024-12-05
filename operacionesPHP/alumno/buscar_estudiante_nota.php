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

// Obtener el ID del estudiante desde el parámetro de consulta
$studentId = $_GET['id'] ?? null;

if (!$studentId) {
    echo json_encode(['error' => 'ID de estudiante no proporcionado']);
    exit;
}

// Preparar respuesta
$response = [];

// Consulta para buscar el estudiante por su ID
$query = "SELECT * FROM estudiantes WHERE id = ?";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "i", $studentId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $response['estudiante'] = [
        'nombre' => $row['nombre'],
        'email' => $row['email'],
        'dni' => $row['dni'],
        'telefono' => $row['telefono']
    ];

    // Consulta para obtener las asignaturas
    $queryAsignaturas = "SELECT asignaturas.id, asignaturas.nombre, asignaturas.horas, estudiante_asignatura.nota 
FROM asignaturas
JOIN estudiante_asignatura ON asignaturas.id = estudiante_asignatura.asignatura_id
WHERE estudiante_asignatura.estudiante_id = ?";
    $stmtAsignaturas = mysqli_prepare($conexion, $queryAsignaturas);
    mysqli_stmt_bind_param($stmtAsignaturas, "i", $studentId);
    mysqli_stmt_execute($stmtAsignaturas);
    $resultAsignaturas = mysqli_stmt_get_result($stmtAsignaturas);

    $asignaturas = [];
    while ($asignatura = mysqli_fetch_assoc($resultAsignaturas)) {
        $asignaturas[] = [
            'id' => $asignatura['id'],
            'nombre' => $asignatura['nombre'],
            'horas' => $asignatura['horas'],
            'nota' => $asignatura['nota'] ?? 0 // Asegúrate de que esta columna existe
        ];
    }
    $response['asignaturas'] = $asignaturas;
} else {
    $response['error'] = "No se encontró ningún estudiante con ese ID.";
}

mysqli_close($conexion);

// Envía la respuesta como JSON
echo json_encode($response);
