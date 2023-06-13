<?php
require 'partials/connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sellerId = $_POST['seller_id'];

  $pdo = connect();
  // Ta bort alla produkter från items om dom har samma seller_id som med den säljaren vi tar bort
  $stmt = $pdo->prepare("DELETE FROM items WHERE seller_id = ?");
  $stmt->execute([$sellerId]);

  // Ta bort säljaren från databasen
  $stmt = $pdo->prepare("DELETE FROM sellers WHERE seller_id = ?");
  $stmt->execute([$sellerId]);

  echo "Säljaren har tagits bort!";
}
?>
