<?php
require_once '../app/models/Accommodation.php';

class DetailsController {
    public function show() {
        if (!isset($_GET['id'])) {
            echo "ID de alojamiento no proporcionado.";
            return;
        }

        $id = $_GET['id'] ?? null;
        $check_in = $_GET['check_in'] ?? null;
        $check_out = $_GET['check_out'] ?? null;
        $city_name = $_GET['city_name'] ?? null;
        $price = $_GET['price'] ?? null;

        $model = new Accommodation();

        try {
            $alojamiento = $model->getById($id);

            if (!$alojamiento) {
                echo "Alojamiento no encontrado.";
                return;
            }

            $amenities = $model->getAccAmmenities($id);

            $accRoomType = $model->getAccRoomTypes($id);

            $roomTypesAvailable = array_column($accRoomType, 'room_type');

            // Paco
            // Aquí es donde añadiremos las reviews:
            $reviews = $model->getReviewsByAccommodationId($id);

            // Puedes pasar los datos a la vista:
            require '../app/views/details.php';

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
