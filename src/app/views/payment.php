<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Stripe Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-5">
    <div class="container">
        <a class="navbar-brand" href="#">Symplex</a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-4 text-center">Pago test (sin cargos reales)</h3>

                    <?php if (!empty($_SESSION['payment_error'])): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($_SESSION['payment_error']); ?>
                        </div>
                        <?php unset($_SESSION['payment_error']); ?>
                    <?php endif; ?>

                    <form action="index.php?action=payment" method="POST" novalidate>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount (€)</label>
                            <input type="number" class="form-control" id="amount" name="amount" min="1" value="" required readonly/>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Pay with Stripe
                        </button>
                    </form>

                    <p class="mt-3 text-muted text-center small">
                        Use card number <strong>4242 4242 4242 4242</strong> with any future expiry and CVC.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center mt-5 mb-3 text-muted small">
    &copy; <?= date('Y') ?> Symplex. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
</body>
</html>
