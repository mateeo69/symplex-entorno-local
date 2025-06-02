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
    <title>Symplex - Términos y Condiciones</title>
    <link rel="icon" type="image/png" href="assets/img/logoS.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .section-header {
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .terms-content {
            line-height: 1.7;
        }
        .terms-list {
            margin-left: 1rem;
        }
    </style>
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
            <div class="col-lg-10 mx-auto text-center">
                <h1 class="display-4 fw-bold">Términos y Condiciones</h1>
                <p class="lead mb-4">Condiciones de uso de la plataforma Symplex</p>
                <p class="text-muted">Última actualización: 26/05/2025</p>
                <hr class="my-4">
            </div>
        </div>
    </div>

    <!-- Contenido de términos y condiciones -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow">
                    <div class="card-body p-5 terms-content">
                        
                        <h3 class="section-header">1. Aceptación de los Términos</h3>
                        <p>Al acceder y utilizar la plataforma Symplex, usted acepta cumplir con estos términos y condiciones. Si no está de acuerdo con alguna parte de estos términos, no debe utilizar nuestros servicios.</p>

                        <h3 class="section-header">2. Descripción del Servicio</h3>
                        <p>Symplex es una plataforma digital que facilita la búsqueda, comparación y reserva de alojamientos turísticos. Actuamos como intermediarios entre huéspedes y propietarios de alojamientos.</p>

                        <h3 class="section-header">3. Registro de Usuario</h3>
                        <p>Para utilizar nuestros servicios, debe:</p>
                        <ul class="terms-list">
                            <li>Ser mayor de 18 años o contar con la supervisión de un adulto</li>
                            <li>Proporcionar información veraz y actualizada</li>
                            <li>Mantener la confidencialidad de sus credenciales de acceso</li>
                            <li>Notificar inmediatamente cualquier uso no autorizado de su cuenta</li>
                        </ul>

                        <h3 class="section-header">4. Reservas y Pagos</h3>
                        <p><strong>Proceso de reserva:</strong></p>
                        <ul class="terms-list">
                            <li>Las reservas se confirman mediante el pago correspondiente</li>
                            <li>Los precios mostrados incluyen todos los impuestos aplicables</li>
                            <li>Las condiciones específicas de cada alojamiento prevalecen sobre estos términos generales</li>
                        </ul>
                        
                        <p><strong>Política de pagos:</strong></p>
                        <ul class="terms-list">
                            <li>Aceptamos las principales tarjetas de crédito y débito</li>
                            <li>Los pagos se procesan de forma segura a través de proveedores certificados</li>
                            <li>Symplex puede cobrar comisiones por sus servicios</li>
                        </ul>

                        <h3 class="section-header">5. Cancelaciones y Modificaciones</h3>
                        <p>Las políticas de cancelación varían según el alojamiento seleccionado:</p>
                        <ul class="terms-list">
                            <li><strong>Cancelación gratuita:</strong> Según las condiciones específicas de cada propiedad</li>
                            <li><strong>Cancelación con penalización:</strong> Se aplicarán los cargos especificados en la reserva</li>
                            <li><strong>Modificaciones:</strong> Sujetas a disponibilidad y políticas del alojamiento</li>
                        </ul>

                        <h3 class="section-header">6. Responsabilidades del Usuario</h3>
                        <p>Como usuario de Symplex, usted se compromete a:</p>
                        <ul class="terms-list">
                            <li>Utilizar la plataforma de manera responsable y legal</li>
                            <li>Respetar las normas y políticas de cada alojamiento</li>
                            <li>Proporcionar información veraz en sus reservas</li>
                            <li>No utilizar la plataforma para actividades fraudulentas o ilegales</li>
                            <li>Tratar con respeto las propiedades y a otros usuarios</li>
                        </ul>

                        <h3 class="section-header">7. Responsabilidades de Symplex</h3>
                        <p>Symplex se compromete a:</p>
                        <ul class="terms-list">
                            <li>Proporcionar una plataforma funcional y segura</li>
                            <li>Facilitar la comunicación entre huéspedes y propietarios</li>
                            <li>Procesar los pagos de manera segura</li>
                            <li>Brindar soporte al cliente dentro de nuestras posibilidades</li>
                        </ul>

                        <p><strong>Limitaciones de responsabilidad:</strong></p>
                        <ul class="terms-list">
                            <li>Symplex no es propietaria de los alojamientos listados</li>
                            <li>No garantizamos la exactitud de toda la información proporcionada por terceros</li>
                            <li>La responsabilidad por la calidad del alojamiento recae en el propietario</li>
                        </ul>

                        <h3 class="section-header">8. Propiedad Intelectual</h3>
                        <p>Todo el contenido de la plataforma Symplex, incluyendo diseño, logotipos, textos y funcionalidades, está protegido por derechos de autor y otras leyes de propiedad intelectual.</p>

                        <h3 class="section-header">9. Privacidad y Protección de Datos</h3>
                        <p>El tratamiento de sus datos personales se rige por nuestra <a href="index.php?action=privacy" class="text-decoration-none">Política de Privacidad</a>, que forma parte integral de estos términos.</p>

                        <h3 class="section-header">10. Modificaciones de los Términos</h3>
                        <p>Symplex se reserva el derecho de modificar estos términos en cualquier momento. Las modificaciones entrarán en vigor inmediatamente después de su publicación en la plataforma.</p>

                        <h3 class="section-header">11. Terminación del Servicio</h3>
                        <p>Symplex puede suspender o terminar su acceso a la plataforma en caso de incumplimiento de estos términos, sin previo aviso y sin responsabilidad hacia el usuario.</p>

                        <h3 class="section-header">12. Resolución de Disputas</h3>
                        <p>En caso de controversias, las partes intentarán resolverlas de manera amigable. Si no es posible, se someterán a la jurisdicción de los tribunales de Málaga, España.</p>

                        <h3 class="section-header">13. Ley Aplicable</h3>
                        <p>Estos términos se rigen por la legislación española y europea aplicable, incluyendo las normativas de protección al consumidor y comercio electrónico.</p>

                        <h3 class="section-header">14. Contacto</h3>
                        <p>Para cualquier consulta sobre estos términos y condiciones, puede contactarnos:</p>
                        <ul class="terms-list">
                            <li><strong>Email:</strong> <a href="mailto:legal@symplex.com">legal@symplex.com</a></li>
                            <li><strong>Teléfono:</strong> +34 912 345 678</li>
                            <li><strong>Dirección:</strong> Málaga, España</li>
                        </ul>

                        <div class="alert alert-info mt-4">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <strong>Nota importante:</strong> Estos términos y condiciones son efectivos a partir de la fecha indicada arriba. Le recomendamos revisarlos periódicamente para estar al tanto de cualquier actualización.
                        </div>
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
</body>
</html>