<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Notas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'logs/header.php' ?>
    <div class="container" style="margin-top: 50px;">
        <h1>Consulta de Notas</h1>
        <!-- Input de búsqueda -->
        <div class="mb-4 text-end">
            <label for="studentIdInput" class="form-label">Número Identificador:</label>
            <input type="number" class="form-control d-inline-block" id="studentIdInput" style="width: 200px;" required />
            <button type="button" class="btn btn-primary ms-2" onclick="fetchStudentData()">Consultar</button>
        </div>

        <!-- Tabla de datos del estudiante -->
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="studentTable" style="display: none;">
                <thead class="table-dark text-center">
                    <tr>
                        <th>MÓDULOS</th>
                        <th>HORA MÓDULOS</th>
                        <th>NOTA FINAL</th>
                    </tr>
                </thead>
                <tbody id="studentDataBody">
                    <!-- Aquí se insertarán las asignaturas y notas del estudiante -->
                </tbody>
            </table>
        </div>

        <!-- Promedio y botón para calcular y guardar -->
        <div id="promedioContainer" style="display: none;">
            <h5>Nota Promedio: <span id="promedio"></span> <span id="estatus" style="font-weight: bold;"></span></h5>
            <button type="button" class="btn btn-primary" onclick="calcularPromedio()">Calcular Promedio</button>
            <button type="button" class="btn btn-success" onclick="guardarPromedio()">Guardar Promedio</button>
        </div>
    </div>

    <!-- JavaScript para manejar la consulta y el cálculo del promedio -->
    <script>
        function fetchStudentData() {
            const studentId = document.getElementById('studentIdInput').value;
            if (!studentId) {
                alert("Por favor, ingrese un número identificador válido.");
                return;
            }

            fetch(`./operacionesPHP/alumno/buscar_estudiante_nota.php?id=${studentId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const tableBody = document.getElementById('studentDataBody');
                    tableBody.innerHTML = ""; // Limpiar tabla

                    if (data.error) {
                        alert(data.error);
                        document.getElementById('studentTable').style.display = 'none'; // Ocultar tabla si hay error
                    } else {
                        // Verificar si hay asignaturas
                        if (data.asignaturas.length === 0) {
                            alert("No se encontraron asignaturas para este estudiante.");
                            document.getElementById('studentTable').style.display = 'none'; // Ocultar tabla si no hay asignaturas
                            return;
                        }

                        // Llenar la tabla con asignaturas
                        data.asignaturas.forEach(asignatura => {
                            const row = `
                                <tr data-asignatura-id="${asignatura.id}">
                                    <td>${asignatura.nombre}</td>
                                    <td>${asignatura.horas} horas</td>
                                    <td><input type='number' class='nota form-control' value='${asignatura.nota}' /></td>
                                </tr>`;
                            tableBody.insertAdjacentHTML('beforeend', row);
                        });

                        // Mostrar la tabla de resultados
                        document.getElementById('studentTable').style.display = 'table';
                        document.getElementById("promedioContainer").style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Error al buscar el estudiante. Por favor, intente de nuevo.");
                });
        }

        function calcularPromedio() {
            const notas = Array.from(document.querySelectorAll('.nota')).map(input => Number(input.value));
            const sumaNotas = notas.reduce((a, b) => a + b, 0);
            const cantidadNotas = notas.length;
            const promedio = (cantidadNotas > 0) ? sumaNotas / cantidadNotas : 0;

            document.getElementById('promedio').innerText = promedio.toFixed(2);
            const estatus = promedio >= 5 ? "Aprobado" : "Reprobado";
            document.getElementById('estatus').innerText = estatus;
            document.getElementById('estatus').style.color = promedio >= 5 ? 'green' : 'red';
        }

        function guardarPromedio() {
            const studentId = document.getElementById('studentIdInput').value;
            const notas = Array.from(document.querySelectorAll('.nota')).map(input => Number(input.value));
            const asignaturaIds = Array.from(document.querySelectorAll('tr[data-asignatura-id]')).map(row => row.getAttribute('data-asignatura-id'));
            
            console.log('Notas:', notas);
            console.log('Asignatura IDs:', asignaturaIds);

            if (asignaturaIds.length === 0) {
                alert("No se encontraron asignaturas para guardar.");
                return;
            }

            fetch('./operacionesPHP/alumno/guardar_promedio.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    studentId: studentId,
                    notas: notas,
                    asignaturaIds: asignaturaIds // Asegúrate de enviar los IDs de las asignaturas
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Promedio guardado correctamente. Promedio: ' + data.promedio);
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error al guardar el promedio. Intente de nuevo.");
            });
        }
    </script>

    <?php include 'logs/footer.php' ?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
