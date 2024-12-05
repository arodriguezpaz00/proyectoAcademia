<?php include 'logs/header.php' ?>

<!-- Incluyendo Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<main>
<div class="container" style="width: 80%; margin-top:25px; margin: auto; padding: 20px; background: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
    <h3 style="text-align: center; color: #003366; padding-bottom: 20px;">Registro de Profesores</h3>
    
    <form action="operacionesPHP/guardar_profesor.php" method="POST" style="margin-top: 20px;">
        <div class="input-group" style="margin-bottom: 15px; padding: 10px;">
            <label for="nombre" style="display: block; margin-bottom: 5px; font-weight: bold;">
                <i class="fas fa-user" style="margin-right: 8px;"></i>
                Nombre Completo:
            </label>
            <input type="text" name="nombre" required style="width: 100%; padding: 15px; border: 1px solid #007BFF; border-radius: 5px; transition: border-color 0.3s;">
        </div>

        <div class="input-group" style="margin-bottom: 15px; padding: 10px;">
            <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">
                <i class="fas fa-envelope" style="margin-right: 8px;"></i>
                Correo Electrónico:
            </label>
            <input type="email" name="email" required style="width: 100%; padding: 15px; border: 1px solid #007BFF; border-radius: 5px; transition: border-color 0.3s;">
        </div>

        <div class="input-group" style="margin-bottom: 15px; padding: 10px;">
            <label for="dni" style="display: block; margin-bottom: 5px; font-weight: bold;">
                <i class="fas fa-id-card" style="margin-right: 8px;"></i>
                DNI:
            </label>
            <input type="text" name="dni" required style="width: 100%; padding: 15px; border: 1px solid #007BFF; border-radius: 5px; transition: border-color 0.3s;">
        </div>

        <div class="input-group" style="margin-bottom: 15px; padding: 10px;">
            <label for="asignatura" style="display: block; margin-bottom: 5px; font-weight: bold;">
                <i class="fas fa-book" style="margin-right: 8px;"></i>
                Materia a Dar:
            </label>
            <select name="asignatura" required style="width: 100%; padding: 15px; border: 1px solid #007BFF; border-radius: 5px; transition: border-color 0.3s;color:black">
                <option value="">Seleccione una asignatura</option>
                <?php
                // Conexión a la base de datos
                $conexion = mysqli_connect("localhost", "root", "", "academia", "3306");
                
                // Verificar si la conexión es exitosa
                if (!$conexion) {
                    die("Error en la conexión: " . mysqli_connect_error());
                }

                // Consulta para obtener las asignaturas de la tabla notas
                $sql = "SELECT DISTINCT nombre FROM asignaturas";
                $resultado = mysqli_query($conexion, $sql);

                // Verificar si hay resultados
                if (mysqli_num_rows($resultado) > 0) {
                    // Iterar sobre cada asignatura y crear una opción en el select
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . htmlspecialchars($fila['nombre']) . '">' . htmlspecialchars($fila['nombre']) . '</option>';
                    }
                } else {
                    echo '<option value="">No hay asignaturas disponibles</option>';
                }

                // Cerrar la conexión
                mysqli_close($conexion);
                ?>
            </select>
        </div>

        <div class="input-group" style="margin-bottom: 15px; padding: 10px;">
            <label for="telefono" style="display: block; margin-bottom: 5px; font-weight: bold;">
                <i class="fas fa-phone" style="margin-right: 8px;"></i>
                Teléfono:
            </label>
            <input type="tel" name="telefono" required style="width: 100%; padding: 15px; border: 1px solid #007BFF; border-radius: 5px; transition: border-color 0.3s;">
        </div>

        <button type="submit" class="btn" style="background: #007BFF; color: #fff; padding: 12px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background 0.3s; font-size: 16px;">
            <i class="fas fa-user-plus" style="margin-right: 8px;"></i>
            Registrar Profesor
        </button>
    </form>
</div>
</main>

<?php include 'logs/footer.php' ?>
