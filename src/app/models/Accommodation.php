<?php

require_once '../core/Database.php';

class Accommodation extends Database {

    // --- Validation Helpers ---
    private function validateId($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid accommodation ID.");
        }
    }

    private function validateString($field, $value, $maxLength = 255) {
        $value = trim($value);
        if (empty($value)) {
            throw new Exception("$field is required.");
        }
        if (strlen($value) > $maxLength) {
            throw new Exception("$field must be less than $maxLength characters.");
        }
        return $value;
    }    
    
    private function validateType($type) {
        $validTypes = ['hotel', 'apartment', 'hostel', 'cabin', 'villa'];
        $type = strtolower(trim($type));
        if (!in_array($type, $validTypes)) {
            throw new Exception("Invalid accommodation type.");
        }
        return $type;
    }

    private function getCityIdByName($city_name) {
        $city_name = $this->validateString("City name", $city_name, 100);
        $city_stmt = $this->query("SELECT city_id FROM cities WHERE name = ?", [$city_name]);
        $city = $city_stmt->fetch(PDO::FETCH_ASSOC);

        if (!$city) {
            throw new Exception("City not found.");
        }

        return $city['city_id'];
    }

    private function validateDate($date, $fieldName) {
        if (!strtotime($date)) {
            throw new Exception("Invalid date format for $fieldName.");
        }
    }

    private function validateDatesLogic($check_in, $check_out) {
        if (strtotime($check_in) > strtotime($check_out)) {
            throw new Exception("Check-out date must be after check-in date.");
        }
    }

    // --- Core Methods ---
    public function getAll() {
        try {
            $stmt = $this->query("SELECT * FROM accommodations");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve accommodations: " . $e->getMessage());
        }
    }

    public function getById($id) {
        $this->validateId($id);
        try {
            $stmt = $this->query("SELECT * FROM accommodations WHERE accommodation_id = ?", [$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve accommodation: " . $e->getMessage());
        }
    }

    public function getOwnerAccommodations($id) {
        $this->validateId($id);
        try {
            $stmt = $this->query("SELECT * FROM accommodations WHERE owner_id = ?", [$id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve owner: " . $e->getMessage());
        }
    }

    public function getAccRoom($id, $room_type) {
        $this->validateId($id);
        try {
            $stmt = $this->query("
                SELECT rooms.room_id 
                FROM rooms 
                INNER JOIN accommodations ON accommodations.accommodation_id = rooms.accommodation_id 
                WHERE rooms.accommodation_id = ? 
                AND rooms.room_type = ? 
                AND rooms.is_available = 1", 
                [$id, $room_type]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result["room_id"];

        } catch (Exception $e) {
            throw new Exception("Failed to retrieve room for accommodation: " . $e->getMessage());
        }
    }

    public function getAccRoomTypes($id) {
        $this->validateId($id);
        try {
            $stmt = $this->query("
                SELECT rooms.room_type 
                FROM rooms 
                INNER JOIN accommodations ON accommodations.accommodation_id = rooms.accommodation_id 
                WHERE rooms.accommodation_id = ? 
                AND rooms.is_available = 1", 
                [$id]);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (Exception $e) {
            throw new Exception("Failed to retrieve room for accommodation: " . $e->getMessage());
        }
    }

    public function getAccTotalRooms($accommodation_id) {
        $this->validateId($accommodation_id);
        try {
            $stmtTotal = $this->query("
                SELECT COUNT(*) AS total 
                FROM rooms 
                WHERE accommodation_id = ?", 
                [$accommodation_id]
            );
            $totalRooms = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];
            return $totalRooms;

        } catch (Exception $e) {
            throw new Exception("Failed to calculate room availability: " . $e->getMessage());
        }
    }


    public function getAccAmmenities($id) {
        $this->validateId($id);
        try {
            $stmt = $this->query("
                SELECT a.amenity_id, a.name 
                FROM amenities a
                INNER JOIN accommodation_amenities aa ON a.amenity_id = aa.amenity_id
                WHERE aa.accommodation_id = ?
            ", [$id]);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve amenities for accommodation: " . $e->getMessage());
        }
    }

    public function create($inname, $indescription, $inaddress, $incity_name, $intype) {
        $name = $this->validateString("Name", $inname, 100);
        $description = $indescription ?? null;
        $address = $this->validateString("Address", $inaddress, 255);
        $type = $this->validateType($intype);
        $city_id = $this->getCityIdByName($incity_name);

        // Prevent duplicate accommodations in same city
        $existing = $this->query("SELECT * FROM accommodations WHERE name = ? AND city_id = ?", [$name, $city_id])->fetch();
        if ($existing) {
            throw new Exception("Accommodation already exists in this city.");
        }

        try {
            $stmt = $this->query(
                "INSERT INTO accommodations (name, description, address, city_id, type) 
                 VALUES (?, ?, ?, ?, ?)", 
                [$name, $description, $address, $city_id, $type]
            );
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to create accommodation: " . $e->getMessage());
        }
    }

    public function update($id, $name, $description, $address, $city_name, $type) {
        $this->validateId($id);
        $name = $this->validateString("Name", $name, 100);
        $description = $this->validateString("Description", $description, 1000);
        $address = $this->validateString("Address", $address, 255);
        $type = $this->validateType("Type", $type, 50);
        $city_id = $this->getCityIdByName($city_name);

        // Prevent duplicate accommodations in same city
        $existing = $this->query("SELECT * FROM accommodations WHERE name = ? AND city_id = ?", [$name, $city_id])->fetch();
        if ($existing) {
            throw new Exception("Accommodation already exists in this city.");
        }

        try {
            $stmt = $this->query(
                "UPDATE accommodations 
                 SET name = ?, description = ?, address = ?, city_id = ?, type = ? 
                 WHERE accommodation_id = ?", 
                [$name, $description, $address, $city_id, $type, $id]
            );
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to update accommodation: " . $e->getMessage());
        }
    }

    public function delete($id) {
        $this->validateId($id);

        try {
            $stmt = $this->query("DELETE FROM accommodations WHERE accommodation_id = ?", [$id]);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to delete accommodation: " . $e->getMessage());
        }
    }

    /**
     * Search accommodations by city, availability, and optional filters.
     * To call it from the controller, use this logic:
     * $filters = [
     *      'check_out' => '2025-07-15',
     *      'city_name' => 'Paris',
     *      'check_in' => '2025-07-10',
     *      'people' => 2,
     *      'min_price' => 80,
     *      'room_type' => 'double',
     *  ];
     * Since it's an object, order does not matter. But the keys must be correct, and city_name, check_in and check_out are required.
     */
    public function search(array $filters)
    {
        // Required filters
        $city_name  = trim($filters['city_name'] ?? '');
        $hotel_name = trim($filters['hotel_name'] ?? '');
        $check_in   = $filters['check_in'] ?? null;
        $check_out  = $filters['check_out'] ?? null;
        $people     = $filters['people'] ?? 1;

        // Optional filters
        $min_price  = $filters['min_price'] ?? null;
        $max_price  = $filters['max_price'] ?? null;
        $accommodation_type = $filters['accommodation_type'] ?? null;

        // --- Validation ---
        if ($city_name == '') throw new Exception("City name is required.");
        if ($check_in !== null) $this->validateDate($check_in, "check-in");
        if ($check_out !== null) $this->validateDate($check_out, "check-out");
        if ($check_in !== null && $check_out !== null) $this->validateDatesLogic($check_in, $check_out);
        if (!is_numeric($people) || $people <= 0) throw new Exception("Número de personas inválido.");

        // --- Build query ---
        $params = [$city_name, $people, $check_out, $check_in];

        $query = "
            SELECT a.*, 
                c.name AS city_name,
                MIN(r.price) AS min_price,
                GROUP_CONCAT(DISTINCT r.room_type) AS room_types
            FROM accommodations a
            JOIN cities c ON a.city_id = c.city_id
            JOIN rooms r ON a.accommodation_id = r.accommodation_id
            WHERE c.name = ?
            AND r.capacity >= ?
            AND NOT EXISTS (
                SELECT 1 FROM bookings b
                WHERE b.room_id = r.room_id
                AND b.check_in < ? AND b.check_out > ?
            )
        ";

        // Optional filters applied
        if ($hotel_name !== '') {
            $query .= " AND a.name = ?";
            $params[] = $hotel_name;
        }

        // Room type logic (based on people count)
        $people     = $filters['people'] ?? 1;
        if ($people == 1) {
            $query .= " AND r.room_type = ?";
            $params[] = 'single';
        } elseif ($people == 2) {
            $query .= " AND r.room_type = ?";
            $params[] = 'double';
        } elseif ($people >= 3) {
            $query .= " AND (r.room_type = ? OR r.room_type = ?)";
            $params[] = 'family';
            $params[] = 'suite';
        }

        if ($accommodation_type !== null) {
            $query .= " AND a.type = ?";
            $params[] = $accommodation_type;
        }

        if ($min_price !== null) {
            $query .= " AND r.price >= ?";
            $params[] = $min_price;
        }

        if ($max_price !== null) {
            $query .= " AND r.price <= ?";
            $params[] = $max_price;
        }

        // Group by accommodation
        $query .= " GROUP BY a.accommodation_id";

        $stmt = $this->query($query, $params);
        $search_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Add amenities
        foreach ($search_results as &$result) {
            $result['amenities'] = $this->getAccAmmenities($result['accommodation_id']);
        }

        return array_values($search_results);
    }

    public function filter(array $accommodations, array $selectedAmenities) {
        if (empty($selectedAmenities)) {
            return $accommodations;
        }
        //array_pop($selectedAmenities);

        $filter_results = [];

        foreach ($accommodations as $acc) {
            if (!isset($acc['amenities']) || !is_array($acc['amenities'])) {
                continue; // Skip accommodations without valid amenities
            }

            $accAmenityNames = array_column($acc['amenities'], 'name');

            if (empty(array_diff($selectedAmenities, $accAmenityNames))) {
                $filter_results[] = $acc;
            }
        }

        return $filter_results;
    }

    // Por paco
    public function getReviewsByAccommodationId($accommodation_id) {
        $this->validateId($accommodation_id);

        try {
            $stmt = $this->query("
            SELECT r.review_id, r.rating, r.comment, r.created_at, u.first_name, u.last_name
            FROM reviews r
            INNER JOIN users u ON r.user_id = u.user_id
            WHERE r.accommodation_id = ?
            ORDER BY r.created_at DESC
        ", [$accommodation_id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve reviews: " . $e->getMessage());
        }
    }


    
}
?>
