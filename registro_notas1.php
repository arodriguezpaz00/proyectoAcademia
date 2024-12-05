<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'logs/header.php'?>

<!-- Botones principales -->
<div class="container" style="margin-top: 50px; display: flex; justify-content: center; gap: 20px;">
  <button type="button" class="btn btn-primary" style="display: flex; align-items: center; gap: 5px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
      <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31z"/>
    </svg> IFCD0110
  </button>

  <button type="button" class="btn btn-primary" style="display: flex; align-items: center; gap: 5px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
      <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31z"/>
    </svg> IFCD0198
  </button>

  <button type="button" class="btn btn-primary" style="display: flex; align-items: center; gap: 5px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
      <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31z"/>
    </svg> IFCD0177
  </button>
</div>

<!-- Tabla de Módulos -->
<div class="container" style="border: 2px solid #007bff; border-radius: 10px; padding: 20px; margin-top: 30px;">
  <table class="table table-hover table-striped" style="text-align: center;">
    <thead class="table-dark">
      <tr>
        <th scope="col">MÓDULOS</th>
        <th scope="col">HORA MÓDULOS</th>
        <th scope="col">NOTA FINAL</th>
      </tr>
    </thead>
    <tbody>
      <tr class="table-primary">
        <td scope="row">MF0950_2: Construcción de páginas web</td>
        <td>210 horas</td>
        <td id="demo1"></td>
      </tr>
      <!-- Añadir filas adicionales -->
    </tbody>
  </table>
  <div class="d-flex justify-content-between align-items-center mt-3">
    <h5>Nota Promedio: <h3 id="demo" style="display: inline-block;"></h3></h5>
    <button type="button" class="btn btn-primary" onclick="nota()">Calcular Nota</button>
  </div>
</div>

<!-- Formulario de Registro de Estudiantes -->
<form action="connect.php" method="post">
  <div class="container" style="border: 2px solid #007bff; border-radius: 10px; padding: 20px; margin-top: 30px;">
    <div class="mb-3">
      <label for="" class="form-label"><b>Nombre del Estudiante</b></label>
      <input type="text" class="form-control" style="width: 100%; background-color: #f0f0f5;" />
    </div>
    <!-- Campos adicionales del formulario -->
    <div class="d-flex justify-content-end gap-3">
      <button type="submit" class="btn btn-primary">REGISTRAR</button>
      <button type="reset" class="btn btn-danger">BORRAR</button>
    </div>
  </div>
</form>

<!-- <form action="connect.php" method="post">
  <div class="container" style="border: 2px solid #007bff; border-radius: 10px; padding: 20px; margin-top: 30px;">
    
    <div class="mb-3">
      <label for="nombre" class="form-label"><b>Nombre: </b></label>
      <input type="text" name="nombre" class="form-control" style="width: 100%; background-color: #f0f0f5;" required />
    </div>
    
    <div class="mb-3">
      <label for="identificacion" class="form-label"><b>Identificación</b></label>
      <input type="text" name="identificacion" class="form-control" style="width: 100%; background-color: #f0f0f5;" required />
    </div>

    <div class="mb-3">
      <label for="calificacion" class="form-label"><b>Calificación</b></label>
      <input type="number" name="calificacion" class="form-control" style="width: 100%; background-color: #f0f0f5;" min="0" max="100" required />
    </div>

    <div class="d-flex justify-content-end gap-3">
      <button type="submit" class="btn btn-primary">REGISTRAR</button>
      <button type="reset" class="btn btn-danger">BORRAR</button>
    </div>
  </div>
</form> -->


<!-- Modal de Consulta de Estudiantes -->
<!-- Botón para abrir el modal de búsqueda -->
<div class="container" style="text-align: right; margin-top: 20px;">
  <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#searchStudentModal">Consultar Estudiantes</button>
</div>

<!-- Modal de búsqueda por ID -->
<div class="modal fade" id="searchStudentModal" tabindex="-1" aria-labelledby="searchStudentLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchStudentLabel">Identificación del Estudiante</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="studentIdInput" class="form-label">Número Identificador:</label>
        <input type="number" class="form-control" id="studentIdInput" required />
        <small class="form-text text-muted">Colocar solo numérico</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="fetchStudentData()">Consultar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para mostrar los datos completos del estudiante -->
<div class="modal fade" id="studentDetailsModal" tabindex="-1" aria-labelledby="studentDetailsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="studentDetailsLabel">Detalles del Estudiante</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="studentDetailsBody">
        <!-- Los detalles del estudiante se cargarán aquí -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php include 'logs/footer.php'?>

<!-- JavaScript para manejar la consulta -->
<script>
  function fetchStudentData() {
    const studentId = document.getElementById('studentIdInput').value;

    if (!studentId) {
      alert("Por favor, ingrese un número identificador válido.");
      return;
    }

    // Realizar la solicitud AJAX para buscar los datos del estudiante
    fetch(`./operacionesPHP/alumno/buscar_estudiante.php?id=${studentId}`)
      .then(response => response.text())
      .then(data => {
        document.getElementById('studentDetailsBody').innerHTML = data;

        // Mostrar el modal de detalles
        const studentDetailsModal = new bootstrap.Modal(document.getElementById('studentDetailsModal'));
        studentDetailsModal.show();
      })
      .catch(error => {
        console.error("Error:", error);
        alert("Error al buscar el estudiante. Por favor, intente de nuevo.");
      });
  }
</script>




<!-- Bootstrap Bundle JS (con Popper.js incluido) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>
</html>
