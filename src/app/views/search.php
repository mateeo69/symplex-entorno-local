<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); 
    }

    if (!isset($search_results)) {
        $results = $filter_results;
    } else {
        $results = $search_results;
        $_SESSION['accommodations'] = $search_results;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/img/logoS.png">
    <title>Symplex - Resultados de búsqueda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Estilos para las vistas de lista y tabla */
        .view-grid .accommodation-card {
            margin-bottom: 20px;
        }
        
        .view-list .accommodation-card {
            display: flex;
            margin-bottom: 15px;
            width: 100%;
        }
        
        .view-list .accommodation-card .card {
            display: flex;
            flex-direction: row;
            width: 100%;
        }
        
        .view-list .accommodation-card .card-img-top {
            width: 30%;
            height: 100%;
            object-fit: cover;
            border-top-right-radius: 0;
            border-bottom-left-radius: calc(0.25rem - 1px);
        }
        
        .view-list .accommodation-card .card-body {
            width: 70%;
        }
        
        /* Inicialmente ocultar la vista de lista */
        .view-list {
            display: none;
        }
    </style>
    <script src="index.php?action=searchJs"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a href="index.php?action=home" class="navbar-brand d-flex align-items-center" href="#">
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

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar">
                    <form action="index.php?action=filter" method="POST">
                        <h5>Aplicar filtros</h5>
                        <?php foreach ($all_amenities as $amenity): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="<?php echo htmlspecialchars($amenity['name']); ?>" name="accFilters[]" value="<?php echo htmlspecialchars($amenity['name']); ?>">
                                <label class="form-check-label" for="<?php echo htmlspecialchars($amenity['name']); ?>"><?php echo htmlspecialchars($amenity['name']); ?></label>
                            </div>
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </form>
                    <form action="index.php?action=search" method="POST" class="mt-2">
                        <input type="hidden" name="filters[city_name]" value="<?php echo htmlspecialchars($_SESSION['city_name'] ?? ''); ?>">
                        <input type="hidden" name="filters[check_in]" value="<?php echo htmlspecialchars($_SESSION['check_in'] ?? ''); ?>">
                        <input type="hidden" name="filters[check_out]" value="<?php echo htmlspecialchars($_SESSION['check_out'] ?? ''); ?>">
                        <input type="hidden" name="filters[people]" value="<?php echo htmlspecialchars($_SESSION['people'] ?? ''); ?>">
                        <button type="submit" class="btn btn-outline-secondary">Limpiar filtros</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-9">
                <h1 class="mb-4">Resultados de búsqueda en <?php echo htmlspecialchars($_SESSION['city_name']); ?>: <?php echo count($results); ?> alojamientos encontrados</h1>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <button id="btnList" class="btn btn-outline-secondary btn-sm me-2"><i class="bi bi-list"></i> Lista</button>
                        <button id="btnGrid" class="btn btn-secondary btn-sm"><i class="bi bi-grid"></i> Tabla</button>
                    </div>
                </div>

                <!-- Vista de tabla (por defecto) -->
                <div id="gridView" class="row view-grid">
                    <?php foreach ($results as $result): ?>
                    <div class="col-md-6 accommodation-card">
                        <div class="card">
                            <img src="<?= htmlspecialchars($result['image_url']) ?>" class="card-img-top" alt="Alojamiento">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($result['name']) ?></h5>
                                <p class="location"><?= htmlspecialchars($result['address']) ?></p>
                                <?php
                                    $detailsUrl = 'index.php?action=details'
                                        . '&id=' . urlencode($result['accommodation_id'])
                                        . '&check_in=' . urlencode($_SESSION['check_in'] ?? '')
                                        . '&check_out=' . urlencode($_SESSION['check_out'] ?? '')
                                        . '&city_name=' . urlencode($_SESSION['city_name'] ?? '')
                                        . '&price=' . urlencode($result['min_price'] ?? '');
                                ?>
                                <a href="<?= $detailsUrl ?>" class="btn btn-primary">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Vista de lista (inicialmente oculta) -->
                <div id="listView" class="view-list">
                    <?php foreach ($results as $result): ?>
                    <div class="accommodation-card">
                        <div class="card">
                            <img src="<?= htmlspecialchars($result['image_url']) ?>" class="card-img-top" alt="Alojamiento">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title"><?= htmlspecialchars($result['name']) ?></h5>
                                    <p class="location"><?= htmlspecialchars($result['address']) ?></p>
                                </div>
                                <?php
                                    $detailsUrl = 'index.php?action=details'
                                        . '&id=' . urlencode($result['accommodation_id'])
                                        . '&check_in=' . urlencode($_SESSION['check_in'] ?? '')
                                        . '&check_out=' . urlencode($_SESSION['check_out'] ?? '')
                                        . '&city_name=' . urlencode($_SESSION['city_name'] ?? '');
                                ?>
                                <div class="mt-3">
                                    <a href="<?= $detailsUrl ?>" class="btn btn-primary">
                                        Ver detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
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
    <script src="index.php?action=searchJs"></script>
</body>
</html>