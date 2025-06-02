<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Verificar si hay un error en la URL
    $showErrorModal = isset($_GET['error']) && $_GET['error'] === 'UserError';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/img/logoS.png">
    <title>Symplex - Acceso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>   
    <script src="index.php?action=registerJs"></script>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    ?>
</head>
<body class="bg-light">

<div class="nav-buttons">
    <div class="container d-flex justify-content-between align-items-center">
        <button id="loginBtn" class="btn btn-outline-primary">Iniciar sesión</button>
        <div class="brand-center">
            <a href="index.php?action=home">
                <img src="assets/img/nuevologoSymplex.png" alt="Logo Symplex" class="logo-img">
            </a>
        </div>
        <button id="registerBtn" class="btn btn-outline-primary">Regístrate aquí</button>
    </div>
</div>

<div class="container">
    <div class="auth-container mt-4">
        <div id="loginForm" class="form-container active">
            <h2 class="mb-4">Iniciar sesión</h2>
            <form method="POST" action="index.php?action=login">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label" for="remember">Recordar sesión</label>
                    </div>
                    <a href="index.php?action=forgotpass" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="mb-3">
                    <div id="captcha-login" class="g-recaptcha"></div>
                </div>                
                <!-- Checkbox de términos y condiciones -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="login-terms">
                    <label class="form-check-label" for="login-terms">
                        Acepto los <a href="index.php?action=terms" class="text-decoration-none">términos y condiciones</a>
                    </label>
                </div>
                <button type="submit" id="login-submit" class="btn btn-primary w-100 py-2">Acceder</button>
            </form>
        </div>

        <div id="registerForm" class="form-container">
            <h2 class="mb-4">Crea tu cuenta</h2>
            <form method="POST" action="index.php?action=register">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastname" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="lastname" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="reg-email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="reg-email" required>
                </div>
                <div class="mb-3">
                    <label for="reg-email" class="form-label">Teléfono</label>
                    <input type="email" class="form-control" id="reg-phone" required>
                </div>
                <div class="mb-3">
                    <label for="reg-email" class="form-label">Localidad</label>
                    <input type="email" class="form-control" id="reg-city" required>
                </div>
                <div class="mb-3">
                    <label for="reg-password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="reg-password" required>
                </div>
                <div class="mb-4">
                    <label for="confirm-password" class="form-label">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="confirm-password" required>
                </div>
                <div class="mb-3">
                    <div id="captcha-register" class="g-recaptcha"></div>                
                </div>
                <!-- Checkbox de términos y condiciones -->
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="register-terms">
                    <label class="form-check-label" for="register-terms">
                        Acepto los <a href="index.php?action=terms" class="text-decoration-none" target="_blank" rel="noopener">términos y condiciones</a>
                    </label>
                </div> 
                <button type="submit" id="register-submit" class="btn btn-primary w-100 py-2">Registrarse</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Modal para mensajes de error -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="errorModalBody">
                <!-- El mensaje de error se insertará aquí dinámicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php if ($showErrorModal): ?>
<script>
    // Cuando el documento esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Establecer el mensaje de error
        document.getElementById('errorModalBody').textContent = 'Usuario o contraseña incorrecta';
        
        // Mostrar el modal automáticamente
        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    });
</script>
<?php endif; ?>

</body>
</html>
