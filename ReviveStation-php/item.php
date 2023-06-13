<?php
require 'partials/connect.php';

$pdo = new PDO('mysql:host=localhost;dbname=revivestation;charset=utf8', 'root', 'abc123');

// Kontrollera om formuläret har skickats för att uppdatera information

// Tar bort
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['delete'])) {
    $itemId = $_POST['item_id'];

    $stmt = $pdo->prepare("DELETE FROM items WHERE item_id = ?");
    $stmt->execute([$itemId]);

    echo "Produkten har tagits bort!";
    exit;
  } else {
// Uppdaterar 
    $itemId = $_POST['item_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sold = isset($_POST['sold']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE items SET name = ?, price = ?, sold = ? WHERE item_id = ?");
    $stmt->execute([$name, $price, $sold, $itemId]);

    echo "Produktinformationen har uppdaterats!";
  }
}

// Kontrollera om item_id finns i URL-parametrarna
if (isset($_GET['item_id'])) {
  $itemId = $_GET['item_id'];

  $stmt = $pdo->prepare("SELECT * FROM items WHERE item_id = ?");
  $stmt->execute([$itemId]);
  $item = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($item) {
    $name = $item['name'];
    $price = $item['price'];
    $sold = $item['sold'];
  } else {
    echo "Produkten hittades inte.";
    exit;
  }

  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>Redigera produkt</title>
    <link rel="stylesheet" href="css/item.css">
  </head>
  <body>
    <a href="list-items.php" class="back-btn">Tillbaka</a>
    <h1>Redigera produkt</h1>
    <div class="form-container">
      <form method="POST">
        <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">

        <label for="name">Namn:</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>" required>

        <label for="price">Pris:</label>
        <input type="text" name="price" id="price" value="<?php echo $price; ?>" required>

        <label for="sold">Såld:</label>
        <div class="checkbox-container">
          <input type="checkbox" name="sold" id="sold" <?php echo $sold == 1 ? 'checked' : ''; ?>>
        </div>

        <button type="submit">Spara ändringar</button>
        <button type="submit" name="delete" class="delete-btn">Ta bort plagg</button>
      </form>
    </div>
  </body>
  </html>

  <?php
} else {
  echo "Inget item_id skickades med i URL-parametrarna.";
  exit;
}
?>
