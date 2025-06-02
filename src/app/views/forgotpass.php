<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Show success or error message modals (optional)
    $showSuccessModal = isset($_GET['success']) && $_GET['success'] === 'EmailSent';
    $showErrorModal = isset($_GET['error']) && $_GET['error'] === 'UserNotFound';
    $errorSendingEmail = isset($_GET['error']) && $_GET['error'] === 'EmailSendFailed';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="assets/img/logoS.png" />
    <title>Symplex - Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    ?>
</head>
<body class="bg-light">

<div class="nav-buttons">
    <div class="container d-flex justify-content-between align-items-center">
        <button onclick="location.href='index.php?action=login'" class="btn btn-outline-primary">Iniciar sesión</button>
        <div class="brand-center">
            <a href="index.php?action=home">
                <img src="assets/img/nuevologoSymplex.png" alt="Logo Symplex" class="logo-img" />
            </a>
        </div>
        <button onclick="location.href='index.php?action=register'" class="btn btn-outline-primary">Regístrate aquí</button>
    </div>
</div>

<div class="container">
    <div class="auth-container mt-4">
        <div id="forgotPassForm" class="form-container active">
            <h2 class="mb-4">Recuperar contraseña</h2>
            <p>Ingresa tu correo electrónico para recibir instrucciones para restablecer tu contraseña.</p>
            <form method="POST" action="index.php?action=forgotpass">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required />
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Cambiar contraseña</button>
            </form>
            <div class="mt-3 text-center">
                <a href="index.php?action=login" class="text-decoration-none">&larr; Volver a iniciar sesión</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Modal para mensajes -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="messageModalBody">
                <!-- Mensaje dinámico -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php if ($showSuccessModal): ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('messageModalBody').textContent = 'Se enviaron las instrucciones a tu correo electrónico.';
        new bootstrap.Modal(document.getElementById('messageModal')).show();
    });
</script>
<?php endif; ?>

<?php if ($showErrorModal): ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('messageModalBody').textContent = 'No se encontró ningún usuario con ese correo.';
        new bootstrap.Modal(document.getElementById('messageModal')).show();
    });
</script>
<?php endif; ?>

<?php if ($showErrorModal && $showErrorModal === "EmailSendFailed"): ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('messageModalBody').textContent = 'Error al enviar el correo, por favor intenta más tarde.';
        new bootstrap.Modal(document.getElementById('messageModal')).show();
    });
</script>
<?php endif; ?>

</body>
</html
