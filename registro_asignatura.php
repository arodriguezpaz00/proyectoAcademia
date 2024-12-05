<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal de Consulta de Estudiantes</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include 'logs/header.php' ?>

    <div class="container" style=" margin-top: 50px;
            padding: 30px;
            background-color: #ffffff; 
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <h1 class="text-center mb-4">Registrar Asignatura</h1>
        <form method="POST" action="./operacionesPHP/asignatura/guardar_asignatura.php">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Asignatura</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
            <div class="mb-3">
                <label for="horas" class="form-label">Número de Horas</label>
                <input type="number" class="form-control" name="horas" id="horas" required>
            </div>
            <div class="d-flex justify-content-end gap-3">
                <button type="submit" class="btn btn-primary">Registrar</button>
                <button type="reset" class="btn btn-danger">Borrar</button>
            </div>
        </form>
    </div>


    <?php include 'logs/footer.php' ?>

    <!-- Bootstrap Bundle JS (con Popper.js incluido) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>