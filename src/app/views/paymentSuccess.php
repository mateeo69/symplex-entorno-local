<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Payment Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<div class="container py-5 text-center">
    <div class="alert alert-success">
        <h4>Pago realizado con éxito</h4>
        <p style="font-size: 9px;">(es solo un testeo)</p>
        <p><?= htmlspecialchars($_SESSION['payment_success'] ?? ''); ?></p>
    </div>
    <a href="index.php?action=book" class="btn btn-primary">Reservar</a>
</div>

</body>
</html>
<?php unset($_SESSION['payment_success']); ?>
