<?php

//1- Conexion BBDD
$conexion = mysqli_connect("localhost", "root", "", "academia", "3306");

//2- Verificar Conexion OK
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

//3- Query
$sql = "SELECT nombre, identificacion, calificacion FROM notas";
$resultado = mysqli_query($conexion, $sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Notas</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body style="background-color: #f4f4f4;">

<?php include 'logs/header.php'; ?>

<div class="container" style="margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
    <h1>Registro de Notas</h1>

    <?php
    // Verificar si hay resultados
    if (mysqli_num_rows($resultado) > 0) {
        // Crear la tabla para mostrar los registros
        echo '<table class="table table-bordered">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th>Nombre:</th>';
        echo '<th>Identificación</th>';
        echo '<th>Calificación</th>';
        echo '<th>Acciones</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Iterar sobre cada registro y crear una fila en la tabla
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($fila['nombre']) . '</td>';
            echo '<td>' . htmlspecialchars($fila['identificacion']) . '</td>';
            echo '<td>' . htmlspecialchars($fila['calificacion']) . '</td>';
            echo '<td>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" 
                            data-identificacion="' . htmlspecialchars($fila['identificacion']) . '" 
                            data-nombre="' . htmlspecialchars($fila['nombre']) . '" 
                            data-calificacion="' . htmlspecialchars($fila['calificacion']) . '">Editar</button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" 
                            data-identificacion="' . htmlspecialchars($fila['identificacion']) . '">Eliminar</button>
                  </td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<div class="alert alert-warning" role="alert">No se encontraron registros.</div>';
    }

    // Cerrar la conexión
    mysqli_close($conexion);
    ?>
</div>

<!-- Modal para Editar -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Nota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm" method="POST" action="./operacionesPHP/actualizarNota.php">
          <input type="hidden" name="identificacion" id="edit-identificacion">
          <div class="form-group">
            <label for="edit-nombre">Nombre del Estudiante</label>
            <input type="text" class="form-control" name="nombre" id="edit-nombre" required>
          </div>
          <div class="form-group">
            <label for="edit-calificacion">Calificación</label>
            <input type="text" class="form-control" name="calificacion" id="edit-calificacion" required>
          </div>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Eliminar -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Eliminar Nota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Estás seguro de que deseas eliminar esta nota?</p>
        <form id="deleteForm" method="POST" action="./operacionesPHP/eliminarNota.php">
          <input type="hidden" name="identificacion" id="delete-identificacion">
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'logs/footer.php'; ?>

<!-- Enlace a Bootstrap JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var identificacion = button.data('identificacion');
        var nombre = button.data('nombre');
        var calificacion = button.data('calificacion');

        var modal = $(this);
        modal.find('#edit-identificacion').val(identificacion);
        modal.find('#edit-nombre').val(nombre);
        modal.find('#edit-calificacion').val(calificacion);
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var identificacion = button.data('identificacion');

        var modal = $(this);
        modal.find('#delete-identificacion').val(identificacion);
    });
</script>


</body>
</html>
