<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); 
    }
    if (!isset($check_in) || !isset($check_out)) {
        $check_in = $_SESSION['check_in'] ?? '';
        $check_out = $_SESSION['check_out'] ?? '';
    }
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Symplex - Detalles del alojamiento</title>
    <link rel="icon" type="image/png" href="assets/img/logoS.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
    </style>
    <script src="index.php?action=detailsJs"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php?action=home">
            <img src="assets/img/nuevologoSymplex.png" alt="Logo Symplex" class="logo-img me-2" />
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
        <!-- Cambié mb-4 a mb-2 para menos espacio abajo -->
        <div class="col-lg-8 mb-2">

            <!-- Imagen -->
            <div class="rounded shadow-sm overflow-hidden">
                <img
                    src="<?= htmlspecialchars($alojamiento['image_url']) ?>"
                    class="w-100"
                    alt="<?= htmlspecialchars($alojamiento['name']) ?>"
                    style="height: 400px; object-fit: cover;"
                />
            </div>

            <!-- Comodidades y descripción -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <h3>Comodidades</h3>
                    <div class="amenities d-flex flex-wrap">
                        <?php if (!empty($amenities)): ?>
                            <?php foreach ($amenities as $amenity): ?>
                                <span class="amenity me-3 mb-2">
                                    <i class="bi bi-check-circle"></i> <?= htmlspecialchars($amenity['name']) ?>
                                </span>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <p>No hay comodidades disponibles.</p>
                            <?php endif; ?>
                    </div>
                    <!-- Descripción añadida -->
                    <div class="description mt-4">
                        <h3>Descripción</h3>
                        <p style="text-align: justify;"><?= nl2br(htmlspecialchars($alojamiento['description'])) ?></p>

                        <?php if (isset($_SESSION['last_search_filters'])): ?>
                            <form action="index.php?action=search" method="POST" class="d-flex justify-content-center my-4">
                                <?php foreach ($_SESSION['last_search_filters'] as $key => $value): ?>
                                    <input type="hidden" name="filters[<?= htmlspecialchars($key) ?>]" value="<?= htmlspecialchars($value) ?>">
                                <?php endforeach; ?>
                                <button type="submit" class="btn btn-outline-primary btn-lg shadow-sm rounded-pill px-4">
                                    <i class="bi bi-arrow-left-circle me-2"></i>Volver a la búsqueda
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                                        
                    <!-- Formulario para crear Reserva -->
                    <?php if (isset($_SESSION['user'])): ?>
                        <div id="toastReserva" class="toast-reserva-container d-none">
                            <form action="index.php?action=book" method="POST" class="booking-form">
                                <button type="button" class="btn-close enhanced-close-btn" aria-label="Cerrar" onclick="document.getElementById('toastReserva').classList.add('d-none')"></button>
                                <h3 class="mb-4">Haz tu reserva</h3>
                                <input type="hidden" name="accommodation_id" value="<?= htmlspecialchars($alojamiento['accommodation_id']) ?>" />
                                <input type="hidden" name="user_email" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" />
                                
                                <!-- Tipo de habitación -->
                                <div class="mb-3">
                                    <label for="room_type">Tipo de habitación</label>
                                    <select name="room_type" id="room_type" class="form-control" required>
                                        <option value="" disabled selected>Selecciona tipo</option>
                                        <?php if (in_array('single', $roomTypesAvailable)): ?>
                                            <option value="single">Individual</option>
                                        <?php endif; ?>
                                        <?php if (in_array('double', $roomTypesAvailable)): ?>
                                            <option value="double">Doble</option>
                                        <?php endif; ?>
                                        <?php if (in_array('family', $roomTypesAvailable)): ?>
                                            <option value="family">Familiar</option>
                                        <?php endif; ?>
                                        <?php if (in_array('suite', $roomTypesAvailable)): ?>
                                            <option value="suite">Suite</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <!-- Fechas -->
                                <div class="mb-3">
                                    <label for="check_in">Fecha de entrada</label>
                                    <input type="text" name="check_in" id="check_in" value="<?= htmlspecialchars($check_in ?? '') ?>" readonly class="form-control" required />
                                </div>
                                <div class="mb-3">
                                    <label for="check_out">Fecha de salida</label>
                                    <input type="text" name="check_out" id="check_out" value="<?= htmlspecialchars($check_out ?? '') ?>" readonly class="form-control" required />
                                </div>
                                <!-- Botón de envío -->
                                <button type="button" id="btnSubmitBooking" class="btn btn-success">Reservar ahora</button>
                            </form>
                        </div>
                    <?php endif; ?>

                    <?php if (!isset($_SESSION['user'])): ?>
                        <!-- Toast de login -->
                        <div id="toastLogin" class="toast-reserva-container d-none">
                            <div class="p-4 text-center booking-form">
                                <button type="button" class="btn-close enhanced-close-btn" aria-label="Cerrar" onclick="document.getElementById('toastLogin').classList.add('d-none')"></button>
                                <h5 class="mb-3 text-primary">Atención</h5>
                                <p class="mb-3">Debes iniciar sesión para realizar una reserva.</p>
                                <a href="index.php?action=login" class="btn btn-outline-primary">Iniciar sesión</a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="details">
                <h2><?= htmlspecialchars($alojamiento['name']) ?></h2>
                <p class="mb-1">
                    <i class="bi bi-geo-alt"></i>
                        <?= htmlspecialchars($alojamiento['address']) ?>
                </p>
                <p>
                    <a href="https://www.google.com/maps/search/?q=<?= urlencode($alojamiento['address']) ?>" 
                        target="_blank" 
                        class="text-decoration-none">
                        Muy buena ubicación - Ver mapa
                    </a>
                </p>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="fs-4">
                        <i class="bi bi-share text-primary" style="cursor:pointer;"></i>
                    </div>
                    <button id="btnReservar" class="btn btn-primary">¡Quiero reservar una habitación!</button>
                </div>

                <hr />
 
                <div class="fs-6 lh-sm">
                    <h4>Comentarios recientes</h4>

                    <?php if (!empty($reviews)): ?>
                        <?php 
                        // Limitamos a 3 reviews (las 3 primeras del array)
                        $recentReviews = array_slice($reviews, 0, 2);
                        ?>
                        <?php foreach ($recentReviews as $review): ?>
                            <div class="review mb-4 border rounded p-3 shadow-sm">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="user-avatar rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center me-3" 
                                        style="width: 40px; height: 40px; font-weight: bold; font-size: 1.2rem;">
                                        <?= htmlspecialchars(strtoupper(substr($review['first_name'] ?? 'U', 0, 1) . ($review['last_name'] ? substr($review['last_name'], 0, 1) : ''))) ?>
                                    </div>
                                    <strong><?= htmlspecialchars($review['first_name'] . ' ' . $review['last_name']) ?></strong>
                                    <small class="text-muted ms-auto" style="font-size: 0.8rem;">
                                        <?= date('d M Y', strtotime($review['created_at'])) ?>
                                    </small>
                                </div>
                                <div class="rating mb-2" style="color: #ffc107; font-size: 1.1rem; background-color: transparent;">
                                    <?php
                                        $maxStars = 5;
                                        $rating = round($review['rating'] / 2 * 2) / 2; // redondea al medio más cercano
                                        $fullStars = floor($rating);
                                        $halfStar = ($rating - $fullStars) >= 0.5 ? true : false;
                                        $emptyStars = $maxStars - $fullStars - ($halfStar ? 1 : 0);

                                        // estrellas llenas
                                        for ($i = 0; $i < $fullStars; $i++) {
                                            echo '<i class="bi bi-star-fill"></i>';
                                        }
                                        // estrella media
                                        if ($halfStar) {
                                            echo '<i class="bi bi-star-half"></i>';
                                        }
                                        // estrellas vacías
                                        for ($i = 0; $i < $emptyStars; $i++) {
                                            echo '<i class="bi bi-star"></i>';
                                        }
                                    ?>
                                    <span class="ms-2" style="color: #444; font-size: 0.9rem;">
                                        (<?= htmlspecialchars($review['rating']) ?>/10)
                                    </span>
                                </div>
                                <p style="text-align: justify;"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay comentarios todavía.</p>
                    <?php endif; ?>
                </div>


                <hr />

                <div class="map rounded shadow-sm overflow-hidden">
                    <iframe
                        width="100%"
                        height="300"
                        frameborder="0"
                        style="border:0"
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps?q=<?= urlencode($alojamiento['address']) ?>&output=embed"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stripe Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="index.php?action=payment" method="POST" id="paymentForm" class="p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Pago con Stripe (Prueba)</h5>
                    <?php if (!empty($_SESSION['payment_error'])): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($_SESSION['payment_error']); ?>
                        </div>
                        <?php unset($_SESSION['payment_error']); ?>
                    <?php endif; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Cantidad (€): <?php echo($price) ?></label>
                    <input type="hidden" name="amount" id="amount" value="<?php echo($price) ?>" required/>
                </div>
                <p class="small text-muted">
                    Usa el número de tarjeta <strong>4242 4242 4242 4242</strong> con cualquier fecha futura y CVC.
                </p>
                <script src="https://js.stripe.com/v3/"></script>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Pagar con Stripe</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="paymentSuccessModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 text-center">
            <div class="alert alert-success">
                <h4 id="paymentSuccessMessage">Pago realizado con éxito</h4>
                <p style="font-size: 9px;">(es solo un testeo)</p>
            </div>
        </div>
    </div>
</div>

<!-- Failure Modal -->
<div class="modal fade" id="paymentFailureModal" tabindex="-1" aria-labelledby="paymentFailureModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="paymentFailureLabel">Pago fallido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p>Hubo un problema al procesar tu pago. Por favor, inténtalo de nuevo.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast para confirmar copia -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
  <div id="copyToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        ¡Enlace copiado!
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
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

<?php if (isset($_SESSION['last_search_filters'])): ?>
    <form action="index.php?action=search" method="POST" class="mb-3">
        <?php foreach ($_SESSION['last_search_filters'] as $key => $value): ?>
            <input type="hidden" name="filters[<?= htmlspecialchars($key) ?>]" value="<?= htmlspecialchars($value) ?>">
        <?php endforeach; ?>
        <button type="submit" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver a la búsqueda
        </button>
    </form>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('btnReservar');
    const toastReserva = document.getElementById('toastReserva');
    const toastLogin = document.getElementById('toastLogin');

    if (btn) {
        btn.addEventListener('click', function () {
            if (toastReserva) {
                toastReserva.classList.remove('d-none');
                toastReserva.scrollIntoView({ behavior: 'smooth' });
            } else if (toastLogin) {
                toastLogin.classList.remove('d-none');
                toastLogin.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const bookingForm = document.querySelector('.booking-form');
    const btnSubmitBooking = document.getElementById('btnSubmitBooking');
    const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));

    btnSubmitBooking.addEventListener('click', function() {
        if (bookingForm.checkValidity()) {
            paymentModal.show();
        } else {
            bookingForm.reportValidity();
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById("paymentForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Stop full-page reload

    const form = e.target;
    const formData = new FormData(form);

    fetch("index.php?action=payment", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        // Hide the payment modal
        const paymentModal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
        if (paymentModal) paymentModal.hide();

        if (data.success) {
            const successModalElem = document.getElementById('paymentSuccessModal');
            const successModal = new bootstrap.Modal(successModalElem);
            sessionStorage.setItem('payment_status', 'success');
            successModal.show();

            setTimeout(() => {
                const bookingForm = document.querySelector('.booking-form');
                if (bookingForm) {
                    bookingForm.submit();
                }
            }, 1500);
        } else {
            const failureModalElem = document.getElementById('paymentFailureModal');
            const failureModal = new bootstrap.Modal(failureModalElem);
            sessionStorage.setItem('payment_status', 'failure');
            failureModal.show();
        }
    })
    .catch(err => {
        console.error("Error:", err);
        const failureModal = new bootstrap.Modal(document.getElementById('paymentFailureModal'));
        failureModal.show();
    });
});
</script>
</body>
</html>
