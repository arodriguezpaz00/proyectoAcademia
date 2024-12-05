<?php 

// Conexión a la bbdd
$conexion = mysqli_connect("localhost", "root", "", "academia", "3306");

// Verificar
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Preparar los valores de entrada de manera segura

$identificacion = mysqli_real_escape_string($conexion, $_REQUEST['identificacion']);


// QUERY
$sql = "DELETE FROM notas WHERE identificacion LIKE $identificacion";

// Ejecutar la consulta y verificar

if (mysqli_query($conexion, $sql)) {
    echo "<script>alert('Registro eliminado correctamente'); window.location.href='../vista_notas_prueba.php';</script>";
} else {
    echo "<script>alert('Error al agregar registro: " . mysqli_error($conexion) . "'); window.history.back();</script>";
}
// Cerrar la conexión
mysqli_close($conexion);

?>