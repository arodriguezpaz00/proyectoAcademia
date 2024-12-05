<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "academia", "3306");

// Verificar si la conexión es exitosa
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Verificar si se recibieron datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $horas = (int) $_POST['horas']; // Asegúrate de que sea un entero

    // Consulta para insertar la nueva asignatura
    $sql = "INSERT INTO asignaturas (nombre, horas) VALUES ('$nombre', '$horas')";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('Asignatura registrada correctamente'); window.location.href='../../registro_asignatura.php';</script>";
    } else {
        echo "<script>alert('Error al registrar la asignatura: " . mysqli_error($conexion) . "'); window.history.back();</script>";
    }
}

// Cerrar la conexión
mysqli_close($conexion);
?>
