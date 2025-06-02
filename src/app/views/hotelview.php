<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); 
    }

    require_once '../app/models/City.php';

    $modelCity = new City();
    $cities = $modelCity->getAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symplex - Registro de Alojamientos</title>
    <link rel="icon" type="image/png" href="assets/img/logoS.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/img/nuevologoSymplex.png" alt="Logo Symplex" class="logo-img me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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

    <!-- Encabezado -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold">Colabora con Symplex</h1>
                <p class="lead mb-4">Registra tu alojamiento y alcanza a miles de viajeros</p>
                <hr class="my-4">
            </div>
        </div>
    </div>

    <!-- Formulario de registro -->
    <!-- Columna del formulario de contacto para hoteles -->
            <div class="col-lg-4 col-md-6 mb-5 mx-auto" id="hotelContactFormMessage">
                <div class="card shadow border-0">
                    <div class="card-body p-4">
                        <?php if (isset($createdOwnerDataForEmail) && $createdOwnerDataForEmail && !isset($_SESSION['user'])): ?>
                            <h5 class="text-uppercase mb-4 text-success"><i class="bi bi-check-circle-fill me-2"></i>Formulario enviado</h5>
                            <p style="color: black; background-color: #ffffe4; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">Gracias por registrarte. Te hemos enviado un correo de confirmación.</p>
                        <?php elseif (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                            <h5 class="text-uppercase mb-4 text-primary">¡Gracias por trabajar con nosotros!</h5>
                        <?php else: ?>
                            <h5 class="text-uppercase mb-3 text-primary text-center">
                                Registra tu alojamiento con Symplex
                            </h5>
                            <p class="mb-4">Si tienes un alojamiento y quieres trabajar con nosotros, déjanos tus datos:</p>
                            <form id="hotelContactForm" method="post" action="index.php?action=hotelContact" novalidate>
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <label for="acc_name" class="form-label">Nombre del alojamiento</label>
                                        <input type="text" id="acc_name" class="form-control" name="contactInfo[acc_name]" placeholder="...">
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="acc_address" class="form-label">Dirección del alojamiento</label>
                                        <input type="text" id="acc_address" class="form-control" name="contactInfo[acc_address]" placeholder="...">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="acc_type" class="form-label">Tipo de alojamiento</label>
                                        <select id="acc_type" class="form-control" name="contactInfo[acc_type]">
                                            <option value="" disabled selected>Seleccione un tipo</option>
                                            <option value="hotel">Hotel</option>
                                            <option value="apartment">Apartamento</option>
                                            <option value="hostel">Hostal</option>
                                            <option value="cabin">Casa de campo</option>
                                            <option value="villa">Villa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="acc_city" class="form-label">Ciudad</label>
                                        <select id="acc_city" class="form-control" name="contactInfo[acc_city]">
                                            <option value="" disabled selected>Seleccione una ciudad</option>
                                            <?php foreach ($cities as $city): ?>
                                                <option value="<?= htmlspecialchars($city['name']) ?>"><?= htmlspecialchars($city['name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="user_name" class="form-label">Nombre de contacto</label>
                                        <input type="text" id="user_name" class="form-control" name="contactInfo[user_name]" placeholder="...">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="user_phone" class="form-label">Teléfono</label>
                                        <input type="tel" id="user_phone" class="form-control" name="contactInfo[user_phone]" placeholder="...">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="user_email" class="form-label">Email</label>
                                        <input type="text" id="user_email" class="form-control" name="contactInfo[user_email]" placeholder="..." >
                                    </div>
                                    <!-- Checkbox de términos y condiciones -->
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" id="register-terms" required>
                                        <label class="form-check-label" for="register-terms">
                                            Acepto los <a href="index.php?action=terms" class="text-decoration-none" target="_blank" rel="noopener">términos y condiciones</a>
                                        </label>
                                    </div>
                                    
                                    <!-- Captcha -->
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Verificación de seguridad</label>
                                        <div id="captcha-hotelview" class="g-recaptcha" data-sitekey="6LcuAkorAAAAACzD_oJr47YDmt7wb-37VOX4WMHp"></div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-2">Enviar</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
    

    <!-- Proceso de registro -->
    <div class="container my-5 py-5 bg-light">
        <div class="row mb-4 text-center">
            <div class="col-12">
                <h2>¿Cómo funciona el proceso?</h2>
                <p class="lead">Registrar tu alojamiento es rápido y sencillo</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 50px; height: 50px;">1</div>
                        <h5 class="card-title">Registro</h5>
                        <p class="card-text">Completa el formulario con los datos de tu alojamiento y contacto</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 50px; height: 50px;">2</div>
                        <h5 class="card-title">Verificación</h5>
                        <p class="card-text">Un asesor se pondrá en contacto contigo para verificar los datos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 50px; height: 50px;">3</div>
                        <h5 class="card-title">Configuración</h5>
                        <p class="card-text">Nuestro equipo configura tus habitaciones, servicios, fotos y precios por ti</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 50px; height: 50px;">4</div>
                        <h5 class="card-title">¡Listo!</h5>
                        <p class="card-text">Tu alojamiento aparece en nuestras búsquedas y empieza a recibir reservas</p>
                    </div>
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="index.php?action=hotelviewJs"></script>

    <!-- Modal para mostrar errores -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Mensaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="errorModalBody">
                    <!-- El mensaje se insertará aquí dinámicamente -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>