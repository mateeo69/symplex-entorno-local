<?php
// PaymentController.php

class PaymentController {
    public function processPayment() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            exit;
        }

        header('Content-Type: application/json');

        require '../vendor/autoload.php';

        $stripeSecret = getenv('STRIPE_SECRET_KEY');
        if (!$stripeSecret) {
            http_response_code(500);
            echo "Stripe secret key not set in environment.";
            exit;
        }

        \Stripe\Stripe::setApiKey($stripeSecret);

        $amount = intval($_POST['amount']) * 100;

        $paymentMethods = ['card'];
        if (isset($isLiveMode) && $isLiveMode) {
            $paymentMethods[] = 'bizum';
        }

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'eur',
                'payment_method_types' => $paymentMethods,
            ]);

            echo json_encode([
                'success' => true,
                'message' => 'Pago realizado con éxito'
            ]);
            exit;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'El pago ha fallado: ' . $e->getMessage()
            ]);
            exit;
        }
    }
}
