<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Administración</title>

    <!-- Enlace a Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

   
    <style>
        :root {
            --blue: #3b82f6;
            --green: #22c55e;
            --purple: #8b5cf6;
            --red: #ef4444;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-700: #374151;
            --gray-900: #111827;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--gray-100);
            color: var(--gray-900);
            line-height: 1.5;
        }
        .header {
            background-color: white;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            padding: 1rem;
        }
        .header h1 {
            max-width: 80rem;
            margin: 0 auto;
            font-size: 1.875rem;
            font-weight: bold;
            color: var(--gray-900);
        }
        .container {
            max-width: 80rem;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .dashboard-layout {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        .clock-container {
            order: -1;
        }
        @media (min-width: 1024px) {
            .dashboard-layout {
                flex-direction: row;
            }
            .dashboard-grid {
                flex: 3;
            }
            .clock-container {
                flex: 1;
                order: 0;
            }
        }
        .dashboard-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            border-radius: 0.5rem;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .dashboard-item:hover {
            opacity: 0.9;
        }
        .dashboard-item-icon {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            padding: 1rem;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        .dashboard-item-title {
            font-size: 1.125rem;
            font-weight: 600;
            text-align: center;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .modal h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .modal-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 1rem;
        }
        .modal-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: bold;
            color: white;
            cursor: pointer;
            transition: opacity 0.3s;
        }
        .modal-button.add {
            background-color: var(--blue);
        }
        .modal-button.view {
            background-color: var(--green);
        }
        .modal-button.edit {
    background-color: var(--purple);
}
        .modal-close {
            margin-top: 1rem;
            color: var(--gray-700);
            cursor: pointer;
        }
        .clock {
            background-color: #1e293b;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .clock .time {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 4px;
        }
        .clock .date {
            font-size: 0.875rem;
            color: #e2e8f0;
        }
        .welcome-message {
            margin-top: 10px;
            background-color: #1e293b;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 0.875rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
   
    <?php include 'logs/header.php' ?>
    <header class="header">
        <h1>Dashboard de Administración</h1>
    </header>
    <main class="container">
        <div class="dashboard-layout">
            <div class="dashboard-grid" id="dashboardGrid"></div>
            <div class="clock-container">
                <div class="clock">
                    <div class="time" id="time">00:00</div>
                    <div class="date" id="date">Lunes, Enero 1</div>
                </div>
                <div class="welcome-message">
                    ¡Bienvenido al Dashboard de Administracion!
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Template -->
<div class="modal" id="modal">
    <div class="modal-content">
        <h2 id="modalTitle">Título del Modal</h2>
        <div class="modal-buttons">
            <button class="modal-button add" id="addButton">
                <i class="fas fa-plus"></i> Añadir
            </button>
            <button class="modal-button edit" id="editButton">
                <i class="fas fa-edit"></i> Editar
            </button>
        </div>
        <div class="modal-close" onclick="closeModal()">Cerrar</div>
    </div>
</div>


    <script>
        const dashboardItems = [
    {
        title: "Acciones para Profesores",
        iconClass: "fas fa-chalkboard-teacher",
        color: "var(--blue)",
        addLink: "registro_profe.php",
        editLink: "vista_profesores.php",
    },
    {
        title: "Acciones para Alumnos",
        iconClass: "fas fa-user-graduate",
        color: "var(--green)",
        addLink: "registro_estudiante.php",
        editLink: "vista_alumnos.php"        
    },
    {
        title: "Acciones para Asignaturas",
        iconClass: "fas fa-book",
        color: "var(--purple)",
        addLink: "registro_asignatura.php",
        editLink: "editar_asignatura.php"
    },
    {
        title: "Acciones para Notas",
        iconClass: "fas fa-clipboard-list",
        color: "var(--red)",
        addLink: "añadir_nota.php",
        editLink: "editar_nota.php",
        deleteLink: "eliminar_nota.php"
    }
];

const dashboardGrid = document.getElementById('dashboardGrid');
const modal = document.getElementById('modal');
const modalTitle = document.getElementById('modalTitle');
const addButton = document.getElementById('addButton');
const editButton = document.getElementById('editButton');

// Función para abrir el modal y configurar los botones
function openModal(item) {
    modalTitle.textContent = item.title;
    addButton.onclick = () => window.location.href = item.addLink;
    editButton.onclick = () => window.location.href = item.editLink;
    modal.style.display = "flex";
}

// Cerrar el modal
function closeModal() {
    modal.style.display = "none";
}

// Crear los elementos del dashboard
dashboardItems.forEach(item => {
    const dashboardItem = document.createElement('a');
    dashboardItem.className = 'dashboard-item';
    dashboardItem.style.backgroundColor = item.color;

    dashboardItem.innerHTML = `
        <div class="dashboard-item-icon"><i class="${item.iconClass}"></i></div>
        <h2 class="dashboard-item-title">${item.title}</h2>
    `;

    dashboardItem.addEventListener('click', function(event) {
        event.preventDefault();
        openModal(item);
    });

    dashboardGrid.appendChild(dashboardItem);
});


        function updateClock() {
            const now = new Date();
            const timeElement = document.getElementById('time');
            const dateElement = document.getElementById('date');

            // Update time
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            timeElement.textContent = `${hours}:${minutes}`;

            // Update date
            const options = { weekday: 'long', month: 'long', day: 'numeric' };
            const dateString = now.toLocaleDateString('es-ES', options);
            dateElement.textContent = dateString;
        }

        // Update the clock immediately and then every second
        updateClock();
        setInterval(updateClock, 1000);
    </script>

    <?php include 'logs/footer.php'?>
</body>
</html>