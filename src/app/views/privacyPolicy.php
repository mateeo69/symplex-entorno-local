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
    <title>Symplex - Política de Privacidad</title>
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
        .privacy-content {
            line-height: 1.7;
        }
        .privacy-list {
            margin-left: 1rem;
        }
        .highlight-box {
            background-color: #e7f3ff;
            border-left: 4px solid #0d6efd;
            padding: 1rem;
            margin: 1.5rem 0;
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
                <h1 class="display-4 fw-bold">Política de Privacidad</h1>
                <p class="lead mb-4">Cómo protegemos y utilizamos tu información personal</p>
                <p class="text-muted">Última actualización: 26/05/2025</p>
                <hr class="my-4">
            </div>
        </div>
    </div>

    <!-- Contenido de política de privacidad -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow">
                    <div class="card-body p-5 privacy-content">
                        
                        <div class="highlight-box">
                            <h5><i class="bi bi-shield-check text-primary me-2"></i>Compromiso con tu privacidad</h5>
                            <p class="mb-0">En Symplex, respetamos tu privacidad y nos comprometemos a proteger tus datos personales. Esta política explica cómo recopilamos, utilizamos y protegemos tu información cuando utilizas nuestros servicios.</p>
                        </div>

                        <h3 class="section-header">1. Responsable del Tratamiento</h3>
                        <p><strong>Symplex</strong> es el responsable del tratamiento de tus datos personales.</p>
                        <ul class="privacy-list">
                            <li><strong>Denominación social:</strong> Symplex S.L.</li>
                            <li><strong>Dirección:</strong> Málaga, España</li>
                            <li><strong>Email de contacto:</strong> <a href="mailto:privacidad@symplex.com">privacidad@symplex.com</a></li>
                            <li><strong>Delegado de Protección de Datos:</strong> <a href="mailto:dpo@symplex.com">dpo@symplex.com</a></li>
                        </ul>

                        <h3 class="section-header">2. Información que Recopilamos</h3>
                        
                        <p><strong>Datos que nos proporcionas directamente:</strong></p>
                        <ul class="privacy-list">
                            <li>Información de registro (nombre, email, teléfono)</li>
                            <li>Datos de identificación para verificación</li>
                            <li>Información de pago (procesada por terceros seguros)</li>
                            <li>Preferencias de alojamiento y viaje</li>
                            <li>Comunicaciones contigo (consultas, reviews, soporte)</li>
                        </ul>

                        <p><strong>Datos que recopilamos automáticamente:</strong></p>
                        <ul class="privacy-list">
                            <li>Información de navegación (IP, navegador, dispositivo)</li>
                            <li>Cookies y tecnologías similares</li>
                            <li>Patrones de uso de la plataforma</li>
                            <li>Datos de geolocalización (con tu consentimiento)</li>
                        </ul>

                        <h3 class="section-header">3. Cómo Utilizamos tu Información</h3>
                        
                        <p>Utilizamos tus datos personales para:</p>
                        
                        <p><strong>Prestación del servicio:</strong></p>
                        <ul class="privacy-list">
                            <li>Gestionar tu cuenta de usuario</li>
                            <li>Procesar reservas y pagos</li>
                            <li>Facilitar la comunicación con propietarios</li>
                            <li>Proporcionar soporte al cliente</li>
                        </ul>

                        <p><strong>Mejora y personalización:</strong></p>
                        <ul class="privacy-list">
                            <li>Personalizar tu experiencia en la plataforma</li>
                            <li>Mostrarte ofertas relevantes</li>
                            <li>Mejorar nuestros servicios</li>
                            <li>Realizar análisis estadísticos</li>
                        </ul>

                        <p><strong>Comunicación:</strong></p>
                        <ul class="privacy-list">
                            <li>Enviarte confirmaciones de reserva</li>
                            <li>Notificaciones importantes del servicio</li>
                            <li>Marketing directo (con tu consentimiento)</li>
                            <li>Encuestas de satisfacción</li>
                        </ul>

                        <h3 class="section-header">4. Base Legal del Tratamiento</h3>
                        <p>Tratamos tus datos personales basándonos en:</p>
                        <ul class="privacy-list">
                            <li><strong>Ejecución del contrato:</strong> Para proporcionar nuestros servicios</li>
                            <li><strong>Interés legítimo:</strong> Para mejorar nuestros servicios y prevenir fraudes</li>
                            <li><strong>Consentimiento:</strong> Para marketing directo y cookies no esenciales</li>
                            <li><strong>Obligación legal:</strong> Para cumplir con requisitos fiscales y legales</li>
                        </ul>

                        <h3 class="section-header">5. Compartir tu Información</h3>
                        
                        <p>Podemos compartir tu información con:</p>
                        
                        <p><strong>Socios necesarios para el servicio:</strong></p>
                        <ul class="privacy-list">
                            <li>Propietarios de alojamientos (datos necesarios para la reserva)</li>
                            <li>Procesadores de pago (datos de transacción)</li>
                            <li>Proveedores de servicios técnicos</li>
                        </ul>

                        <p><strong>Nunca vendemos tu información personal a terceros para marketing.</strong></p>

                        <div class="highlight-box">
                            <h6><i class="bi bi-exclamation-triangle text-warning me-2"></i>Divulgación por requisitos legales</h6>
                            <p class="mb-0">Podemos divulgar tu información si es requerido por ley, para proteger nuestros derechos o en caso de emergencia para proteger la seguridad personal.</p>
                        </div>

                        <h3 class="section-header">6. Seguridad de los Datos</h3>
                        <p>Implementamos medidas de seguridad técnicas y organizativas para proteger tus datos:</p>
                        <ul class="privacy-list">
                            <li>Cifrado de datos en tránsito y en reposo</li>
                            <li>Acceso restringido a datos personales</li>
                            <li>Auditorías regulares de seguridad</li>
                            <li>Formación continua del personal</li>
                            <li>Sistemas de backup y recuperación</li>
                        </ul>

                        <h3 class="section-header">7. Retención de Datos</h3>
                        <p>Conservamos tus datos personales durante:</p>
                        <ul class="privacy-list">
                            <li><strong>Cuenta activa:</strong> Mientras mantengas tu cuenta</li>
                            <li><strong>Datos de reserva:</strong> 7 años por requisitos fiscales</li>
                            <li><strong>Marketing:</strong> Hasta que retires tu consentimiento</li>
                            <li><strong>Datos técnicos:</strong> Máximo 2 años</li>
                        </ul>

                        <h3 class="section-header">8. Tus Derechos</h3>
                        <p>Bajo el RGPD, tienes derecho a:</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="privacy-list">
                                    <li><strong>Acceso:</strong> Obtener copia de tus datos</li>
                                    <li><strong>Rectificación:</strong> Corregir datos inexactos</li>
                                    <li><strong>Supresión:</strong> Eliminar tus datos</li>
                                    <li><strong>Limitación:</strong> Restringir el procesamiento</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="privacy-list">
                                    <li><strong>Portabilidad:</strong> Transferir tus datos</li>
                                    <li><strong>Oposición:</strong> Oponerte al procesamiento</li>
                                    <li><strong>Retirar consentimiento:</strong> En cualquier momento</li>
                                    <li><strong>Reclamar:</strong> Ante autoridades de protección</li>
                                </ul>
                            </div>
                        </div>

                        <p>Para ejercer estos derechos, contacta: <a href="mailto:privacidad@symplex.com">privacidad@symplex.com</a></p>

                        <h3 class="section-header">9. Cookies y Tecnologías Similares</h3>
                        <p>Utilizamos cookies para:</p>
                        <ul class="privacy-list">
                            <li><strong>Esenciales:</strong> Funcionamiento básico de la plataforma</li>
                            <li><strong>Funcionales:</strong> Recordar tus preferencias</li>
                            <li><strong>Analíticas:</strong> Entender cómo usas nuestro servicio</li>
                            <li><strong>Marketing:</strong> Personalizar anuncios (con consentimiento)</li>
                        </ul>
                        <p>Puedes gestionar las cookies desde la configuración de tu navegador.</p>

                        <h3 class="section-header">10. Transferencias Internacionales</h3>
                        <p>Algunos de nuestros proveedores pueden estar ubicados fuera del Espacio Económico Europeo. En estos casos, garantizamos protecciones adecuadas mediante:</p>
                        <ul class="privacy-list">
                            <li>Cláusulas contractuales tipo aprobadas por la UE</li>
                            <li>Certificaciones de adecuación</li>
                            <li>Otras salvaguardas legalmente reconocidas</li>
                        </ul>

                        <h3 class="section-header">11. Menores de Edad</h3>
                        <p>Nuestros servicios están dirigidos a personas mayores de 18 años. No recopilamos intencionalmente datos de menores de 16 años sin consentimiento parental verificable.</p>

                        <h3 class="section-header">12. Cambios en esta Política</h3>
                        <p>Podemos actualizar esta política de privacidad ocasionalmente. Te notificaremos cambios significativos por email o mediante aviso prominente en nuestra plataforma.</p>

                        <h3 class="section-header">13. Contacto</h3>
                        <p>Para cualquier consulta sobre privacidad o esta política:</p>
                        <ul class="privacy-list">
                            <li><strong>Email:</strong> <a href="mailto:privacidad@symplex.com">privacidad@symplex.com</a></li>
                            <li><strong>DPO:</strong> <a href="mailto:dpo@symplex.com">dpo@symplex.com</a></li>
                            <li><strong>Teléfono:</strong> +34 912 345 678</li>
                            <li><strong>Correo postal:</strong> Symplex S.L., Málaga, España</li>
                        </ul>
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