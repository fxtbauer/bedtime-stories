<?php
// Conexão PDO com o MySQL (XAMPP padrão)
$host = "localhost";
$dbname = "bedtime_stories";
$user = "root";
$pass = ""; // altere se tiver senha

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
