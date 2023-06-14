<?php
require 'partials/Seller.php';

$pdo = new PDO('mysql:host=localhost;dbname=revivestation;charset=utf8', 'root', 'abc123');

$seller = new Seller($pdo);

$sellers = $seller->getAllSellers();
$topSellers = $seller->getTopSellers();
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
    
    <h2>Topp 3 Säljare</h2>
    <ul>
        <?php foreach ($topSellers as $topSeller): ?>
            <li>
                <span class="seller-name"><?php echo $topSeller['name']; ?></span>
                <span class="seller-stats">Antal sålda föremål: <?php echo $topSeller['total_items_sold']; ?></span>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Alla Säljare</h2>
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
