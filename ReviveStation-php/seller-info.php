<?php
require 'partials/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['seller_id'])) {
    $sellerId = $_GET['seller_id'];

    try {
        // Hämta säljarens information från sellers-tabellen
        $stmt = $pdo->prepare("SELECT * FROM sellers WHERE seller_id = ?");
        $stmt->execute([$sellerId]);
        $seller = $stmt->fetch();

        // Hämta antal inlämnade plagg
        $stmt = $pdo->prepare("SELECT COUNT(*) AS total_items_submitted FROM items WHERE seller_id = ?");
        $stmt->execute([$sellerId]);
        $result = $stmt->fetch();
        $totalItemsSubmitted = $result['total_items_submitted'];

        // Hämta antal sålda plagg
        $stmt = $pdo->prepare("SELECT COUNT(*) AS total_items_sold FROM items WHERE seller_id = ? AND sold = 1");
        $stmt->execute([$sellerId]);
        $result = $stmt->fetch();
        $totalItemsSold = $result['total_items_sold'];

        // Hämta total försäljning
        $stmt = $pdo->prepare("SELECT SUM(price) AS total_sales_amount FROM items WHERE seller_id = ? AND sold = 1");
        $stmt->execute([$sellerId]);
        $result = $stmt->fetch();
        $totalSalesAmount = $result['total_sales_amount'];

        // Hämta plagg inlämnade av säljaren
        $stmt = $pdo->prepare("SELECT * FROM items WHERE seller_id = ?");
        $stmt->execute([$sellerId]);
        $items = $stmt->fetchAll();
    } catch (PDOException $e) {
        die('Ett fel inträffade: ' . $e->getMessage());
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['seller_id'])) {
    $sellerId = $_POST['seller_id'];

    try {
        // Ta bort alla relaterade poster i items-tabellen för den aktuella säljaren
        $stmtDeleteItems = $pdo->prepare("DELETE FROM items WHERE seller_id = ?");
        $stmtDeleteItems->execute([$sellerId]);

        // Ta bort säljaren från sellers-tabellen
        $stmtDeleteSeller = $pdo->prepare("DELETE FROM sellers WHERE seller_id = ?");
        $stmtDeleteSeller->execute([$sellerId]);

        // Omdirigera till listan över säljare efter borttagning
        header("Location: list-sellers.php");
        exit();
    } catch (PDOException $e) {
        die('Ett fel inträffade: ' . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Säljarinformation</title>
    <link rel="stylesheet" href="css/seller-info.css">
</head>
<body>
    <a class="back-button" href="list-sellers.php">Tillbaka</a>
    <h1>Säljarinformation</h1>

    <div class="seller-info">
        <p><strong>Namn:</strong> <?php echo $seller['name']; ?></p>
        <p><strong>Antal inlämnade plagg:</strong> <?php echo $totalItemsSubmitted; ?> st</p>
        <p><strong>Antal sålda plagg:</strong> <?php echo $totalItemsSold; ?> st</p>
        <p><strong>Totalt sålt för:</strong> <?php echo $totalSalesAmount; ?> kr</p>
        <form method="POST" action="delete-seller.php">
            <input type="hidden" name="seller_id" value="<?php echo $seller['seller_id']; ?>">
            <button type="submit" class="delete-button">Ta bort säljare</button>
        </form>
    </div>

    <h2>Plagg inlämnade av <?php echo $seller['name']; ?>:</h2>

    <?php if (isset($items) && count($items) > 0) : ?>
        <?php foreach ($items as $item) : ?>
            <div class="item-container">
                <p><strong>Namn:</strong> <?php echo $item['name']; ?></p>
                <p><strong>Item ID:</strong> <?php echo $item['item_id']; ?></p>
                <p><strong>Inlämningsdatum:</strong> <?php echo $item['submitted_date']; ?></p>
                <p><strong>Såld:</strong> <?php echo $item['sold'] ? 'Ja' : 'Nej'; ?></p>
                <p><strong>Pris:</strong> <?php echo $item['price']; ?> kr</p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Inga plagg inlämnade.</p>
    <?php endif; ?>

</body>
</html>
