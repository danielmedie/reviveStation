<?php
require 'partials/connect.php';

// Kontrollera om en POST-förfrågan har skickats för att ta bort säljaren
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sellerId = $_POST['seller_id'];

  // Skapa en anslutning till databasen
  $pdo = connect();

  // Ta bort relaterade poster i tabellen "items"
  $stmt = $pdo->prepare("DELETE FROM items WHERE seller_id = ?");
  $stmt->execute([$sellerId]);

  // Ta bort säljaren från databasen
  $stmt = $pdo->prepare("DELETE FROM sellers WHERE seller_id = ?");
  $stmt->execute([$sellerId]);

  echo "Säljaren har tagits bort!";
}
?>
