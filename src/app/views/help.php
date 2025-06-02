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
    <title>Symplex - Ayuda</title>
    <link rel="icon" type="image/png" href="assets/img/logoS.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="index.php?action=helpJs"></script>
</head>
<body class="bg-light">
    <!-- Navegación simplificada -->
    <nav class="navbar navbar-light bg-white shadow-sm justify-content-center">
        <a class="navbar-brand mx-auto d-flex align-items-center" href="index.php?action=home">
            <img src="assets/img/nuevologoSymplex.png" alt="Logo Symplex" class="logo-img" style="max-height: 60px;">
        </a>
    </nav>

    <!-- Encabezado -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold">Centro de Ayuda</h1>
                <p class="lead mb-4">Encuentra respuestas a tus preguntas y soluciona tus dudas</p>
                <hr class="my-4">
            </div>
        </div>
    </div>

    <!-- Preguntas frecuentes -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq1-heading">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                ¿Cómo puedo crear una cuenta en Symplex?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="faq1-heading" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Haz clic en "Registrarse" en la parte superior derecha y completa el formulario con tus datos.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq2-heading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                ¿Cómo reservo un alojamiento?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faq2-heading" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Busca tu destino, selecciona las fechas y el número de personas, elige el alojamiento que más te guste y sigue los pasos para completar la reserva.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq3-heading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                ¿Puedo cancelar o modificar mi reserva?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faq3-heading" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sí, puedes cancelar o modificar tu reserva desde tu perfil, en la sección "Mis reservas". Ten en cuenta las condiciones de cancelación de cada alojamiento.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq4-heading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                ¿Cómo contacto con el soporte de Symplex?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faq4-heading" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Puedes escribirnos a <a href="mailto:info@symplex.com">info@symplex.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq5-heading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">
                                ¿Qué hago si tengo un problema con mi alojamiento?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" aria-labelledby="faq5-heading" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Contacta primero con el propietario desde la sección de tu reserva. Si no se resuelve, ponte en contacto con nuestro soporte y te ayudaremos lo antes posible.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contacto -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3"><i class="bi bi-envelope-fill me-2"></i>¿No encuentras lo que buscas?</h5>
                        <form action="index.php?action=sendHelp" method="POST">
                            <div class="mb-3">
                                <label for="helpEmail" class="form-label">Correo electrónico</label>
                                <input type="text" class="form-control" id="helpEmail" name="helpEmail" placeholder="tu@email.com">
                            </div>
                            <div class="mb-3">
                                <label for="helpMessage" class="form-label">Tu consulta</label>
                                <textarea class="form-control" id="helpMessage" name="helpMessage" rows="4" placeholder="Escribe tu pregunta o problema aquí..." ></textarea>
                            </div>
                            <!-- Checkbox de términos y condiciones -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="register-terms">
                                <label class="form-check-label" for="register-terms">
                                    Acepto los <a href="index.php?action=terms" class="text-decoration-none" target="_blank" rel="noopener">términos y condiciones</a>
                                </label>
                            </div>
                            <!-- Captcha -->
                            <div class="mb-3">
                                <label class="form-label">Verificación de seguridad</label>
                                <div id="captcha-help" class="g-recaptcha" data-sitekey="6LeZG0orAAAAAEYwrDvv4Vca6Ntl_jPHajVYUvgB"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar consulta</button>
                        </form>
                        <p class="mt-3 mb-0 text-muted" style="font-size: 0.95rem;">Te responderemos lo antes posible a tu correo.</p>
                    </div>
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
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>