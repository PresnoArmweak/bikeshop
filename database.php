<?php
// Simple PDO connection helper for XAMPP on Windows.
// Exposes a $pdo variable for usage in scripts.

$DB_HOST = getenv('DB_HOST') ?: '127.0.0.1';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
$DB_CHARSET = 'utf8mb4';
// Try "bike_shop" first (per instructions), fall back to "BikeShop" (matches provided dump)
$dbNames = [getenv('DB_NAME') ?: 'bike_shop', 'BikeShop'];

$pdo = null;
$lastException = null;
foreach ($dbNames as $DB_NAME) {
    $dsn = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset={$DB_CHARSET}";
    try {
        $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        break; // success
    } catch (Throwable $e) {
        $lastException = $e;
        $pdo = null;
        continue;
    }
}

if (!$pdo) {
    http_response_code(500);
    header('Content-Type: text/plain');
    echo "Database connection failed.\n";
    if ($lastException) {
        echo $lastException->getMessage();
    }
    exit(1);
}
