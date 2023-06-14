<?php
$host = 'localhost';
$dbname = 'revivestation';
$username = 'root';
$password = 'abc123';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Anslutningen misslyckades: ' . $e->getMessage());
}
?>
