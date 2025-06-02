<?php

require_once '../app/models/Accommodation.php';
require_once '../app/models/Amenities.php';
require_once '../app/models/City.php';

class HomeController {
    public function index() {
        $cityModel = new City();
        $cities = $cityModel->getAll();
        require_once '../app/views/home.php';
    }

    public function search() {
        $model = new Accommodation();
        $amenities = new Amenity();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start(); 
            }
            $_SESSION['last_search_filters'] = $_POST['filters'];

            $_SESSION['city_name'] = $_POST['filters']['city_name'];
            $_SESSION['check_in'] = $_POST['filters']['check_in'];
            $_SESSION['check_out'] = $_POST['filters']['check_out'];
            $_SESSION['people'] = $_POST['filters']['people'];

            $searchFilters = $_POST['filters'] ?? [];
            $search_results = $model->search($searchFilters);
            $all_amenities = $amenities->getAll();

            require '../app/views/search.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start(); 
            }

            $searchFilters = $_SESSION['last_search_filters'] ?? [];
            $search_results = $model->search($searchFilters);
            $all_amenities = $amenities->getAll();

            require '../app/views/search.php';
        } else {
            header('Location: index.php');
            exit;
        }
    }

    public function details() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            // Si no hay id válido, redirige o muestra error
            throw new Exception('Id invalido.');
            exit;
        }

        $id = (int) $_GET['id'];
        $model = new Accommodation();

        try {
            $accommodation = $model->getById($id);
            if (!$accommodation) {
                throw new Exception('Alojamiento no encontrado.');
                exit;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }

        require_once '../app/views/details.php';
    }

    public function home() {
        $cityModel = new City();
        $cities = $cityModel->getAll();
        require_once '../app/views/home.php';
    }

    public function aboutUs() {
        require '../app/views/aboutUs.php';
    }

    public function help() {
        require '../app/views/help.php';
    }

    public function hotelview() {
        require '../app/views/hotelview.php';
    }

    public function terms() {
        require '../app/views/termsAndConditions.php';
    }

    public function privacy() {
        require '../app/views/privacyPolicy.php';
    }

}
