<?php require 'partials/connect.php';

$pdo = connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hämta data från formuläret och sanera dem
    $name = sanitizeInput($_POST['name']);
    $sellerId = sanitizeInput($_POST['seller']);
    $price = sanitizeInput($_POST['price']);

    try {
        // SQL-förfrågan för att lägga till data i databasen
        $stmt = $pdo->prepare("INSERT INTO items (name, seller_id, submitted_date, price) VALUES (?, ?, NOW(), ?)");
        $stmt->execute([$name, $sellerId, $price]);

        echo "Plagget har lagts till!";
    } catch (PDOException $e) {
        echo "Ett fel inträffade: " . $e->getMessage();
    }
}

// Hämta alla säljare från databasen
$stmt = $pdo->query("SELECT seller_id, name FROM sellers");
$sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lägg till plagg</title>
    <link rel="stylesheet" href="css/add-item.css">
</head>
<body>
<a href="index.php" class="back-to-menu">Tillbaka till menyn</a>

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

<?php
// Sanera inmatad data
function sanitizeInput($input)
{
    $sanitizedInput = trim($input);
    $sanitizedInput = stripslashes($sanitizedInput);
    $sanitizedInput = htmlspecialchars($sanitizedInput);
    return $sanitizedInput;
}
?>
</body>
</html>
