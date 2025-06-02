<?php

require_once __DIR__ . '/src/core/Database.php';

$db = new Database();

$sqlFiles = [
    __DIR__ . '/docker/01_general.sql',
    __DIR__ . '/docker/02_insertCities.sql',
    __DIR__ . '/docker/03_insertUsers.sql',
    __DIR__ . '/docker/04_insertAccommodations.sql',
    __DIR__ . '/docker/05_insertRooms.sql',
    __DIR__ . '/docker/06_insertBookings.sql',
    __DIR__ . '/docker/07_insertAmenities.sql',
    __DIR__ . '/docker/08_insertAccAmenit.sql',
    __DIR__ . '/docker/09_insertReviews.sql',
];

try {
    // Aquí chequeas si ya está inicializado (opcional)
    $checkTable = "SHOW TABLES LIKE 'cities'";
    $stmt = $db->query($checkTable);
    $exists = $stmt->fetch();

    if ($exists) {
        echo "✅ La base de datos ya está inicializada. No se ejecutan los scripts.";
        exit;
    }

    foreach ($sqlFiles as $file) {
        if (!file_exists($file)) {
            throw new Exception("Archivo no encontrado: $file");
        }
        $sql = file_get_contents($file);
        $db->pdo->exec($sql);
        echo "✅ Ejecutado $file\n";
    }

    echo "✅ Todos los scripts SQL ejecutados correctamente.";

} catch (Exception $e) {
    die("❌ Error: " . $e->getMessage());
}
