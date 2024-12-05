<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "academia", "3306");

// Verificar si la conexión es exitosa
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Recibir datos del formulario
$identificacion = mysqli_real_escape_string($conexion, $_POST['identificacion']);
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$calificacion = mysqli_real_escape_string($conexion, $_POST['calificacion']);

// Consulta para actualizar la nota
$sql = "UPDATE notas SET nombre='$nombre', calificacion='$calificacion' WHERE identificacion='$identificacion'";

if (mysqli_query($conexion, $sql)) {
    echo "<script>alert('Nota actualizada correctamente'); window.location.href='../vista_notas_prueba.php';</script>";
} else {
    echo "<script>alert('Error al actualizar la nota: " . mysqli_error($conexion) . "'); window.history.back();</script>";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
