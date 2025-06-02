<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); 
    }
    if (!isset($_SESSION['search_results'])) {
        $_SESSION['search_results'] = $search_results;
    }
    if (isset($search_results_filtered)) {
        $search_results = $search_results_filtered;
    } else {
        $search_results = $_SESSION['search_results'];
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Symplex - Mis Reservas</title>
    <link rel="icon" type="image/png" href="assets/img/logoS.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="index.php?action=bookingsJs"></script>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="w-100 d-flex justify-content-center">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/img/nuevologoSymplex.png" alt="Logo Symplex" class="logo-img me-2" />
            </a>
        </div>
    </div>
</nav>
<!-- Caja de perfil de usuario -->
<div class="container mt-4">
    <div class="card shadow-sm mb-4">
        <div class="card-body py-3">
            <div class="row align-items-center">
                <div class="col-md-6" 
                     data-user-firstname="<?= htmlspecialchars($_SESSION['user']['first_name'] ?? '') ?>" 
                     data-user-lastname="<?= htmlspecialchars($_SESSION['user']['last_name'] ?? '') ?>" 
                     data-user-email="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>" 
                     data-user-phone="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>" 
                     data-user-city="<?= htmlspecialchars($_SESSION['user']['city'] ?? '') ?>" 
                     id="userDataContainer">
                    <h4 class="mb-1">Bienvenido, <span id="userName"><?= htmlspecialchars($_SESSION['user']['first_name'] ?? 'Usuario') ?></span></h4>
                    <p class="text-muted mb-0"><i class="fas fa-envelope me-2"></i><span id="userEmail"><?= htmlspecialchars($_SESSION['user']['email'] ?? 'Usuario') ?></span></p>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="fas fa-user-edit me-1"></i> Editar perfil
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="fas fa-key me-1"></i> Cambiar contraseña
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar perfil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Editar perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" tabindex="-1"></button>
            </div>
            <div class="modal-body">
                <form id="profileForm">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Tu nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" placeholder="Tu apellido">
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo" placeholder="tu@email.com">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" placeholder="+34 600 000 000">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="guardarPerfil">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para comentarios -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Cuentanos tu experiencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" tabindex="-1"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?action=review" method='POST' id="commentForm">
                    <input type="hidden" name="user_id" value=" <?= htmlspecialchars($_SESSION['user']['user_id']) ?>" readonly> 
                    <input type="hidden" name="accommodation_id" value="" readonly>                   
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Cuentanos tu experiencia:</label>
                        <textarea class="form-control" id="comment" name="comment" placeholder="Escribe aquí tu comentario" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tu puntuación:</label>
                        <div class="rating-10">
                            <input type="radio" name="rating" id="star10" value="10" />
                            <label for="star10" title="10 estrellas">★</label>
                            <input type="radio" name="rating" id="star9" value="9" />
                            <label for="star9" title="9 estrellas">★</label>
                            <input type="radio" name="rating" id="star8" value="8" />
                            <label for="star8" title="8 estrellas">★</label>
                            <input type="radio" name="rating" id="star7" value="7" />
                            <label for="star7" title="7 estrellas">★</label>
                            <input type="radio" name="rating" id="star6" value="6" />
                            <label for="star6" title="6 estrellas">★</label>
                            <input type="radio" name="rating" id="star5" value="5" />
                            <label for="star5" title="5 estrellas">★</label>
                            <input type="radio" name="rating" id="star4" value="4" />
                            <label for="star4" title="4 estrellas">★</label>
                            <input type="radio" name="rating" id="star3" value="3" />
                            <label for="star3" title="3 estrellas">★</label>
                            <input type="radio" name="rating" id="star2" value="2" />
                            <label for="star2" title="2 estrellas">★</label>
                            <input type="radio" name="rating" id="star1" value="1" />
                            <label for="star1" title="1 estrella">★</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">Mis reservas</h1>
                <div class="filters d-flex gap-3">
                    <div class="d-flex gap-3">
                        <select class="form-select" id="estado-filtro">
                            <option value="all" <?php if(isset($_GET['status']) && $_GET['status'] === 'all') echo 'selected'; ?>>Todas las reservas</option>
                            <option value="confirmed" <?php if(isset($_GET['status']) && $_GET['status'] === 'confirmed') echo 'selected'; ?>>Confirmadas</option>
                            <option value="pending" <?php if(isset($_GET['status']) && $_GET['status'] === 'pending') echo 'selected'; ?>>Pendientes</option>
                            <option value="completed" <?php if(isset($_GET['status']) && $_GET['status'] === 'completed') echo 'selected'; ?>>Completadas</option>
                            <option value="cancelled" <?php if(isset($_GET['status']) && $_GET['status'] === 'cancelled') echo 'selected'; ?>>Canceladas</option>
                        </select>
                        <select class="form-select" id="orden-fecha">
                            <option value="upcoming" <?php if(!isset($_GET['order']) || $_GET['order'] === 'upcoming') echo 'selected'; ?>>Próximas primero</option>
                            <option value="past" <?php if(isset($_GET['order']) && $_GET['order'] === 'past') echo 'selected'; ?>>Pasadas primero</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="reservas-container">
        <?php if (!empty($search_results)): ?>
            <?php foreach ($search_results as $result): ?>
                <div class="card mb-4 shadow-sm reserva-card" data-estado="<?php echo htmlspecialchars($result['status']); ?>" data-id="<?= htmlspecialchars($result['accommodation_id']) ?>" data-booking-id="<?= htmlspecialchars($result['booking_id']) ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src=<?php echo htmlspecialchars($result['image_url']); ?> alt="Hotel" class="img-fluid rounded" />
                            </div>
                            <div class="col-md-6">
                                <h4 class="hotel-name"><?php echo htmlspecialchars($result['accommodation_name']); ?></h4>
                                <p class="mb-1"><i class="fas fa-map-marker-alt text-primary me-2"></i><?php echo htmlspecialchars($result['city_name'] . ', ' . $result['country']); ?></p>
                                <div class="d-flex flex-wrap gap-3 mb-2">
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-calendar-check text-primary me-1"></i> Check-in: <?php echo htmlspecialchars($result['check_in']); ?>
                                    </span>
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-calendar-times text-primary me-1"></i> Check-out: <?php echo htmlspecialchars($result['check_out']); ?>
                                    </span>
                                </div>
                                <div class="d-flex flex-wrap gap-3">
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-bed text-primary me-1"></i> Habitación <?php echo htmlspecialchars($result['room_type']); ?>
                                    </span>
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-user text-primary me-1"></i> <?php echo htmlspecialchars($result['capacity']); ?> adultos
                                    </span>
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-euro-sign text-primary me-1"></i> <?php echo htmlspecialchars($result['price']); ?>€
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3 text-md-end">
                                <div class="d-flex flex-column align-items-md-end">
                                    <?php if($result['status'] === 'confirmed'): ?>
                                        <span class="badge bg-success mb-3 px-3 py-2">Confirmada</span>
                                    <?php elseif($result['status'] === 'pending'): ?>
                                        <span class="badge bg-warning text-dark mb-3 px-3 py-2">Pendiente</span>
                                    <?php elseif($result['status'] === 'completed'): ?>
                                        <span class="badge bg-secondary mb-3 px-3 py-2">Completada</span>
                                    <?php elseif($result['status'] === 'cancelled'): ?>
                                        <span class="badge bg-danger mb-3 px-3 py-2">Cancelada</span>
                                    <?php endif; ?>
                                    <div class="d-grid gap-2">
                                        <?php if($result['status'] === 'completed'): ?>
                                        <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#commentModal">
                                            <i class="fas fa-solid fa-comments me-1"></i> Dejar reseña
                                        </a>
                                        <?php endif; ?>
                                        <?php if($result['status'] !== 'cancelled' && $result['status'] !== 'completed'): ?>
                                        <a href="#" class="btn btn-outline-danger btn-sm cancel-booking-btn" data-bs-toggle="modal" data-bs-target="#cancelarModal" data-booking-id="<?php echo htmlspecialchars($result['booking_id']); ?>">
                                            <i class="fas fa-times-circle me-1"></i> Cancelar reserva
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div id="no-reservas" class="card p-5 text-center shadow-sm">
                <div class="py-5">
                    <i class="fas fa-calendar-times fa-5x text-muted mb-3"></i>
                    <h3>No tienes reservas actualmente</h3>
                    <p class="text-muted mb-4">Cuando realices una reserva, aparecerá aquí para que puedas gestionarla fácilmente.</p>
                    <a href="index.php" class="btn btn-primary">Explorar alojamientos</a>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if (isset($totalPages) && $totalPages > 1): ?>
        <!-- Controles de paginación -->
        <div class="pagination-container mt-4 d-flex justify-content-center">
            <nav aria-label="Navegación de páginas">
                <ul class="pagination">
                    <?php 
                    // Obtener los parámetros actuales para mantenerlos en los enlaces
                    $status = isset($_GET['status']) ? $_GET['status'] : 'all';
                    $order = isset($_GET['order']) ? $_GET['order'] : 'upcoming';
                    
                    // Botón Anterior
                    if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?action=bookings&status=<?= $status ?>&order=<?= $order ?>&page=<?= $currentPage - 1 ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php else: ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php 
                    // Números de página
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($totalPages, $startPage + 4);
                    
                    if ($startPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?action=bookings&status=<?= $status ?>&order=<?= $order ?>&page=1">1</a>
                    </li>
                    <?php if ($startPage > 2): ?>
                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                    <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?action=bookings&status=<?= $status ?>&order=<?= $order ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($endPage < $totalPages): ?>
                    <?php if ($endPage < $totalPages - 1): ?>
                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                    <?php endif; ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?action=bookings&status=<?= $status ?>&order=<?= $order ?>&page=<?= $totalPages ?>"><?= $totalPages ?></a>
                    </li>
                    <?php endif; ?>
                    
                    <!-- Botón Siguiente -->
                    <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?action=bookings&status=<?= $status ?>&order=<?= $order ?>&page=<?= $currentPage + 1 ?>" aria-label="Siguiente">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php else: ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Siguiente">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal para confirmar cancelación -->
<div class="modal fade" id="cancelarModal" tabindex="-1" aria-labelledby="cancelarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelarModalLabel">Confirmar cancelación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" tabindex="-1"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas cancelar esta reserva? Esta acción no se puede deshacer.</p>
                <p class="small text-muted">Nota: Es posible que se apliquen cargos por cancelación según la política del hotel.</p>
                <input type="hidden" id="booking-id-to-cancel" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                <button type="button" class="btn btn-danger" id="confirmarCancelacion">Sí, cancelar reserva</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para cambiar contraseña -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="changePasswordForm" method="POST" action="index.php?action=changePassword">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Cambiar contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" tabindex="-1"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Contraseña actual</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Confirmar nueva contraseña</label>
                        <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <div id="passwordMismatchAlert" class="alert alert-danger d-none" role="alert">
                        Las nuevas contraseñas no coinciden.
                    </div>
                    <input type="hidden" name="search_results" value="<?= htmlspecialchars($search_results) ?>">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal template for change pass status -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" tabindex="-1"></button>
            </div>
        <div class="modal-body" id="messageModalBody">
            <!-- Message will be injected dynamically -->
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
</body>
</html>
