<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asociar Estudiantes a Asignaturas</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-check {
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'logs/header.php'; ?>

<div class="container">
    <h2 class="mb-4">Asociar Estudiante a Asignaturas</h2>
    
    <!-- Formulario para seleccionar el estudiante -->
    <form method="POST" action="">
        <div class="form-group mb-3">
            <label for="estudiante_id">Seleccionar Estudiante</label>
            <select name="estudiante_id" id="estudiante_id" class="form-control" required>
                <option value="">Seleccione un estudiante</option>
                <!-- Opciones de estudiantes se generan dinámicamente desde la base de datos -->
                <?php
                // Conexión a la base de datos
                $conexion = mysqli_connect("localhost", "root", "", "academia");
                $query = "SELECT id, nombre FROM estudiantes";
                $result = mysqli_query($conexion, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="cargar_asignaturas">Cargar Asignaturas</button>
    </form>

    <!-- Formulario para asociar asignaturas -->
    <?php if (isset($_POST['cargar_asignaturas'])): ?>
        <form method="POST" action="./operacionesPHP/asignatura/asociar_asignatura.php">
            <input type="hidden" name="estudiante_id" value="<?php echo htmlspecialchars($_POST['estudiante_id']); ?>">
            <div class="form-group mb-3">
                <label>Seleccionar Asignaturas</label><br>
                <?php
                // Obtener el ID del estudiante seleccionado
                $estudiante_id = mysqli_real_escape_string($conexion, $_POST['estudiante_id']);

                // Obtener todas las asignaturas y verificar cuáles están asociadas
                $query = "SELECT a.id, a.nombre, 
                          IF(ea.estudiante_id IS NOT NULL, 1, 0) AS is_assigned
                          FROM asignaturas a
                          LEFT JOIN estudiante_asignatura ea ON a.id = ea.asignatura_id AND ea.estudiante_id = '$estudiante_id'";
                $result = mysqli_query($conexion, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $checked = $row['is_assigned'] ? "checked" : "";
                    echo "<div class='form-check'>
                            <input class='form-check-input' type='checkbox' name='asignatura_ids[]' id='asignatura_{$row['id']}' value='{$row['id']}' $checked>
                            <label class='form-check-label' for='asignatura_{$row['id']}'>
                                {$row['nombre']}
                            </label>
                          </div>";
                }
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Asociar</button>
        </form>
    <?php endif; ?>

</div>

<?php include 'logs/footer.php'; ?>
<!-- Bootstrap Bundle JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
