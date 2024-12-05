<?php 

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "academia", "3306");

// Verificar conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Preparar los valores de entrada de manera segura
$estudiante_id = mysqli_real_escape_string($conexion, $_POST['estudiante_id']);

// Consulta para eliminar al estudiante
$sql = "DELETE FROM estudiantes WHERE id = '$estudiante_id'";

// Ejecutar la consulta y verificar
if (mysqli_query($conexion, $sql)) {
    echo "<script>alert('Registro eliminado correctamente'); window.location.href='../../vista_alumnos.php';</script>";
} else {
    echo "<script>alert('Error al eliminar el registro: " . mysqli_error($conexion) . "'); window.history.back();</script>";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
