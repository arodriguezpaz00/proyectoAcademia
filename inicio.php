<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio Nuevos Horizontes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .hero {
            background: url('fondo-hero.jpg') no-repeat center center/cover;
            
            padding: 60px 0;
            text-align: center;
        }

        .hero h2 {
            font-size: 2.5em;
        }

        .hero p {
            font-size: 1.2em;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007BFF; /* Azul brillante */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #0056b3; /* Azul más oscuro al pasar el mouse */
        }

        section {
            padding: 40px 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #003366; /* Azul oscuro */
        }

        .programa {
            margin: 20px 0;
            background: #f4f4f4;
            padding: 15px;
            border-radius: 5px;
        }

        blockquote {
            background: #e2f7e2;
            border-left: 5px solid #007BFF; /* Azul brillante */
            margin: 20px 0;
            padding: 15px;
            font-style: italic;
        }

        
        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input,
        .input-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-group textarea {
            resize: vertical; /* Permitir que el usuario cambie el tamaño verticalmente */
        }

        .video-container {
            text-align: center;
            margin: 40px 0;
        }

        iframe {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    
    <?php include 'logs/header.php' ?>

    <section class="hero">
        <div class="container">
            <h2>Tu futuro comienza aquí</h2>
            <p>Ofrecemos una educación integral que prepara a nuestros estudiantes para enfrentar los retos del futuro.</p>
            <a href="#contacto" class="btn">¡Inscríbete Ahora!</a>
        </div>
    </section>

    <section id="programas">
        <div class="container">
            <h2>Programas Ofrecidos</h2>
            <div class="programa">
                <h3>Educación Inicial</h3>
                <p>Un programa diseñado para fomentar el desarrollo integral de los niños pequeños.</p>
            </div>
            <div class="programa">
                <h3>Educación Primaria</h3>
                <p>Enfocado en el desarrollo de habilidades académicas y sociales.</p>
            </div>
            <div class="programa">
                <h3>Educación Secundaria</h3>
                <p>Preparando a los estudiantes para su futuro académico y personal.</p>
            </div>
        </div>
    </section>

    <section id="testimonios">
        <div class="container">
            <h2>Testimonios</h2>
            <blockquote>
                <p>"El Colegio Nuevos Horizontes ha cambiado la vida de mi hijo. La educación es excelente y los docentes son muy comprometidos."</p>
                <cite>- Mamá de Juan</cite>
            </blockquote>
            <blockquote>
                <p>"Un lugar donde los niños aprenden y crecen en un ambiente seguro y positivo."</p>
                <cite>- Papá de Ana</cite>
            </blockquote>
        </div>
    </section>

    <!-- Sección del video -->
    <section class="video-container">
        <h2>Mira nuestro video</h2>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/4-z6X4Dz5EY?si=Wl2m-CG9kf9iBMdC&rel=0&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>



    </section>

    <section id="contacto">
        <div class="container">
            <h2>Contacto</h2>
            <form action="" method="POST">
                <div class="input-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" required>
                </div>
                <div class="input-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="mensaje">Mensaje:</label>
                    <textarea name="mensaje" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn">Enviar Mensaje</button>
            </form>
        </div>
    </section>

    <?php include 'logs/footer.php' ?>
</body>
</html>
