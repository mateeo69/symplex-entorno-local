<?php

require_once '../app/models/Accommodation.php';
require_once '../app/models/Amenities.php';

class SearchController {
    public function filter() {
        $model = new Accommodation();
        $amenities = new Amenity();
    
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); 
        }

        $accommodations = $_SESSION['accommodations'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $accFilters = $_POST['accFilters'] ?? [];

            $all_amenities = $amenities->getAll();

            $filter_results = $model->filter($accommodations, $accFilters);

            require '../app/views/search.php';
        } else {
            header('Location: index.php');
            exit;
        }
    }
}

?>