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
    <title>Symplex - Landing</title>
    <link rel="icon" type="image/png" href="assets/img/logoS.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var cities = <?= json_encode($cities) ?>;
    </script>
    <script src="index.php?action=homeJs"></script>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="assets/img/nuevologoSymplex.png" alt="Logo Symplex" class="logo-img me-2">
            </a>
            <div id="user" class="d-flex align-items-center gap-2">
                <?php if (isset($_SESSION['user']) && $_SESSION['user'] != null): ?>
                    <span class="me-2">Bienvenido, <strong><?= htmlspecialchars($_SESSION['user']['first_name'] ?? 'Usuario') ?></strong></span>
                    <a href="index.php?action=bookings" class="btn btn-outline-primary">Perfil</a>
                    <a href="index.php?action=logout" class="btn btn-outline-danger">Cerrar sesión</a>
                <?php else: ?>
                    <a href="index.php?action=login" class="btn btn-outline-primary">Iniciar sesión</a>
                    <a href="index.php?action=register" class="btn btn-outline-primary">Registrarse</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div id="landingCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
        <div class="carousel-inner container">
            <div class="carousel-item active">
                <div class="image-placeholder image w-100">
                    <img src="assets/img/home/inicio1.jpg" alt="Imagen 1" class="d-block w-100">
                </div>
            </div>
            <div class="carousel-item">
                <div class="image-placeholder image w-100">
                    <img src="assets/img/home/inicio2.jpg" alt="Imagen 2" class="d-block w-100">
                </div>
            </div>
            <div class="carousel-item">
                <div class="image-placeholder image w-100">
                    <img src="assets/img/home/inicio3.jpg" alt="Imagen 3" class="d-block w-100">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#landingCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#landingCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="container">
        <form class="search-bar shadow-lg mt-4" action="index.php?action=search" method="POST">
            <div class="row g-3 align-items-end">
                <!-- Lugar -->
                <div class="col-lg-2 col-md-6">
                    <label for="lugar" class="form-label">Lugar</label>
                    <input type="text" class="form-control" id="lugar" name="filters[city_name]" placeholder="¿A dónde quieres ir?" required>
                </div>

                <!-- Fechas -->
                <div class="col-lg-4 col-md-6">
                    <label for="fechas" class="form-label">Fecha de ida y vuelta</label>
                    <div class="d-flex">
                        <input type="date" class="form-control" id="check_in" name="filters[check_in]" placeholder="Selecciona fecha de ida" required>
                        <span class="mx-2">a</span>
                        <input type="date" class="form-control" id="check_out" name="filters[check_out]" placeholder="Selecciona fecha de vuelta" required>
                    </div>
                </div>

                <!-- Tipo de alojamiento -->
                <div class="col-lg-3 col-md-6">
                    <label for="alojamiento" class="form-label">Tipo de alojamiento</label>
                    <select class="form-select" id="alojamiento" name="filters[accommodation_type]">
                        <option selected disabled>Elige una opción</option>
                        <option value="villa">Villas</option>
                        <option value="hotel">Hotel</option>
                        <option value="apartment">Apartamento</option>
                        <option value="cabin">Tienda de campaña</option>
                        <option value="hostel">Hostal</option>
                    </select>
                </div>

                <!-- Personas -->
                <div class="col-lg-1 col-md-6">
                    <label for="personas" class="form-label">Personas</label>
                    <input type="number" min="1" value="1" class="form-control" id="personas" name="filters[people]" required>
                </div>

                <!-- Botón de búsqueda -->
                <div class="col-lg-1 d-grid">
                    <button class="btn btn-primary" id="searchBtn" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div>


    <div class="container mt-5">
        <h2>¿Dónde puedes reservar con Symplex?</h2>
        <div id="map-loader" class="text-center">
            <div class="spinner-border text-primary" role="status"></div>
            <p>Cargando mapa...</p>
        </div>
        <div id="map" style="height: 400px; width: 100%; visibility: hidden;"></div>
    </div>

    <div class="container mt-5">
        <h2>Destinos de moda</h2>
        <p>Opciones más populares entre la comunidad viajera de España</p>
        <div class="row">
            <!-- Ejemplo para Madrid -->
            <div class="col-md-4 mb-4">
                <form action="index.php?action=search" method="POST">
                    <div class="card">
                        <img src="assets/img/home/madrid.jpg" alt="Madrid" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-center">Madrid <img src="assets/img/home/esp.jpg" alt="Bandera de Madrid" class="flag-icon"></h5>
                            <input type="hidden" name="filters[city_name]" value="Madrid">
                            <input type="hidden" name="filters[check_in]" value="<?= date('Y-m-d') ?>">
                            <input type="hidden" name="filters[check_out]" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                            <input type="hidden" name="filters[people]" value="1">
                            <button type="submit" class="btn btn-primary w-100 mt-2">Buscar ya</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 mb-4">
                <form action="index.php?action=search" method="POST">
                    <div class="card">
                        <img src="assets/img/home/sevilla.jpg" alt="Sevilla" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-center">Sevilla <img src="assets/img/home/esp.jpg" alt="Bandera de Sevilla" class="flag-icon"></h5>
                            <input type="hidden" name="filters[city_name]" value="Sevilla">
                            <input type="hidden" name="filters[check_in]" value="<?= date('Y-m-d') ?>">
                            <input type="hidden" name="filters[check_out]" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                            <input type="hidden" name="filters[people]" value="1">
                            <button type="submit" class="btn btn-primary w-100 mt-2">Buscar ya</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 mb-4">
                <form action="index.php?action=search" method="POST">
                    <div class="card">
                        <img src="assets/img/home/granada.jpg" alt="Granada" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-center">Granada <img src="assets/img/home/esp.jpg" alt="Bandera de Granada" class="flag-icon"></h5>
                            <input type="hidden" name="filters[city_name]" value="Granada">
                            <input type="hidden" name="filters[check_in]" value="<?= date('Y-m-d') ?>">
                            <input type="hidden" name="filters[check_out]" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                            <input type="hidden" name="filters[people]" value="1">
                            <button type="submit" class="btn btn-primary w-100 mt-2">Buscar ya</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <form action="index.php?action=search" method="POST">
                    <div class="card">
                        <img src="assets/img/home/barcelona.jpg" alt="Barcelona" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-center">Barcelona <img src="assets/img/home/esp.jpg" alt="Bandera de Barcelona" class="flag-icon"></h5>
                            <input type="hidden" name="filters[city_name]" value="Barcelona">
                            <input type="hidden" name="filters[check_in]" value="<?= date('Y-m-d') ?>">
                            <input type="hidden" name="filters[check_out]" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                            <input type="hidden" name="filters[people]" value="1">
                            <button type="submit" class="btn btn-primary w-100 mt-2">Buscar ya</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 mb-4">
                <form action="index.php?action=search" method="POST">
                    <div class="card">
                        <img src="assets/img/home/valencia.jpg" alt="Valencia" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-center">Valencia <img src="assets/img/home/esp.jpg" alt="Bandera de Valencia" class="flag-icon"></h5>
                            <input type="hidden" name="filters[city_name]" value="Valencia">
                            <input type="hidden" name="filters[check_in]" value="<?= date('Y-m-d') ?>">
                            <input type="hidden" name="filters[check_out]" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                            <input type="hidden" name="filters[people]" value="1">
                            <button type="submit" class="btn btn-primary w-100 mt-2">Buscar ya</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 mb-4">
                <form action="index.php?action=search" method="POST">
                    <div class="card">
                        <img src="assets/img/home/malaga.jpg" alt="Málaga" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-center">Málaga <img src="assets/img/home/esp.jpg" alt="Bandera de Málaga" class="flag-icon"></h5>
                            <input type="hidden" name="filters[city_name]" value="Málaga">
                            <input type="hidden" name="filters[check_in]" value="<?= date('Y-m-d') ?>">
                            <input type="hidden" name="filters[check_out]" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                            <input type="hidden" name="filters[people]" value="1">
                            <button type="submit" class="btn btn-primary w-100 mt-2">Buscar ya</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
