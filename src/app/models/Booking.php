<?php

require_once '../core/Database.php';

class Booking extends Database {

    private function validateDate($date, $fieldName) {
        if (!strtotime($date)) {
            throw new Exception("Invalid date format for $fieldName.");
        }
    }

    private function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
    }

    private function validateDatesLogic($check_in, $check_out) {
        if (strtotime($check_in) > strtotime($check_out)) {
            throw new Exception("Check-out date must be after check-in date.");
        }
    }

    private function validateBookingStatus($status) {
        $validStatus = ['pending', 'confirmed', 'completed', 'cancelled'];
        $status = strtolower(trim($status));
        if (!in_array($status, $validStatus)) {
            throw new Exception("Invalid booking status.");
        }
        return $status;
    }

    public function getAll() {
        try {
            $stmt = $this->query("SELECT * FROM bookings");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve bookings: " . $e->getMessage());
        }
    }

    public function getById($id) {
        error_log('Booking::getById llamado con id: ' . $id);
        
        if (!is_numeric($id) || $id <= 0) {
            error_log('ID de reserva inválido: ' . $id);
            throw new Exception("Invalid booking ID.");
        }

        try {
            $query = "SELECT * FROM bookings WHERE booking_id = ?";
            error_log('Ejecutando query: ' . $query . ' con parámetro: ' . $id);
            
            $stmt = $this->query($query, [$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            error_log('Resultado de la consulta: ' . ($result ? json_encode($result) : 'No se encontró la reserva'));
            return $result;
        } catch (Exception $e) {
            error_log('Error al obtener la reserva: ' . $e->getMessage());
            throw new Exception("Failed to retrieve booking: " . $e->getMessage());
        }
    }

    public function create($user_email, $accommodation_name, $room_type, $check_in, $check_out, $booking_date, $booking_status, $room_id) {
        $this->validateEmail($user_email);
        $this->validateDate($check_in, "check-in");
        $this->validateDate($check_out, "check-out");
        $this->validateDate($booking_date, "booking date");
        $this->validateDatesLogic($check_in, $check_out);
        $this->validateBookingStatus($booking_status);

        try {
            // Find user_id
            $user_stmt = $this->query("SELECT user_id FROM users WHERE email = ?", [$user_email]);
            $user = $user_stmt->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                throw new Exception("User not found.");
            }
            $user_id = $user['user_id'];

            // Insert booking
            $stmt = $this->query(
                "INSERT INTO bookings (user_id, room_id, check_in, check_out, booking_date, status) 
                VALUES (?, ?, ?, ?, ?, ?)", 
                [$user_id, $room_id, $check_in, $check_out, $booking_date, $booking_status]
            );

            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to create booking: " . $e->getMessage());
        }
    }

    public function update($id, $user_email, $accommodation_name, $room_type, $check_in, $check_out, $booking_date) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid booking ID.");
        }

        $this->validateEmail($user_email);
        $this->validateDate($check_in, "check-in");
        $this->validateDate($check_out, "check-out");
        $this->validateDate($booking_date, "booking date");
        $this->validateDatesLogic($check_in, $check_out);

        try {
            $user_stmt = $this->query("SELECT user_id FROM users WHERE email = ?", [$user_email]);
            $user = $user_stmt->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                throw new Exception("User not found.");
            }
            $user_id = $user['user_id'];

            $room_stmt = $this->query("
                SELECT r.room_id 
                FROM rooms r 
                JOIN accommodations a ON r.accommodation_id = a.accommodation_id 
                WHERE a.name = ? AND r.room_type = ?", 
                [$accommodation_name, $room_type]
            );
            $room = $room_stmt->fetch(PDO::FETCH_ASSOC);
            if (!$room) {
                throw new Exception("Room not found.");
            }
            $room_id = $room['room_id'];

            // Update booking
            $stmt = $this->query(
                "UPDATE bookings 
                 SET user_id = ?, room_id = ?, check_in = ?, check_out = ?, booking_date = ? 
                 WHERE booking_id = ?", 
                [$user_id, $room_id, $check_in, $check_out, $booking_date, $id]
            );

            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to update booking: " . $e->getMessage());
        }
    }

    public function delete($id) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid booking ID.");
        }

        try {
            $stmt = $this->query("DELETE FROM bookings WHERE booking_id = ?", [$id]);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to delete booking: " . $e->getMessage());
        }
    }
    
    // El método validateBookingStatus ya está definido en la línea 24
    
    public function updateStatus($id, $status) {
        error_log('Booking::updateStatus llamado con id: ' . $id . ', status: ' . $status);
        
        if (!is_numeric($id)) {
            error_log('ID de reserva inválido: ' . $id);
            throw new Exception("Invalid booking ID.");
        }
        
        try {
            $status = $this->validateBookingStatus($status);
            error_log('Estado validado: ' . $status);
            
            $query = "UPDATE bookings SET status = ? WHERE booking_id = ?";
            error_log('Ejecutando query: ' . $query . ' con parámetros: ' . $status . ', ' . $id);
            
            $stmt = $this->query($query, [$status, $id]);
            $rowCount = $stmt->rowCount();
            
            error_log('Filas afectadas: ' . $rowCount);
            
            // Si no se actualizó ninguna fila, verificar si la reserva existe y su estado actual
            if ($rowCount == 0) {
                $checkStmt = $this->query("SELECT status FROM bookings WHERE booking_id = ?", [$id]);
                $currentBooking = $checkStmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$currentBooking) {
                    error_log('La reserva con ID ' . $id . ' no existe');
                } else {
                    error_log('La reserva con ID ' . $id . ' tiene estado: ' . $currentBooking['status']);
                    if ($currentBooking['status'] === $status) {
                        error_log('No se actualizó porque ya tiene el estado solicitado: ' . $status);
                        return true; // Consideramos éxito si ya tiene el estado deseado
                    }
                }
            }
            
            return $rowCount > 0;
        } catch (Exception $e) {
            error_log('Error al actualizar el estado de la reserva: ' . $e->getMessage());
            throw new Exception("Failed to update booking status: " . $e->getMessage());
        }
    }

    public function search(array $filters, $order) {
        require_once 'User.php';
        $userModel = new User();
        $user_id = $userModel->getByEmail($filters['user_email'])['user_id'];
        // Optional filters
        // $status = $this->validateBookingStatus($filters['status']);
        $status = $filters['status'] ?? null;
        $fromDate = $filters['check_in'] ?? null;
        $toDate = $filters['check_out'] ?? null;
        // $order: 'upcoming' = soonest first, 'past' = most recent first

        $params = [$user_id];
        $query = "
            SELECT 
                b.booking_id,
                b.user_id,
                b.room_id,
                b.check_in,
                b.check_out,
                b.booking_date,
                a.accommodation_id,
                a.name AS accommodation_name,
                a.image_url,
                c.name AS city_name,
                c.country,
                r.capacity,
                r.room_type,
                r.price,
                b.status
            FROM bookings b
            JOIN rooms r ON b.room_id = r.room_id
            JOIN accommodations a ON r.accommodation_id = a.accommodation_id
            JOIN cities c ON a.city_id = c.city_id
            WHERE b.user_id = ?
        ";

        if ($status !== null && strtolower($status) !== 'all') {
            $query .= " AND b.status = ?";
            $params[] = $status;
        }

        if ($fromDate !== null) {
            $this->validateDate($fromDate, "from date");
            $query .= " AND b.check_in >= ?";
            $params[] = $fromDate;
        }

        if ($toDate !== null) {
            $this->validateDate($toDate, "to date");
            $query .= " AND b.check_out <= ?";
            $params[] = $toDate;
        }

        if ($order === 'past') {
            $query .= " ORDER BY b.check_in DESC";
        } else {
            $query .= " ORDER BY b.check_in ASC";
        }

        $stmt = $this->query($query, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingsByOwner(int $owner_id, ?string $start_date = null, ?string $end_date = null, bool $pending_only = false): array
    {
        $stmt = $this->query("SELECT accommodation_id FROM accommodations WHERE owner_id = ?", [$owner_id]);
        $accommodation_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (empty($accommodation_ids)) {
            return [];
        }

        $all_bookings = [];

        foreach ($accommodation_ids as $accommodation_id) {
            if ($pending_only) {
                $sql = "
                    SELECT b.*, r.room_type, r.capacity, u.first_name, u.last_name, u.email, u.phone, 
                           a.name as hotel_name, a.accommodation_id, a.address
                    FROM bookings b
                    JOIN rooms r ON b.room_id = r.room_id
                    JOIN users u ON b.user_id = u.user_id
                    JOIN accommodations a ON r.accommodation_id = a.accommodation_id
                    WHERE r.accommodation_id = ?
                      AND b.status = 'pending'
                    ORDER BY b.booking_id DESC
                ";
                $params = [$accommodation_id];

            } elseif ($start_date && $end_date) {
                $sql = "
                    SELECT b.*, r.room_type, r.capacity, u.first_name, u.last_name, u.email, u.phone, 
                           a.name as hotel_name, a.accommodation_id, a.address
                    FROM bookings b
                    JOIN rooms r ON b.room_id = r.room_id
                    JOIN users u ON b.user_id = u.user_id
                    JOIN accommodations a ON r.accommodation_id = a.accommodation_id
                    WHERE r.accommodation_id = ?
                      AND b.check_in BETWEEN ? AND ?
                    ORDER BY b.check_in ASC
                ";
                $params = [$accommodation_id, $start_date, $end_date];

            } else {
                $today = date('Y-m-d');
                $sql = "
                    SELECT b.*, r.room_type, r.capacity, u.first_name, u.last_name, u.email, u.phone, 
                           a.name as hotel_name, a.accommodation_id, a.address
                    FROM bookings b
                    JOIN rooms r ON b.room_id = r.room_id
                    JOIN users u ON b.user_id = u.user_id
                    JOIN accommodations a ON r.accommodation_id = a.accommodation_id
                    WHERE r.accommodation_id = ?
                      AND b.status = 'confirmed'
                      AND b.check_in >= ?
                    ORDER BY b.check_in ASC
                ";
                $params = [$accommodation_id, $today];
            }

            $stmt = $this->query($sql, $params);
            $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $all_bookings = array_merge($all_bookings, $bookings);
        }

        return $all_bookings;
    }

}
