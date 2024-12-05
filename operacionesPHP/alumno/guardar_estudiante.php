<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "academia");

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Validación y obtención de datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $dni = mysqli_real_escape_string($conexion, $_POST['dni']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);

    // Consulta para insertar el nuevo estudiante
    $sql = "INSERT INTO estudiantes (nombre, dni, email, telefono) 
            VALUES ('$nombre', '$dni', '$email', '$telefono')";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('Estudiante agregado correctamente'); window.location.href='../registro_estudiantes.php';</script>";
    } else {
        echo "<script>alert('Error al agregar el estudiante: " . mysqli_error($conexion) . "'); window.history.back();</script>";
    }

    mysqli_close($conexion);
}
?>
