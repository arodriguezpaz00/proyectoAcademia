<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "academia", "3306");

// Verificar conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Obtener los datos del formulario
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$asunto = mysqli_real_escape_string($conexion, $_POST['asunto']);
$mensaje = mysqli_real_escape_string($conexion, $_POST['mensaje']);

// Insertar el mensaje en la base de datos
$sql = "INSERT INTO mensajes (nombre, asunto, mensaje) VALUES ('$nombre', '$asunto', '$mensaje')";

if (mysqli_query($conexion, $sql)) {
    echo "Mensaje enviado con éxito.";
} else {
    echo "Error al enviar el mensaje: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
