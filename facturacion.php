<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .invoice-container {
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
            /* Centrar el contenedor */
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }

        .invoice-header p {
            color: #666;
            font-size: 14px;
            margin: 5px 0;
        }

        .invoice-details,
        .invoice-footer {
            margin-top: 20px;
        }

        .invoice-info {
            width: 100%;
        }

        .invoice-details {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .invoice-details th,
        .invoice-details td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .invoice-details th {
            background-color: #333;
            color: #fff;
        }

        .invoice-footer {
            display: flex;
            justify-content: space-between;
        }

        .total-section {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        /* Estilos para el campo de fecha */
        .invoice-info input[type="date"] {
            margin-top: 10px;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* Estilos para el botón de añadir producto */
        .add-product-button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .add-product-button:hover {
            background-color: #4cae4c;
        }
    </style>
    <script>
        // Función para establecer la fecha actual en el input
        function setCurrentDate() {
            const today = new Date();
            const day = String(today.getDate()).padStart(2, '0');
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const year = today.getFullYear();
            const dateString = `${year}-${month}-${day}`;
            document.getElementById('invoiceDate').value = dateString;

            // Usando la primera opción para establecer el ID de factura
            document.getElementById('idFactura').innerHTML = `<strong>Número de factura:</strong> ${generateUUID()}`;
        }

        // Función para añadir un producto a la factura
        function addProduct() {
            const description = prompt("Ingrese la descripción del producto:");
            const quantity = parseInt(prompt("Ingrese la cantidad del producto:"), 10);
            const price = parseFloat(prompt("Ingrese el precio unitario del producto:")).toFixed(2);

            if (description && !isNaN(quantity) && !isNaN(price)) {
                const total = (quantity * price).toFixed(2);
                const table = document.getElementById('invoiceTable').getElementsByTagName('tbody')[0];
                const newRow = table.insertRow();

                newRow.innerHTML = `
                    <td>${description}</td>
                    <td>${quantity}</td>
                    <td>$${price}</td>
                    <td>$${total}</td>
                `;

                updateTotal(); // Actualiza el total al añadir un nuevo producto
            } else {
                alert("Por favor, asegúrese de ingresar datos válidos.");
            }
        }

        // Función para actualizar el total de la factura
        function updateTotal() {
            const table = document.getElementById('invoiceTable').getElementsByTagName('tbody')[0];
            const rows = table.getElementsByTagName('tr');
            let subtotal = 0;

            for (let row of rows) {
                const totalCell = row.cells[3].innerText.replace('$', '');
                subtotal += parseFloat(totalCell);
            }

            const iva = subtotal * 0.21;
            const total = subtotal + iva;

            // Actualiza los valores en la factura
            document.getElementById('subtotal').innerText = `$${subtotal.toFixed(2)}`;
            document.getElementById('iva').innerText = `$${iva.toFixed(2)}`;
            document.getElementById('total').innerText = `$${total.toFixed(2)}`;
        }

        function generateUUID() { // Public Domain/MIT
            var d = new Date().getTime(); //Timestamp
            var d2 = ((typeof performance !== 'undefined') && performance.now && (performance.now() * 1000)) || 0; //Time in microseconds since page-load or 0 if unsupported
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16; //random number between 0 and 16
                if (d > 0) { //Use timestamp until depleted
                    r = (d + r) % 16 | 0;
                    d = Math.floor(d / 16);
                } else { //Use microseconds since page-load if supported
                    r = (d2 + r) % 16 | 0;
                    d2 = Math.floor(d2 / 16);
                }
                return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
            });
        }

        // Ejecutar la función cuando se carga la página
        window.onload = setCurrentDate;
    </script>
</head>

<body>

    <?php include 'logs/header.php'; ?>

    <div class="invoice-container">
        <!-- Encabezado de la factura -->
        <div class="invoice-header">
            <h1>Factura</h1>
        </div>

        <!-- Información del cliente -->
        <div class="invoice-info">
            <p><strong>Fecha:</strong> <input type="date" id="invoiceDate" /></p>
            <p id="idFactura"><strong></strong> </p>
            <p><strong>Cliente:</strong> Juan Pérez</p>
            <p><strong>Dirección:</strong> Calle Castellana 123, Madrid, España</p>
        </div>

        <!-- Tabla de detalles de la factura -->
        <table class="invoice-details" id="invoiceTable">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se agregarán dinámicamente los productos -->
            </tbody>
        </table>

        <!-- Botón para añadir un producto -->
        <button class="add-product-button" onclick="addProduct()">Añadir Producto</button>

        <!-- Calculo del IVA y total -->
        <div class="invoice-footer">
            <p class="total-section">Subtotal: <span id="subtotal">€0.00</span></p>
            <p class="total-section">IVA (21%): <span id="iva">0.00</span></p>
            <p class="total-section">Total a Pagar: <span id="total">$0.00</span></p>
        </div>
    </div>

    <?php include 'logs/footer.php'; ?>

</body>

</html>