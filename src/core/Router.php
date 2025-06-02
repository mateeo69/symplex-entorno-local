<?php
class Router {
    public function dispatch() {
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        switch ($action) {
            case 'search':
                $controllerName = 'HomeController';
                $method = 'search';
                break;

            case 'aboutUs':
                $controllerName = 'HomeController';
                $method = 'aboutUs';
                break;

            case 'register':
                $controllerName = 'AuthController';
                $method = 'register';
                break;

            case 'login':
                $controllerName = 'AuthController';
                $method = 'login';
                break;

            case 'registerJs':
                $controllerName = 'AuthController';
                $method = 'registerJs';
                break;

            case 'homeJs':
                $controllerName = 'AuthController';
                $method = 'homeJs';
                break;

            case 'detailsJs':
                $controllerName = 'AuthController';
                $method = 'detailsJs';
                break;

            case 'adminJs':
                $controllerName = 'AuthController';
                $method = 'adminJs';
                break;

            case 'bookingsJs':
                $controllerName = 'AuthController';
                $method = 'bookingsJs';
                break;
            
            case 'searchJs':
                $controllerName = 'AuthController';
                $method = 'searchJs';
                break;
                
            case 'hotelviewJs':
                $controllerName = 'AuthController';
                $method = 'hotelviewJs';
                break;

            case 'helpJs':
                $controllerName = 'AuthController';
                $method = 'helpJs';
                break;

            case 'updateProfile':
                $controllerName = 'AuthController';
                $method = 'updateProfile';
                break;

            case 'bookings':
                $controllerName = 'AuthController';
                $method = 'bookings';
                break;

            case 'logout':
                $controllerName = 'AuthController';
                $method = 'logout';
                break;

            case 'filter':
                $controllerName = 'SearchController';
                $method = 'filter';
                break;

            case 'details':
                $controllerName = 'DetailsController';
                $method = 'show';
                break;

            case 'book':
                $controllerName = 'BookController';
                $method = 'create';
                break;

            case 'admin':
                $controllerName = 'AuthController';
                $method = 'adminView';
                break;

            case 'hotelContact':
                $controllerName = 'ContactController';
                $method = 'register';
                break;

            case 'updateBookingStatus':
                $controllerName = 'BookingController';
                $method = 'updateStatus';
                break;
                
            case 'cancelBooking':
                $controllerName = 'BookingController';
                $method = 'cancelBooking';
                break;

            case 'review':
                $controllerName = 'ReviewController';
                $method = 'review';
                break;

            case 'aboutUs':
                $controllerName = 'HomeController';
                $method = 'aboutUs';
                break;

            case 'help':
                $controllerName = 'HomeController';
                $method = 'help';
                break;

            case 'hotelview':
                $controllerName = 'HomeController';
                $method = 'hotelview';
                break;

            case 'sendHelp':
                $controllerName = 'ContactController';
                $method = 'sendHelp';
                break;

            case 'payment':
                $controllerName = 'PaymentController';
                $method = 'processPayment';
                break;

            case 'paymentSuccess':
                $controllerName = 'PaymentController';
                $method = 'paymentSuccess';
                break;

            case 'paymentFailure':
                $controllerName = 'PaymentController';
                $method = 'paymentFailure';
                break;

            case 'forgotpass':
                $controllerName = 'ContactController';
                $method = 'forgotPassword';
                break;

            case 'terms':
                $controllerName = 'HomeController';
                $method = 'terms';
                break;
            
            case 'privacy':
                $controllerName = 'HomeController';
                $method = 'privacy';
                break;

            case 'changePassword':
                $controllerName = 'AuthController';
                $method = 'changePassword';
                break;

            default:
                $url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : [];
                $controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
                $method = isset($url[1]) ? $url[1] : 'index';
                $params = array_slice($url, 2);
                break;
        }


        require_once '../app/controllers/' . $controllerName . '.php';
        $controller = new $controllerName;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            call_user_func_array([$controller, $method], [$_POST]);
        } else {
            call_user_func_array([$controller, $method], []);
        }
    }
}
