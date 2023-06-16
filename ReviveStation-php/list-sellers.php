<?php
require_once 'TopSeller.php';

$pdo = new PDO('mysql:host=localhost;dbname=revivestation', 'root', 'abc123');

$seller = new Seller($pdo);
$topSeller = new TopSeller($pdo);

// Hämtar alla säljare från databasen
$sellers = $seller->getAllSellers();

// Hämtar de bästa säljarna från databasen
$topSellers = $topSeller->getTopSellers(3);
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

<h2>Topp 3 bästa säljare:</h2>
<ol>
    <?php foreach ($topSellers as $index => $topSeller): ?>
        <li>
            <span class="seller-name"><?php echo $topSeller['name']; ?></span>
            <span class="seller-sales">Antal sålda: <?php echo $topSeller['total_items_sold']; ?></span>
        </li>
    <?php endforeach; ?>
</ol>

</body>
</html>
