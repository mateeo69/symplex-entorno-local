<?php
require_once '../core/Database.php';

class Review extends Database {

    public function create($user_id, $accommodation_id, $rating, $comment) {
        try {
            $stmt = $this->query("
                INSERT INTO reviews (user_id, accommodation_id, rating, comment)
                VALUES (?, ?, ?, ?)",
                [$user_id, $accommodation_id, $rating, $comment]);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to create review: " . $e->getMessage());
        }
    }

}