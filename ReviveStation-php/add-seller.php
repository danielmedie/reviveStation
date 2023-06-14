<?php
require 'partials/connect.php';

// Skapar en Seller-klass för att hantera säljare i databasen
class Seller {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Metod för att lägga till en säljare i databasen
    public function addSeller($name) {
        $stmt = $this->pdo->prepare("INSERT INTO sellers (name) VALUES (?)");
        $stmt->execute([$name]);
    }
}

// Skapar en instans
$seller = new Seller($pdo);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    
    // Anropar addSeller-metoden för att lägga till säljaren i databasen
    $seller->addSeller($name);
    
    echo "Säljaren har lagts till!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lägg till säljare</title>
    <link rel="stylesheet" href="css/add-seller.css">
</head>
<body>
<a class="back-button" href="list-sellers.php">Tillbaka</a>

    <h1>Lägg till säljare</h1>
    <form method="POST">
        <label for="name">Namn:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Lägg till</button>
    </form>
</body>
</html>
