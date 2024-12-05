<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2JLrlj2gBL5UwULyQ5MdSMAPZ6YtSkAx5CIR59IhX55JPEW2Pi6j" crossorigin="anonymous" />
</head>

<body style="background-color: #dfb489; font-family: Arial, sans-serif;">

    <?php include 'logs/header.php';?>

    <main>
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <form id="loginForm" onsubmit="login(event);" style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                <div class="mb-3">
                    <label for="usuario" class="form-label" style="font-weight: bold;">USUARIO</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Introduce usuario" required />
                </div>

                <div class="mb-3">
                    <label for="clave" class="form-label" style="font-weight: bold;">CLAVE</label>
                    <input type="password" class="form-control" name="clave" id="clave" placeholder="Introduce contraseña" required />
                </div>

                <div class="d-flex justify-content-center mb-2">
                    <button type="submit" class="btn btn-primary" style="margin-right: 10px;">ENTRAR</button>
                    <button type="reset" class="btn btn-danger">BORRAR</button>
                </div>

                <a href="#" class="forgot-password text-center">¿Olvidó su contraseña?</a>
            </form>
        </div>
    </main>

    <?php include 'logs/footer.php';?>

    <script>
        function login(event) {
            event.preventDefault(); // Evita que el formulario se envíe
            const usuario = document.getElementById('usuario').value;
            const clave = document.getElementById('clave').value;

            console.log('Entro al login:', usuario);
            if (usuario === 'andres' && clave === '1234') {
                console.log('Login exitoso');
                window.location.href = 'inicio.php';
            } else {
                alert('Credenciales incorrectas');
            }
        }
    </script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
