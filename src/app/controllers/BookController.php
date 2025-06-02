<?php

require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Accommodation.php';

class BookController {
    public function create() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); 
        }

        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Debes iniciar sesión para realizar una reserva.";
            header('Location: index.php?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $bookingModel = new Booking();
                $accommodationModel = new Accommodation();

                // Obtener datos del formulario
                $user_email = $_SESSION['user']['email'];
                $check_in = $_POST['check_in'] ?? '';
                $check_out = $_POST['check_out'] ?? '';
                $people = $_POST['people'] ?? 1;
                $accommodation_id = $_POST['accommodation_id'] ?? null;
                $room_type = $_POST['room_type'];

                // Obtener nombre del alojamiento y tipo de habitación (simplificamos: 1 tipo)
                $accommodation = $accommodationModel->getById($accommodation_id);

                if (!$accommodation) {
                    throw new Exception("Alojamiento no encontrado.");
                }

                $room_id = $accommodationModel->getAccRoom($accommodation_id, $room_type);

                $accommodation_name = $accommodation['name'];

                // Fecha de reserva y estado por defecto
                $booking_date = date('Y-m-d');
                $booking_status = 'pending';

                // Crear reserva
                $bookingModel->create(
                    $user_email,
                    $accommodation_name,
                    $room_type,
                    $check_in,
                    $check_out,
                    $booking_date,
                    $booking_status,
                    $room_id
                );

                $_SESSION['success'] = "Reserva realizada con éxito.";
                header("Location: index.php?action=bookings");
                exit;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                $_SESSION['error'] = "Error al hacer la reserva: " . $e->getMessage();
                header("Location: index.php?action=show-accommodation&id=" . urlencode($accommodation_id));
                exit;
            }
        } else {
            header('Location: index.php');
            exit;
        }
    }
}
