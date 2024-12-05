<?php include 'logs/header.php'?>

<script>
function calcularNotaFinal() {
    const notas = document.querySelectorAll(".nota");
    let suma = 0;
    let totalModulos = 0;
    
    notas.forEach(nota => {
        const valor = parseFloat(nota.value);
        if (!isNaN(valor)) {
            suma += valor;
            totalModulos++;
        }
    });

    const promedio = totalModulos > 0 ? (suma / totalModulos).toFixed(2) : 0;
    document.getElementById("promedio").innerText = parseInt(promedio);
    
    calcularEstado(promedio);
}

function calcularEstado(promedio) {
    const resultado = document.getElementById("estado");
    
    if (promedio >= 5) {
        resultado.style.color = "green";
        resultado.innerText = "Aprobado";
    } else {
        resultado.style.color = "red";
        resultado.innerText = "Suspenso";
    }
}
</script>

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

<br>

<div class="container" style="border: 2px solid #333; border-radius: 8px; padding: 20px; margin-bottom: 50px;" >
    <table class="table table-responsive table-bordered table-secondary" style="width: 100%; margin-bottom: 20px;">
        <thead class="table-dark">
            <tr>
                <th scope="col" style="text-align: center;">MÓDULOS</th>
                <th scope="col" style="text-align: center;">HORAS</th>
                <th scope="col" style="text-align: center;">NOTA FINAL</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-primary">
                <td style="text-align: center;">MF0950_2: Construcción de páginas web</td>
                <td style="text-align: center;">210 horas</td>
                <td style="text-align: center;">
                    <input type="number" class="nota form-control" placeholder="Ingrese nota" min="0" max="10" style="width: 80%; margin: 0 auto;">
                </td>
            </tr>
            <tr class="table-primary">
                <td style="text-align: center;">MF0951_2: Programación de lenguajes de guiones</td>
                <td style="text-align: center;">90 horas</td>
                <td style="text-align: center;">
                    <input type="number" class="nota form-control" placeholder="Ingrese nota" min="0" max="10" style="width: 80%; margin: 0 auto;">
                </td>
            </tr>
        </tbody>
    </table>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
        <h5 style="margin: 0;">Nota Promedio: <span id="promedio" style="font-size: 1.2em; color: #555;">

        </span></h5>
        <h5 style="margin: 0;">Estado: <span id="estado" style="font-size: 1.2em; color: #555;"></span></h5>
        <button type="button" class="btn btn-primary" style="font-size: 1em; padding: 10px 20px;" onclick="calcularNotaFinal()">Calcular Nota Final</button>
    </div>
</div>

<?php include 'logs/footer.php'?>
