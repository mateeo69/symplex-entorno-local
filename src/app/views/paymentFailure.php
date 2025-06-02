<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Payment Failed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<div class="container py-5 text-center">
    <div class="alert alert-danger">
        <h4>Payment Failed</h4>
        <p><?= htmlspecialchars($_SESSION['payment_error'] ?? 'An unknown error occurred.'); ?></p>
    </div>
    <a href="index.php?action=paymentForm" class="btn btn-outline-primary">Try Again</a>
</div>

</body>
</html>
<?php unset($_SESSION['payment_error']); ?>
