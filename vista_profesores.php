<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "academia");

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Consulta
$query = "SELECT * FROM profesores";
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
    die("Error al recuperar los registros de la tabla profesores: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Profesores</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'logs/header.php'; ?>

    <div class="container"
        style="margin-top: 30px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <h1 align="center">Registro de Profesores</h1>

        <?php
        if (mysqli_num_rows($resultado) > 0) {
            echo '<table class="table table-bordered">';
            echo '<thead class="thead-light">';
            echo '<tr>';
            echo '<th>Nombre</th>';
            echo '<th>Email</th>';
            echo '<th>DNI</th>';
            echo '<th>Asignatura</th>';
            echo '<th>Teléfono</th>';
            echo '<th>Acciones</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($fila['nombre']) . '</td>';
                echo '<td>' . htmlspecialchars($fila['email']) . '</td>';
                echo '<td>' . htmlspecialchars($fila['dni']) . '</td>';
                echo '<td>' . htmlspecialchars($fila['asignatura']) . '</td>';
                echo '<td>' . htmlspecialchars($fila['telefono']) . '</td>';
                echo '<td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" 
                                data-id="' . htmlspecialchars($fila['id']) . '" 
                                data-nombre="' . htmlspecialchars($fila['nombre']) . '" 
                                data-email="' . htmlspecialchars($fila['email']) . '" 
                                data-dni="' . htmlspecialchars($fila['dni']) . '" 
                                data-asignatura="' . htmlspecialchars($fila['asignatura']) . '" 
                                data-telefono="' . htmlspecialchars($fila['telefono']) . '">Editar</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" 
                                data-identificacion="' . htmlspecialchars($fila['id']) . '">Eliminar</button>
                      </td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-warning" role="alert">No se encontraron registros.</div>';
        }
        mysqli_close($conexion);
        ?>
    </div>

    <!-- Modal para Editar -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Profesor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="./operacionesPHP/actualizarProfesor.php">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="form-group">
                            <label for="edit-nombre">Nombre del Profesor</label>
                            <input type="text" class="form-control" name="nombre" id="edit-nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email:</label>
                            <input type="email" class="form-control" name="email" id="edit-email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-dni">DNI:</label>
                            <input type="text" class="form-control" name="dni" id="edit-dni" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-asignatura">Asignatura:</label>
                            <input type="text" class="form-control" name="asignatura" id="edit-asignatura" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-telefono">Teléfono:</label>
                            <input type="text" class="form-control" name="telefono" id="edit-telefono" required>
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
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Profesor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este profesor?</p>
                    <form id="deleteForm" method="POST" action="./operacionesPHP/eliminarProfesor.php">
                        <input type="hidden" name="id" id="delete-id">
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
            var id = button.data('id');
            var nombre = button.data('nombre');
            var email = button.data('email');
            var dni = button.data('dni');
            var asignatura = button.data('asignatura');
            var telefono = button.data('telefono');

            var modal = $(this);
            modal.find('#edit-id').val(id);
            modal.find('#edit-nombre').val(nombre);
            modal.find('#edit-email').val(email);
            modal.find('#edit-dni').val(dni);
            modal.find('#edit-asignatura').val(asignatura);
            modal.find('#edit-telefono').val(telefono);
        });

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var id = button.data('identificacion');

            var modal = $(this);
            modal.find('#delete-id').val(id);
        });
    </script>
</body>
</html>
