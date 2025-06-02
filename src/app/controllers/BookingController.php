<?php
require_once __DIR__ . '/../models/Booking.php';

class BookingController {
    
    public function cancelBooking() {
        // Log para depurar
        error_log('Método cancelBooking llamado');
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            error_log('Usuario no encontrado en la sesión');
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            exit;
        }
        
        // Depurar la estructura de la sesión
        error_log('Estructura de la sesión: ' . print_r($_SESSION, true));
        
        // Verificar si es una solicitud POST con los datos necesarios
        error_log('REQUEST_METHOD: ' . $_SERVER['REQUEST_METHOD']);
        error_log('POST data: ' . print_r($_POST, true));
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
            try {
                $booking_id = $_POST['booking_id'];
                
                // Verificar la estructura de user en la sesión
                if (!isset($_SESSION['user']['id']) && isset($_SESSION['user']['user_id'])) {
                    $user_id = $_SESSION['user']['user_id'];
                    error_log('Usando user_id de la sesión');
                } elseif (isset($_SESSION['user']['id'])) {
                    $user_id = $_SESSION['user']['id'];
                    error_log('Usando id de la sesión');
                } else {
                    // Intentar encontrar el ID de usuario de otra manera
                    error_log('No se encontró id o user_id en la sesión, buscando alternativas');
                    if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];
                        error_log('Usando user_id global de la sesión');
                    } else {
                        throw new Exception("No se pudo determinar el ID del usuario");
                    }
                }
                
                error_log('booking_id: ' . $booking_id);
                error_log('user_id final: ' . $user_id);
                
                // Verificar que la reserva pertenece al usuario actual
                $bookingModel = new Booking();
                $booking = $bookingModel->getById($booking_id);
                error_log('Booking encontrado: ' . ($booking ? 'SI' : 'NO'));
                
                if (!$booking || $booking['user_id'] != $user_id) {
                    throw new Exception("No tienes permiso para cancelar esta reserva");
                }
                
                // Actualizar el estado de la reserva a 'cancelled'
                error_log('Intentando actualizar estado a cancelled para booking_id: ' . $booking_id);
                $result = $bookingModel->updateStatus($booking_id, 'cancelled');
                error_log('Resultado de la actualización: ' . ($result ? 'EXITOSO' : 'FALLIDO'));
                
                if ($result) {
                    error_log('Enviando respuesta de éxito');
                    echo json_encode(['success' => true, 'message' => 'Reserva cancelada correctamente']);
                } else {
                    error_log('Enviando respuesta de error - No se actualizó ninguna fila');
                    echo json_encode(['success' => false, 'message' => 'No se pudo cancelar la reserva. La reserva puede que ya esté cancelada o no exista.']);
                }
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
        }
        
        exit;
    }
    
    public function updateStatus() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            exit;
        }
        
        // Verificar si es una solicitud POST con los datos necesarios
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id']) && isset($_POST['status'])) {
            try {
                $booking_id = $_POST['booking_id'];
                $status = $_POST['status'];
                
                // Validar el estado
                $valid_statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
                if (!in_array($status, $valid_statuses)) {
                    throw new Exception("Estado no válido");
                }
                
                // Actualizar el estado de la reserva
                $bookingModel = new Booking();
                $result = $bookingModel->updateStatus($booking_id, $status);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Estado actualizado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el estado']);
                }
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
        }
        
        exit;
    }
}
?>
