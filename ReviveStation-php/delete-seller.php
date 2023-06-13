<?php
require 'partials/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['seller_id'])) {
    $sellerId = $_POST['seller_id'];

    try {
        // Ta bort alla relaterade poster i items-tabellen för den aktuella säljaren
        $stmtDeleteItems = $pdo->prepare("DELETE FROM items WHERE seller_id = ?");
        $stmtDeleteItems->execute([$sellerId]);

        // Ta bort säljaren från sellers-tabellen
        $stmtDeleteSeller = $pdo->prepare("DELETE FROM sellers WHERE seller_id = ?");
        $stmtDeleteSeller->execute([$sellerId]);

        header("Location: list-sellers.php");
        exit();
        
    } catch (PDOException $e) {
        die('Ett fel inträffade: ' . $e->getMessage());
    }
} else {
    die('Ogiltig förfrågan.');
}

?>
