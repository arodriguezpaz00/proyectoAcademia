<?php
    // Conexión a la bbdd
    $conexion = mysqli_connect("localhost", "root", "", "academia", "3306");

    // Verificar
    if (!$conexion) {
        die("Error en la conexión: " . mysqli_connect_error());
    }

    // Preparar los valores de entrada de manera segura
    $nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombre']);
    $identificacion = mysqli_real_escape_string($conexion, $_REQUEST['identificacion']);
    $calificacion = mysqli_real_escape_string($conexion, $_REQUEST['calificacion']);

    // QUERY
    $sql = "INSERT INTO notas (nombre, identificacion, calificacion) VALUES ('$nombre', '$identificacion', '$calificacion')";

    // Ejecutar la consulta y verificar
    if (mysqli_query($conexion, $sql)) {
        echo "Registro agregado correctamente";
    } else {
        echo "Error al agregar registro: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
?>
