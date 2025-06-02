<?php

require_once '../core/Database.php';

class Room extends Database {

    // --- Validation Helpers ---
    private function validateId($id, $field = "ID") {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid $field.");
        }
    }

    private function validateString($field, $value, $maxLength = 100) {
        $value = trim($value);
        if (empty($value)) {
            throw new Exception("$field is required.");
        }
        if (strlen($value) > $maxLength) {
            throw new Exception("$field must be under $maxLength characters.");
        }
        return $value;
    }

    private function validateCapacity($capacity) {
        if (!is_numeric($capacity) || $capacity <= 0) {
            throw new Exception("Capacity must be a positive number.");
        }
        return (int)$capacity;
    }

    private function validatePrice($price) {
        if (!is_numeric($price) || $price < 0) {
            throw new Exception("Price must be a non-negative number.");
        }
        return (float)$price;
    }

    private function validateRoomType($type) {
        $validTypes = ['single', 'double', 'family', 'suite'];
        $type = strtolower(trim($type));
        if (!in_array($type, $validTypes)) {
            throw new Exception("Invalid accommodation type.");
        }
        return $type;
    }

    private function getAccommodationIdByName($name) {
        $name = $this->validateString("Accommodation name", $name, 100);
        $acc_stmt = $this->query("SELECT accommodation_id FROM accommodations WHERE name = ?", [$name]);
        $acc = $acc_stmt->fetch(PDO::FETCH_ASSOC);
        if (!$acc) {
            throw new Exception("Accommodation not found.");
        }
        return $acc['accommodation_id'];
    }

    // --- Core Methods ---
    public function getAll() {
        try {
            $stmt = $this->query("SELECT * FROM rooms");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve rooms: " . $e->getMessage());
        }
    }

    public function getById($id) {
        $this->validateId($id, "Room ID");

        try {
            $stmt = $this->query("SELECT * FROM rooms WHERE room_id = ?", [$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve room: " . $e->getMessage());
        }
    }

    public function create($accommodation_name, $room_type, $capacity, $price) {
        $room_type = $this->validateRoomType($room_type);
        $capacity = $this->validateCapacity($capacity);
        $price = $this->validatePrice($price);
        $accommodation_id = $this->getAccommodationIdByName($accommodation_name);

        // Optional: prevent duplicate room types in the same accommodation
        $existing = $this->query(
            "SELECT * FROM rooms WHERE accommodation_id = ? AND room_type = ?", 
            [$accommodation_id, $room_type]
        )->fetch();
        if ($existing) {
            throw new Exception("Room type already exists in this accommodation.");
        }

        try {
            $stmt = $this->query(
                "INSERT INTO rooms (accommodation_id, room_type, capacity, price) 
                 VALUES (?, ?, ?, ?)", 
                [$accommodation_id, $room_type, $capacity, $price]
            );
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to create room: " . $e->getMessage());
        }
    }

    public function update($id, $accommodation_name, $room_type, $capacity, $price) {
        $this->validateId($id, "Room ID");
        $room_type = $this->validateRoomType($room_type);
        $capacity = $this->validateCapacity($capacity);
        $price = $this->validatePrice($price);
        $accommodation_id = $this->getAccommodationIdByName($accommodation_name);

        try {
            $stmt = $this->query(
                "UPDATE rooms 
                 SET accommodation_id = ?, room_type = ?, capacity = ?, price = ? 
                 WHERE room_id = ?", 
                [$accommodation_id, $room_type, $capacity, $price, $id]
            );
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to update room: " . $e->getMessage());
        }
    }

    public function delete($id) {
        $this->validateId($id, "Room ID");

        try {
            $stmt = $this->query("DELETE FROM rooms WHERE room_id = ?", [$id]);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to delete room: " . $e->getMessage());
        }
    }
}
?>
