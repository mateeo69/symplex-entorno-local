<?php
require_once __DIR__ . '/../models/User.php';
require_once '../app/models/Booking.php';

class AuthController {
    public function register($data = null) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userModel = new User();
                $userModel->create(
                    $_POST['first_name'],
                    $_POST['last_name'],
                    $_POST['email'],
                    $_POST['password'],
                    $_POST['phone'],
                    $_POST['city']
                );
                echo "Usuario registrado con éxito";
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
                
                // Convertir mensajes de error técnicos en mensajes amigables
                if (strpos($errorMessage, 'Duplicate entry') !== false && strpos($errorMessage, 'email') !== false) {
                    echo "El correo electrónico ya está registrado. Por favor, utiliza otro correo o inicia sesión.";
                } else if (strpos($errorMessage, 'City not found') !== false) {
                    echo "La ciudad ingresada no es válida. Por favor, verifica e intenta nuevamente.";
                } else if (strpos($errorMessage, 'Invalid email format') !== false) {
                    echo "El formato del correo electrónico no es válido. Por favor, verifica e intenta nuevamente.";
                } else if (strpos($errorMessage, 'Invalid phone number') !== false) {
                    echo "El formato del número de teléfono no es válido. Debe contener 9 dígitos.";
                } else if (strpos($errorMessage, 'Password must be') !== false) {
                    echo "La contraseña debe tener al menos 8 caracteres, incluir mayúsculas, minúsculas y números.";
                } else {
                    // Para errores no especificados, mostrar un mensaje genérico
                    echo "Ha ocurrido un error durante el registro. Por favor, intenta nuevamente más tarde.";
                    
                    // Registrar el error real para depuración (no visible para el usuario)
                    error_log("Error de registro: " . $errorMessage);
                }
            }
        } else {
            require_once '../app/views/sign_up.php';
        }
    }

    public function login($data = null) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $email = $_POST['email'];
                $password = $_POST['password'];
    
                $userModel = new User();
                $user = $userModel->getByEmail($email);
    
                if ($user && password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user'] = $user;
                    if ($user['role'] === 'admin') {
                        header('Location: index.php?action=admin');
                        exit;
                    } else {
                        header('Location: index.php?action=home');
                        exit;
                    }
                } else {
                    header('Location: index.php?action=login&error=UserError');
                    exit;
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            require_once '../app/views/sign_up.php';
        }
    }
    public function registerJs() {
        header('Content-Type: application/javascript');
        readfile(__DIR__ . '/../views/js/register.js');
        exit;
    }
    public function homeJs() {
        header('Content-Type: application/javascript');
        readfile(__DIR__ . '/../views/js/home.js'); 
        exit;
    }
    public function detailsJs() {
        header('Content-Type: application/javascript');
        readfile(__DIR__ . '/../views/js/details.js'); 
        exit;
    }
    
    public function adminJs() {
        header('Content-Type: application/javascript');
        readfile(__DIR__ . '/../views/js/admin.js'); 
        exit;
    }
    
    public function bookingsJs() {
        header('Content-Type: application/javascript');
        readfile(__DIR__ . '/../views/js/bookings.js'); 
        exit;
    }
    
    public function searchJs() {
        header('Content-Type: application/javascript');
        readfile(__DIR__ . '/../views/js/search.js'); 
        exit;
    }
    
    public function hotelviewJs() {
        header('Content-Type: application/javascript');
        readfile(__DIR__ . '/../views/js/hotelview.js'); 
        exit;
    }

    public function helpJs() {
        header('Content-Type: application/javascript');
        readfile(__DIR__ . '/../views/js/help.js'); 
        exit;
    }

    
    public function bookings() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); 
        }
        // Filtros básicos: siempre filtrar por el email del usuario actual
        $filters = [
            'user_email' => $_SESSION['user']['email']
        ];

        $model = new Booking();

        // Procesar orden de fecha
        $order = isset($_GET['order']) ? $_GET['order'] : 'upcoming';
        
        // Procesar filtro de estado si está presente
        if (isset($_GET['status']) && $_GET['status'] !== 'all') {
            $filters['status'] = $_GET['status'];
            $search_results_filtered = $model->search($filters, $order);
        } else {
            $search_results = $model->search($filters, $order);
            if (isset($_SESSION['search_results'])) {
                unset($_SESSION['search_results']);
            }
        }
        require '../app/views/bookings.php';
/*
        header('Content-Type: text/html; charset=UTF-8');
        readfile(__DIR__ . '/../views/bookings.html'); */
    }
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); 
        }
        $_SESSION = [];
        header("Location: index.php");
        exit;
    }

    public function adminView() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php');
            exit;
        }
        
        require_once '../app/views/adminViews.php';
    }
    
    public function updateProfile() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Verificar si el usuario está logueado
        if (!isset($_SESSION['user'])) {
            echo "Debe iniciar sesión para actualizar su perfil";
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Obtener los datos del formulario
                $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
                $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
                $email = isset($_POST['email']) ? trim($_POST['email']) : '';
                $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
                
                // Validar los datos
                $userModel = new User();
                
                // Verificar si el correo ya existe y no es el del usuario actual
                if ($email !== $_SESSION['user']['email']) {
                    $existingUser = $userModel->getByEmail($email);
                    if ($existingUser) {
                        echo "El correo electrónico ya está registrado por otro usuario";
                        exit;
                    }
                }
                
                // Actualizar el perfil del usuario
                $result = $userModel->updateProfile(
                    $_SESSION['user']['user_id'],
                    $first_name,
                    $last_name,
                    $email,
                    $phone
                );
                
                if ($result) {
                    // Actualizar la información en la sesión
                    $_SESSION['user']['first_name'] = $first_name;
                    $_SESSION['user']['last_name'] = $last_name;
                    $_SESSION['user']['email'] = $email;
                    $_SESSION['user']['phone'] = $phone;
                    
                    echo "Perfil actualizado con éxito";
                } else {
                    echo "No se pudo actualizar el perfil";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Método no permitido";
        }
        exit;
    }

    public function changePassword() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $currentPassword = trim($_POST['currentPassword']);
                $newPassword = trim($_POST['newPassword']);

                $userModel = new User();
                $user = $userModel->getByEmail($_SESSION['user']['email']);

                if (!$user || !password_verify($currentPassword, $user['password'])) {
                    header('Location: index.php?action=changePassword&success=verifyPassword');
                    exit;
                }

                // Update the password in the database
                $result = $userModel->updatePassword($user['user_id'], $newPassword);

                if ($result) {
                    header('Location: index.php?action=changePassword&success=true');
                } else {
                    header('Location: index.php?action=changePassword&success=false');
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $search_results = $_POST['search_results'];
            }
            require_once '../app/views/bookings.php';
        }
        exit;
    }

}
?>
