<?php
require 'partials/connect.php';

$pdo = connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $sellerId = $_POST['seller'];
    $price = $_POST['price'];

    try {
        $stmt = $pdo->prepare("INSERT INTO items (name, seller_id, submitted_date, price) VALUES (?, ?, NOW(), ?)");
        $stmt->execute([$name, $sellerId, $price]);

        echo "Plagget har lagts till!";
    } catch (PDOException $e) {
        echo "Ett fel inträffade: " . $e->getMessage();
    }
}

$stmt = $pdo->query("SELECT seller_id, name FROM sellers");
$sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lägg till plagg</title>
</head>
<body>
    <h1>Lägg till plagg</h1>
    <form method="POST">
        <label for="name">Namn:</label>
        <input type="text" name="name" id="name" required>

        <label for="seller">Säljare:</label>
        <select name="seller" id="seller" required>
            <?php foreach ($sellers as $seller): ?>
                <option value="<?php echo $seller['seller_id']; ?>"><?php echo $seller['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="price">Pris:</label>
        <input type="text" name="price" id="price" pattern="[0-9]+(\.[0-9]+)?" title="Ange ett giltigt prisformat (ex. 10 eller 10.99)" required>

        <button type="submit">Lägg till</button>
    </form>
</body>
</html>

