<?php
require 'partials/Seller.php';

$pdo = new PDO('mysql:host=localhost;dbname=revivestation', 'root', 'abc123');

$seller = new Seller($pdo);

// Hämtar alla säljare från databasen
$sellers = $seller->getAllSellers();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Säljarlista</title>
    <link rel="stylesheet" href="css/list-sellers.css">
</head>
<body>
<a class="back-button" href="index.php">Tillbaka</a>
    <h1>Säljarlista</h1>
    <ul>
        <?php foreach ($sellers as $seller): ?>
            <li>
                <span class="seller-name"><?php echo $seller['name']; ?></span>
                <a href="seller-info.php?seller_id=<?php echo $seller['seller_id']; ?>" class="info-button">Info</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
