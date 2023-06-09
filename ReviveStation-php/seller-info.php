<?php
require 'partials/connect.php';

if (isset($_GET['seller_id'])) {
    $seller_id = $_GET['seller_id'];

    // Hämta säljarens information
    $pdo = connect();
    $sellerStatement = $pdo->prepare("SELECT 
        s.seller_id,
        s.name,
        COUNT(i.item_id) AS total_items_submitted,
        SUM(i.sold) AS total_items_sold,
        SUM(CASE WHEN i.sold = 1 THEN i.price ELSE 0 END) AS total_sales_amount
    FROM sellers AS s
    LEFT JOIN items AS i ON s.seller_id = i.seller_id
    WHERE s.seller_id = :seller_id
    GROUP BY s.seller_id");
    $sellerStatement->bindParam(":seller_id", $seller_id);
    $sellerStatement->execute();

    $seller = $sellerStatement->fetch(PDO::FETCH_ASSOC);

    if ($seller) {
        ?>

<!DOCTYPE html>
<html>
<head>
    <title>Säljarinformation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        .seller-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            margin-bottom: 20px;
        }

        p {
            margin: 0;
            margin-bottom: 10px;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ccc;
            color: #fff;
            border: none;
            z-index: 1;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            position: sticky;
            top: 20px;
            right: 20px;
            float: right;
        }

        .back-button:hover {
            background-color: #999;
        }
    </style>
</head>
<body>
    <a class="back-button" href="list-sellers.php">Tillbaka</a>
    <h1>Säljar ID <?php echo $seller['seller_id']; ?></h1>
    <div class="seller-info">
        <h2>Namn: <?php echo $seller['name']; ?></h2>
        <p>Antal inlämnade plagg: <?php echo $seller['total_items_submitted']; ?> st</p>
        <p>Antal sålda plagg: <?php echo $seller['total_items_sold']; ?> st</p>
        <p>Totalt sålt för: <?php echo $seller['total_sales_amount']; ?> kr</p>

        <?php
        // Hämta alla plagg som säljaren lämnat in
        $itemsStatement = $pdo->prepare("SELECT * FROM items WHERE seller_id = :seller_id");
        $itemsStatement->bindParam(":seller_id", $seller_id);
        $itemsStatement->execute();
        $items = $itemsStatement->fetchAll(PDO::FETCH_ASSOC);

        if (count($items) > 0) {
            echo "<h3>Plagg inlämnade av " . $seller['name'] . "</h3>";
            foreach ($items as $item) {
                echo "<p>Produkt ID: " . $item['item_id'] . "</p>";
                echo "<p>Produkt namn: " . $item['name'] . "</p>";
                echo "<p>Inlämmnat: " . $item['submitted_date'] . "</p>";
                echo "<p>Såld: " . ($item['sold'] ? 'Ja' : 'Nej') . "</p>";
                echo "<p>Pris: " . $item['price'] . "</p>";
                echo "<br>";
            }
        } else {
            echo "<h3>Inga plagg inlämnade av " . $seller['name'] . "</h3>";
        }
        ?>
    </div>
</body>
</html>



        <?php
    } else {
        echo "<h1>Säljaren hittades inte.</h1>";
    }
} else {
    echo "<h1>Inget säljar-ID angavs.</h1>";
}
?>