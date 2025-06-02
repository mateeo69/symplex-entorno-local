<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); 
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symplex - Sobre Nosotros</title>
    <link rel="icon" type="image/png" href="assets/img/logoS.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
    <!-- Navegación -->
    <nav class="navbar navbar-light bg-white shadow-sm justify-content-center">
        <a class="navbar-brand mx-auto d-flex align-items-center" href="index.php?action=home">
            <img src="assets/img/nuevologoSymplex.png" alt="Logo Symplex" class="logo-img" style="max-height: 60px;">
        </a>
    </nav>

    <!-- Encabezado -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold">Conoce Symplex</h1>
                <p class="lead mb-4">Tu aliado de confianza para encontrar el alojamiento perfecto en cada viaje</p>
                <hr class="my-4">
            </div>
        </div>
    </div>

    <!-- Historia de la empresa -->
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-lg-6 d-flex align-items-center">
                <div class="rounded overflow-hidden shadow-lg w-100 h-100">
                    <img src="assets/img/aboutUs/ourHistory.jpg" alt="Equipo Symplex" class="img-fluid w-100 h-100" style="object-fit: cover; max-height: 350px;">
                </div>
            </div>
            <div class="col-lg-6 text-justify">
                <h2 class="mb-4">Nuestra Historia</h2>
                <p style="text-align: justify;">Symplex nació del trabajo en equipo, de reunir nuestras mejores ideas y habilidades con un objetivo común. Desde el primer día tuvimos claro lo que queríamos construir, y con cada paso, ese proyecto fue tomando forma hasta convertirse en una realidad.</p>
                <p style="text-align: justify;">Esta plataforma ha sido creada con la ambición de convertirse en una referencia en las reservas de alojamiento, no solo en España, sino también en toda Europa. Creemos en lo que hacemos y en el valor que puede aportar a quienes aman viajar.</p>
                <p style="text-align: justify;">Hoy podemos decir con orgullo que nuestro proyecto está terminado. El equipo de Symplex os desea un año lleno de viajes, experiencias nuevas y muchas escapadas inolvidables. ¡Gracias por acompañarnos en este viaje!</p>
            </div>
        </div>
    </div>

    <!-- Misión, Visión y Valores -->
    <div class="container my-5 py-5 bg-white rounded shadow">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="mb-4">Misión, Visión y Valores</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-wrapper mb-3 d-flex justify-content-center">
                            <i class="bi bi-bullseye text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h3 class="card-title h4">Misión</h3>
                        <p class="card-text">Conectar a los viajeros con alojamientos de calidad en toda España, ofreciendo una experiencia de reserva simple, transparente y confiable.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-wrapper mb-3 d-flex justify-content-center">
                            <i class="bi bi-eye text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h3 class="card-title h4">Visión</h3>
                        <p class="card-text">Convertirnos en la plataforma de referencia para reservas de alojamiento en España, destacando por nuestra innovación tecnológica y atención personalizada.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-wrapper mb-3 d-flex justify-content-center">
                            <i class="bi bi-heart text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h3 class="card-title h4">Valores</h3>
                        <p class="card-text">Trabajamos bajo los principios de transparencia, calidad, innovación, responsabilidad con nuestros usuarios y cuidado del medio ambiente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sostenibilidad y Responsabilidad Social -->
    <div class="container my-5 py-5 bg-light rounded shadow">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4">Nuestro Compromiso Sostenible</h2>
                <p>En Symplex creemos que el turismo responsable es el futuro de nuestra industria. Por ello, nos comprometemos a:</p>
                <ul class="list-unstyled">
                    <li class="mb-3"><i class="bi bi-check-circle-fill text-primary me-2"></i> Promover alojamientos con prácticas sostenibles</li>
                    <li class="mb-3"><i class="bi bi-check-circle-fill text-primary me-2"></i> Reducir nuestra huella de carbono digital</li>
                    <li class="mb-3"><i class="bi bi-check-circle-fill text-primary me-2"></i> Colaborar con comunidades locales</li>
                    <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Fomentar el turismo responsable entre nuestros usuarios</li>
                </ul>
            </div>
            <div class="col-lg-6 d-flex align-items-center">
                <div class="rounded overflow-hidden shadow-lg w-100 h-100 mt-5 mt-lg-0">
                    <img src="assets/img/aboutUs/sustainability.jpg" alt="Sostenibilidad" class="img-fluid w-100 h-100" style="object-fit: cover; max-height: 350px;">
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="container my-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-primary text-white p-5 rounded shadow">
                    <h2>¿Listo para descubrir tu próximo destino?</h2>
                    <p class="lead">Miles de alojamientos te esperan en Symplex</p>
                    <a href="index.php?action=home" class="btn btn-light btn-lg mt-3">Buscar Alojamiento</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row align-items-stretch h-100" style="min-height: 220px;">
            <!-- Columna de información de la empresa -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 d-flex flex-column justify-content-center h-100 text-center text-lg-start">
                <img src="assets/img/nuevologoSymplex.png" alt="Logo Symplex" class="footer-logo mb-3" style="max-width: 130px;">
                <p class="small mb-2">Tu plataforma de reservas de alojamiento más sencilla y completa.</p>
                <span class="fst-italic text-info-emphasis" style="font-size: 1.1rem;">¡Viaja fácil, viaja Symplex!</span>
            </div>
            <!-- Columna de enlaces rápidos -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 d-flex flex-column justify-content-center h-100 text-center">
                <div>
                    <h6 class="text-uppercase mb-3">Enlaces rápidos</h6>
                    <ul class="list-unstyled mb-3">
                        <li class="mb-2"><a href="index.php" class="text-white text-decoration-none">Inicio</a></li>
                        <li class="mb-2"><a href="index.php?action=hotelview" class="text-white text-decoration-none">¿Eres propietario?</a></li>
                        <li class="mb-2"><a href="index.php?action=aboutUs" class="text-white text-decoration-none">Sobre nosotros</a></li>
                        <li class="mb-2"><a href="index.php?action=help" class="text-white text-decoration-none">Ayuda</a></li>
                        <li class="mb-2"><a href="index.php?action=terms" class="text-white text-decoration-none">Términos y condiciones</a></li>
                        <li class="mb-2"><a href="index.php?action=privacy" class="text-white text-decoration-none">Política de privacidad</a></li>
                    </ul>
                    <div class="mt-3">
                        <a href="https://facebook.com" target="_blank" rel="noopener" class="text-white me-3 fs-4"><i class="bi bi-facebook"></i></a>
                        <a href="https://instagram.com" target="_blank" rel="noopener" class="text-white me-3 fs-4"><i class="bi bi-instagram"></i></a>
                        <a href="https://twitter.com" target="_blank" rel="noopener" class="text-white me-3 fs-4"><i class="bi bi-twitter"></i></a>
                        <a href="https://linkedin.com" target="_blank" rel="noopener" class="text-white fs-4"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <!-- Columna de contacto directo -->
            <div class="col-lg-4 col-md-12 d-flex flex-column justify-content-center h-100 text-center text-lg-end">
                <div>
                    <h6 class="text-uppercase mb-3">Contacto directo</h6>
                    <p class="mb-1 small"><i class="bi bi-envelope-fill me-2"></i>info@symplex.com</p>
                    <p class="mb-1 small"><i class="bi bi-telephone-fill me-2"></i>+34 912 345 678</p>
                    <p class="mb-1 small"><i class="bi bi-geo-alt-fill me-2"></i>Málaga, España</p>
                </div>
            </div>
        </div>
        <hr class="bg-secondary my-4">
        <div class="row">
            <div class="col-12 text-center">
                <p class="small mb-1">© <?= date('Y') ?> Symplex - Todos los derechos reservados</p>
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>