<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "academia", "3306");

// Verificar si la conexión es exitosa
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Recibir datos del formulario
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$email = mysqli_real_escape_string($conexion, $_POST['email']);
$dni = mysqli_real_escape_string($conexion, $_POST['dni']);
$asignatura = mysqli_real_escape_string($conexion, $_POST['asignatura']);
$telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);

// Consulta para insertar el nuevo profesor
$sql = "INSERT INTO profesores (nombre, email, dni, asignatura, telefono) VALUES ('$nombre', '$email', '$dni', '$asignatura', '$telefono')";

if (mysqli_query($conexion, $sql)) {
    echo "<script>alert('Registro agregado correctamente'); window.location.href='../registro_profe.php';</script>";
} else {
    echo "<script>alert('Error al agregar registro: " . mysqli_error($conexion) . "'); window.history.back();</script>";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
