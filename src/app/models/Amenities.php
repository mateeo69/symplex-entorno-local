<?php

require_once '../core/Database.php';

class Amenity extends Database {

    public function getAll() {
        try {
            $stmt = $this->query("SELECT * FROM amenities");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve amenities: " . $e->getMessage());
        }
    }
}
?>