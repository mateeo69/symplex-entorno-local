<?php
require_once '../core/Database.php';

class City extends Database {

    // --- Validation Helpers ---
    private function validateCityId($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid city ID.");
        }
    }

    private function validateCityFields($name, $country) {
        $name = trim($name);
        $country = trim($country);

        if (empty($name) || strlen($name) > 100 || !preg_match('/^[\p{L} \'-]+$/u', $name)) {
            throw new Exception("Invalid city name.");
        }

        if (empty($country) || strlen($country) > 100 || !preg_match('/^[\p{L} \'-]+$/u', $country)) {
            throw new Exception("Invalid country name.");
        }

        return [$name, $country];
    }

    // --- Core Methods ---
    public function getAll() {
        try {
            $stmt = $this->query("SELECT * FROM cities");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve cities: " . $e->getMessage());
        }
    }

    public function getById($id) {
        $this->validateCityId($id);

        try {
            $stmt = $this->query("SELECT * FROM cities WHERE city_id = ?", [$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve city: " . $e->getMessage());
        }
    }

    public function create($name, $country) {
        [$name, $country] = $this->validateCityFields($name, $country);

        // Optional: prevent duplicates
        $existing = $this->query("SELECT * FROM cities WHERE name = ? AND country = ?", [$name, $country])->fetch();
        if ($existing) {
            throw new Exception("City already exists in that country.");
        }

        try {
            $stmt = $this->query("INSERT INTO cities (name, country) VALUES (?, ?)", [$name, $country]);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to create city: " . $e->getMessage());
        }
    }

    public function update($id, $name, $country) {
        $this->validateCityId($id);
        [$name, $country] = $this->validateCityFields($name, $country);

        try {
            $stmt = $this->query("UPDATE cities SET name = ?, country = ? WHERE city_id = ?", [$name, $country, $id]);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to update city: " . $e->getMessage());
        }
    }

    public function delete($id) {
        $this->validateCityId($id);

        try {
            $stmt = $this->query("DELETE FROM cities WHERE city_id = ?", [$id]);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to delete city: " . $e->getMessage());
        }
    }

    
}
?>
