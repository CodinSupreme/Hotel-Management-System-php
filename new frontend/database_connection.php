<?php
// db.php
/*
$host = "localhost";
$dbname = "hotel_management";
$user = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "✅ Database connected successfully";
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}
*/

$host = 'localhost';
$port = 5432; // default PostgreSQL port
$dbname = 'hotel_management_php';
$user = 'postgres';
$password = 'C0d1n.Dat@Base';
//

try {
    // Change mysql: to pgsql:
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}
?>
