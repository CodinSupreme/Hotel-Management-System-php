<?php
// db.php

$host = "localhost";
$port = "5432";
$dbname = "hotel_db";
$user = "postgres";
$password = "your_password";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "✅ Database connected successfully";
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}
?>
