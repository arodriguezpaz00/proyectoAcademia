<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Alumnos y Asignaturas</title>
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #60a5fa;
            --danger: #ef4444;
            --danger-dark: #dc2626;
            --background: #f1f5f9;
            --surface: #ffffff;
            --text: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--background);
            color: var(--text);
            line-height: 1.5;
        }

        .nombreAlumno {
            text-decoration: none;
            cursor: pointer;
            color: black;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: var(--surface);
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--text);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        th, td {
            padding: 0.75rem;
            border: 1px solid var(--border);
            text-align: left;
        }

        th {
            text-align: center;
            color: black;
        }

        /* Quitar el efecto hover */
        tr:hover {
            background-color: transparent;
        }

        .btn-edit, .btn-delete {
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            margin-right: 0.5rem;
            text-decoration: none;
        }

        .btn-edit {
            background-color: var(--primary);
        }

        .btn-edit:hover {
            background-color: var(--primary-dark);
        }

        .btn-delete {
            background-color: var(--danger);
        }

        .btn-delete:hover {
            background-color: var(--danger-dark);
        }

        .subject-tag {
            display: inline-block;
            background-color: #e5e5e5;
            color: var(--text);
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            margin: 0.25rem;
            font-size: 0.875rem;
        }

        .no-subjects {
            color: var(--text-light);
            font-style: italic;
        }

        /* Estilos del modal */
        .modal {
            display: none; /* Oculto por defecto */
            position: fixed; /* Fijo en la pantalla */
            z-index: 1; /* Encima de otros elementos */
            left: 0;
            top: 0;
            width: 50%; /* Ancho completo */
            height: 50%; /* Alto completo */
            overflow: auto; /* Desplazamiento si es necesario */
            background-color: rgba(0,0,0,0.4); /* Fondo negro con opacidad */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% desde arriba y centrado */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Ancho del modal */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php include 'logs/header.php'; ?>

<div class="container">
    <h2>Lista de Alumnos y Asignaturas</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre del Estudiante</th>
                <th>Asignaturas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexión a la base de datos
            $conexion = mysqli_connect("localhost", "root", "", "academia");
            if (!$conexion) {
                die("Conexión fallida: " . mysqli_connect_error());
            }

            // Consulta para obtener todos los estudiantes y las asignaturas asociadas
            $query = "
                SELECT e.id AS estudiante_id, e.nombre AS estudiante_nombre, 
                       GROUP_CONCAT(a.nombre SEPARATOR ', ') AS asignaturas
                FROM estudiantes e
                LEFT JOIN estudiante_asignatura ea ON e.id = ea.estudiante_id
                LEFT JOIN asignaturas a ON ea.asignatura_id = a.id
                GROUP BY e.id
            ";

            $result = mysqli_query($conexion, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                // Separar las asignaturas en un array
                $subjects = explode(", ", $row['asignaturas']);
                $subjectTags = [];

                if (!empty($row['asignaturas'])) {
                    $subjectTags = array_map(function($subject) {
                        return "<span class='subject-tag'>$subject</span>";
                    }, $subjects);
                }

                $subjectTagsHtml = !empty($subjectTags) ? implode(" ", $subjectTags) : "<span class='no-subjects'>No inscrito en ninguna asignatura</span>";

                echo "<tr>
                        <td class='nombreAlumno'><a href='#' style='text-decoration : none; color:black' onclick='openStudentModal({$row['estudiante_id']})'>{$row['estudiante_nombre']}</a></td>
                        <td>{$subjectTagsHtml}</td>
                        <td>
                            <a href='editar_estudiante.php?id={$row['estudiante_id']}' class='btn-edit'>Editar</a>
                            <form action='borrar_estudiante.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='estudiante_id' value='{$row['estudiante_id']}'>
                                <button type='submit' class='btn-delete'>Borrar</button>
                            </form>
                        </td>
                    </tr>";
            }

            // Cerrar conexión
            mysqli_close($conexion);
            ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="studentModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modal-body">
            <!-- La información del estudiante se cargará aquí -->
        </div>
    </div>
</div>

<script>
    // Función para abrir el modal y cargar información del estudiante
    function openStudentModal(studentId) {
        // Realizar la solicitud AJAX para obtener los datos del estudiante
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `./operacionesPHP/alumno/buscar_estudiante.php?id=${studentId}`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('modal-body').innerHTML = xhr.responseText;
                document.getElementById('studentModal').style.display = "block";
            }
        };
        xhr.send();
    }

    // Función para cerrar el modal
    document.querySelector('.close').onclick = function() {
        document.getElementById('studentModal').style.display = "none";
    }

    // Cerrar el modal si se hace clic fuera del contenido del modal
    window.onclick = function(event) {
        const modal = document.getElementById('studentModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<?php include 'logs/footer.php'; ?>
</body>
</html>
