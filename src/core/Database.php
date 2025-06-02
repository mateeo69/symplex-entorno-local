<?php

class Database {
    private $host = 'mysql.railway.internal'; // From MYSQLHOST
    private $port = '3306';                   // From MYSQLPORT
    private $db   = 'railway';                // From MYSQLDATABASE or MYSQL_DATABASE
    private $user = 'root';                   // From MYSQLUSER
    private $pass = 'aktMdVKmHtdCvMzqAUUdJrBefkgcAjBI'; // From MYSQLPASSWORD
    private $charset = 'utf8mb4';
    protected $pdo;

    function __construct() {
        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->db;charset=$this->charset";

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET NAMES utf8mb4");

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

    /**
     * Get enum values of a column from a MySQL table.
     *
     * @param string $table Name of the table
     * @param string $column Name of the enum column
     * @return array Enum values as an array of strings
     * @throws Exception if enum values cannot be fetched or parsed
     */
    public function getEnumValues(string $table, string $column): array {
        $sql = "SELECT COLUMN_TYPE 
                FROM information_schema.COLUMNS 
                WHERE TABLE_NAME = :table 
                  AND COLUMN_NAME = :column 
                  AND TABLE_SCHEMA = :schema";

        $stmt = $this->query($sql, [
            'table' => $table,
            'column' => $column,
            'schema' => $this->db,
        ]);

        $columnType = $stmt->fetchColumn();

        if (!$columnType) {
            throw new Exception("No enum column found for {$table}.{$column}");
        }

        // Extract enum values from COLUMN_TYPE string
        $enumStr = trim($columnType);
        $enumStr = preg_replace("/^enum\((.*)\)$/", "$1", $enumStr);

        // Parse CSV but taking care of quoted strings
        $enumValues = str_getcsv($enumStr, ',', "'");

        return $enumValues;
    }
}

?>
