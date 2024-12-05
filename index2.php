<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
</head>

<body style="background-color: #dfb489; font-family: Arial, sans-serif;">
    
<?php include 'logs/header.php';?>
<main>

        <div class="container" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
            <form action="" onclick="login()" name="login" style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                <div class="mb-3" style="margin-bottom: 15px;">
                    <label for="usuario" class="form-label" style="margin-bottom: 5px; font-weight: bold;">USUARIO</label>
                    <input
                        type="text"
                        class="form-control"
                        name="usuario"
                        id="usuario"
                        aria-describedby="helpId"
                        placeholder="Introduce usuario"
                        style="width: 300px; margin-bottom: 15px; padding: 10px;" />
                </div>

                <div class="mb-3" style="margin-bottom: 15px;">
                    <label for="clave" class="form-label" style="margin-bottom: 5px; font-weight: bold;">CLAVE</label>
                    <input
                        type="password"
                        class="form-control"
                        name="clave"
                        id="clave"
                        aria-describedby="helpId"
                        placeholder="Introduce contraseña"
                        style="width: 300px; margin-bottom: 15px; padding: 10px;" />
                </div>

                <div style="display: flex; justify-content: center; margin-bottom: 10px;">
                    <button type="submit" class="btn btn-primary" style="margin-right: 10px; background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px;">ENTRAR</button>
                    <button type="button" class="btn btn-danger" style="background-color: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 5px;">BORRAR</button>
                </div>

                <a href="#" class="forgot-password" style="margin-top: 10px; display: block; text-align: center;">¿Olvidó su contraseña?</a>
            </form>
        </div>

    </main>


    <?php include 'logs/footer.php';?>

    <script>
        function login(){
            let usuario = document.login.usuario.value;
            let password = document.login.password.value;

            if(usuario == 'andres' && password == '1234'){
                alert('Login OK')
            } else {
                alert('NOOO')
            }

        }
    </script>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>