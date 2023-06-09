<?php
require 'partials/connect.php';

$pdo = new PDO('mysql:host=localhost;dbname=revivestation;charset=utf8', 'root', 'abc123');

// Kontrollera om formuläret har skickats för att uppdatera information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $itemId = $_POST['item_id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $sold = isset($_POST['sold']) ? 1 : 0;

  $stmt = $pdo->prepare("UPDATE items SET name = ?, price = ?, sold = ? WHERE item_id = ?");
  $stmt->execute([$name, $price, $sold, $itemId]);

  echo "Produktinformationen har uppdaterats!";
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
} else {
  echo "Inget item_id skickades med i URL-parametrarna.";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Redigera produkt</title>
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

    .form-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"], select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 14px;
    }

    button {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
    }

    button:hover {
      background-color: #45a049;
    }

    .back-button {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <h1>Redigera produkt</h1>
  <div class="form-container">
    <form method="POST">
      <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">

      <label for="name">Namn:</label>
      <input type="text" name="name" id="name" value="<?php echo $name; ?>" required>

      <label for="price">Pris:</label>
      <input type="text" name="price" id="price" value="<?php echo $price; ?>" required>

      <label for="sold">Såld:</label>
      <select name="sold" id="sold">
        <option value="0" <?php echo $sold == 0 ? 'selected' : ''; ?>>Nej</option>
        <option value="1" <?php echo $sold == 1 ? 'selected' : ''; ?>>Ja</option>
      </select>

      <button type="submit">Spara ändringar</button>
    </form>
    <a class="back-button" href="list-items.php">Tillbaka</a>
  </div>
</body>
</html>
