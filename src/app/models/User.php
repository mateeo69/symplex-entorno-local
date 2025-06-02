<?php

require_once '../core/Database.php';

class User extends Database {

    // --- Validation Helpers ---
    private function validateId($id, $field = "ID") {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid $field.");
        }
    }

    private function validateString($field, $value, $maxLength = 100) {
        $value = trim($value);
        if (empty($value)) {
            throw new Exception("$field is required.");
        }
        if (strlen($value) > $maxLength) {
            throw new Exception("$field must be under $maxLength characters.");
        }
        return $value;
    }

    private function validateEmail($email) {
        $email = trim($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        if (strlen($email) > 150) {
            throw new Exception("Email must be under 150 characters.");
        }
        return $email;
    }

    private function validatePassword($password) {
        if (strlen($password) < 6) {
            throw new Exception("Password must be at least 6 characters long.");
        }
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function validatePhone($phone) {
        $phone = trim($phone);
        if (!preg_match('/^\+?[0-9\s\-]{7,20}$/', $phone)) {
            throw new Exception("Invalid phone number format.");
        }
        return $phone;
    }

    private function getCityIdByName($name) {
        $name = $this->validateString("City", $name, 100);
        $city_stmt = $this->query("SELECT city_id FROM cities WHERE name = ?", [$name]);
        $city = $city_stmt->fetch(PDO::FETCH_ASSOC);
        if (!$city) {
            throw new Exception("City not found.");
        }
        return $city['city_id'];
    }

    public function getAll() {
        try {
            $stmt = $this->query("SELECT * FROM users");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve users: " . $e->getMessage());
        }
    }

    public function getByEmail($email) {
        $email = $this->validateEmail($email);
    
        try {
            $stmt = $this->query(
                "SELECT u.*, c.name as city 
                 FROM users u 
                 LEFT JOIN cities c ON u.city_id = c.city_id 
                 WHERE u.email = ?", 
                [$email]
            );
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("No se pudo obtener el usuario: " . $e->getMessage());
        }
    }
    

    public function getById($id) {
        $this->validateId($id, "User ID");

        try {
            $stmt = $this->query("SELECT * FROM users WHERE id = ?", [$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve user: " . $e->getMessage());
        }
    }

    public function create($first_name, $last_name, $email, $password, $phone, $city_name) {
        $first_name = $this->validateString("First name", $first_name);
        $last_name = $this->validateString("Last name", $last_name);
        $email = $this->validateEmail($email);
        $password_hashed = $this->validatePassword($password);
        $phone = $this->validatePhone($phone);
        $city_id = $this->getCityIdByName($city_name);

        try {
            $stmt = $this->query(
                "INSERT INTO users (first_name, last_name, email, password, phone, city_id)
                 VALUES (?, ?, ?, ?, ?, ?)", 
                [$first_name, $last_name, $email, $password_hashed, $phone, $city_id]
            );
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to create user: " . $e->getMessage());
        }
    }

    public function generateRandomPassword($length = 12) {
        if ($length < 2) {
            throw new Exception("Password length must be at least 2 to include required characters.");
        }

        $lower = 'abcdefghijklmnopqrstuvwxyz';
        $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $all = $lower . $upper . $numbers;

        // Ensure at least one uppercase letter and one number
        $password = [];
        $password[] = $upper[random_int(0, strlen($upper) - 1)];
        $password[] = $numbers[random_int(0, strlen($numbers) - 1)];

        // Fill the rest with random chars from all allowed characters
        for ($i = 2; $i < $length; $i++) {
            $password[] = $all[random_int(0, strlen($all) - 1)];
        }

        // Shuffle to avoid predictable placement
        shuffle($password);

        // Return as string
        return implode('', $password);
    }


    public function createOwner($first_name, $email, $phone, $city_name) {
        $first_name = $this->validateString("First name", $first_name);
        $email = $this->validateEmail($email);
        $plain_password = $this->generateRandomPassword();
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
        $phone = $this->validatePhone($phone);
        $city_id = $this->getCityIdByName($city_name);

        try {
            $stmt = $this->query(
                "INSERT INTO users (first_name, email, password, phone, city_id, role)
                VALUES (?, ?, ?, ?, ?, ?)", 
                [$first_name, $email, $hashed_password, $phone, $city_id, 'admin']
            );

            return [
                'user_id' => $this->pdo->lastInsertId(),
                'plain_password' => $plain_password
            ];
        } catch (Exception $e) {
            throw new Exception("Failed to create user: " . $e->getMessage());
        }
    }


    public function update($id, $name) {
        $this->validateId($id, "User ID");
        $name = $this->validateString("First name", $name);

        try {
            $stmt = $this->query("UPDATE users SET first_name = ? WHERE user_id = ?", [$name, $id]);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to update user: " . $e->getMessage());
        }
    }
    
    public function updateProfile($user_id, $first_name, $last_name, $email, $phone) {
        $this->validateId($user_id, "User ID");
        $first_name = $this->validateString("First name", $first_name);
        $last_name = $this->validateString("Last name", $last_name);
        $email = $this->validateEmail($email);
        $phone = $this->validatePhone($phone);
        
        try {
            $stmt = $this->query(
                "UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE user_id = ?", 
                [$first_name, $last_name, $email, $phone, $user_id]
            );
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            throw new Exception("Failed to update profile: " . $e->getMessage());
        }
    }

    public function delete($id) {
        $this->validateId($id, "User ID");

        try {
            $stmt = $this->query("DELETE FROM users WHERE user_id = ?", [$id]);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to delete user: " . $e->getMessage());
        }
    }

    public function login($email, $password) {
        $email = $this->validateEmail($email);
        $password = $this->validatePassword($password);

        try {
            $stmt = $this->query("SELECT * FROM users WHERE email = ?", [$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            } else {
                throw new Exception("Invalid email or password.");
            }
        } catch (Exception $e) {
            throw new Exception("Failed to log in: " . $e->getMessage());
        }
    }

    public function register($first_name, $last_name, $email, $password) {
        $first_name = $this->validateString("First name", $first_name);
        $last_name = $this->validateString("Last name", $last_name);
        $email = $this->validateEmail($email);
        $password_hashed = $this->validatePassword($password);
        $phone = $this->validatePhone($phone);
        $city_id = $this->getCityIdByName($city_name);

        try {
            $stmt = $this->query(
                "INSERT INTO users (first_name, last_name, email, password)
                 VALUES (?, ?, ?, ?, ?, ?)", 
                [$first_name, $last_name, $email, $password_hashed]
            );
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Failed to create user: " . $e->getMessage());
        }
    }

    public function updatePassword($userID, $new_password) {
        $new_password_hashed = $this->validatePassword($new_password);

        try {
            $stmt = $this->query("UPDATE users SET password = ? WHERE user_id = ?", [$new_password_hashed, $userID]);
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            throw new Exception("Failed to update password: " . $e->getMessage());
        }
    }
}
?>
