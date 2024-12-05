<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Moderno entre Estudiantes</title>
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-light: #818cf8;
            --background-color: #f3f4f6;
            --card-background: #ffffff;
            --text-color: #1f2937;
            --border-color: #e5e7eb;
            --success-color: #10b981;
            --error-color: #ef4444;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            width: 100%;
            gap: 20px;
        }

        .card {
            background-color: var(--card-background);
            padding: 2rem;
            border-radius: 12px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            font-weight: 600;
        }

        input,
        textarea {
            width: 100%;
            padding: 0.75rem;
            border-radius: 8px;
            border: 2px solid var(--border-color);
        }

        button {
            padding: 0.75rem;
            border-radius: 8px;
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }

        .messages {
            max-height: 400px;
            overflow-y: auto;
            padding: 1rem;
        }

        .message {
            background-color: var(--background-color);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .message-header {
            font-weight: bold;
        }

        #notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 1rem;
            border-radius: 8px;
            color: white;
            font-weight: 600;
        }

        .success {
            background-color: var(--success-color);
        }

        .error {
            background-color: var(--error-color);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h2>Chat de Estudiantes</h2>
            <form id="messageForm">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="asunto">Asunto:</label>
                    <input type="text" id="asunto" name="asunto" required>
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" required></textarea>
                </div>
                <button type="submit">Enviar Mensaje</button>
            </form>
        </div>

        <div class="card messages">
            <div id="messagesContainer">Cargando mensajes...</div>
        </div>
    </div>

    <div id="notification"></div>

    <script>
        function cargarMensajes() {
            fetch('./operacionesPHP/mensajes/cargar_mensajes.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error HTTP: ${response.status}`);
                    }
                    return response.text();
                })
                .then(html => {
                    const messagesContainer = document.getElementById('messagesContainer');
                    messagesContainer.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error al cargar los mensajes:', error);
                    showNotification('Error al cargar los mensajes', 'error');
                });
        }


        document.getElementById('messageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('./operacionesPHP/mensajes/enviar_mensaje.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    showNotification('Mensaje enviado con éxito', 'success');
                    this.reset();
                    cargarMensajes();
                })
                .catch(error => showNotification('Error al enviar el mensaje', 'error'));
        });

        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = type;
            setTimeout(() => {
                notification.textContent = '';
            }, 3000);
        }

        cargarMensajes();
    </script>
</body>

</html>