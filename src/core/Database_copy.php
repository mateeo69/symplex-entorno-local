<?php

class Database_copy {
    private $host = 'db'; //
    private $port = '3306';
    private $db = 'mi_basedatos'; //DB DATABASE
    private $user = 'usuario';
    private $pass = 'contraseña';
    private $charset = 'utf8mb4';
    protected $pdo;

    function __construct() {
        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->db;charset=$this->charset";

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    function query($sql, $params = []) {
        try {
            error_log('Database::query - SQL: ' . $sql);
            error_log('Database::query - Params: ' . print_r($params, true));
            
            $stmt = $this->pdo->prepare($sql);
            $success = $stmt->execute($params);
            
            error_log('Database::query - Ejecución exitosa: ' . ($success ? 'SI' : 'NO'));
            
            return $stmt;
        } catch (PDOException $e) {
            error_log('Database::query - Error: ' . $e->getMessage());
            throw new Exception('Error en la consulta SQL: ' . $e->getMessage());
        }
    }
}

?>
