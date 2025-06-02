<?php

require_once '../app/models/Review.php';

class ReviewController {
    public function review() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start(); 
            }

            $user_id = $_SESSION['user']['user_id'];
            $accommodation_id = $_POST['accommodation_id'] ?? null;
            if ($_POST['rating'] == '10') 
                $rating = 9.9;
            else
                $rating = $_POST['rating'] ?? null;
            $comment = $_POST['comment'] ?? null;

            $model = new Review();
            try {
                $model->create($user_id, $accommodation_id, $rating, $comment);
                exit();
            } catch (Exception $e) {
                throw new Exception("Controller error to create review: " . $e->getMessage());
            }
        }
    }

}

?>