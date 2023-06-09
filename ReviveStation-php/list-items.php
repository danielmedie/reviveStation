<?php
require 'partials/connect.php';

$pdo = new PDO('mysql:host=localhost;dbname=revivestation;charset=utf8', 'root', 'abc123');

// Uppdatera sold-status om formuläret har skickats
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($_POST['sold'] as $itemId) {
    $stmt = $pdo->prepare("UPDATE items SET sold = 1 WHERE item_id = ?");
    $stmt->execute([$itemId]);
  }
}

$stmt = $pdo->query("SELECT items.*, sellers.name AS seller_name FROM items INNER JOIN sellers ON items.seller_id = sellers.seller_id");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Plagglista</title>
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

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    td input[type="checkbox"] {
      transform: scale(1.5);
    }

    td a {
      color: #333;
      text-decoration: none;
    }

    td a:hover {
      text-decoration: underline;
    }

    button[type="submit"] {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
    }

    button[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <h1>Plagglista</h1>
  <form method="POST">
    <table>
      <thead>
        <tr>
          <th>Namn</th>
          <th>Säljare</th>
          <th>Inlämningsdatum</th>
          <th>Såld</th>
          <th>Åtgärder</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $item): ?>
          <tr>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['seller_name']; ?></td>
            <td><?php echo $item['submitted_date']; ?></td>
            <td>
              <input type="checkbox" name="sold[]" value="<?php echo $item['item_id']; ?>" <?php echo $item['sold'] ? 'checked' : ''; ?>>
            </td>
            <td>
              <a href="item.php?item_id=<?php echo $item['item_id']; ?>">Redigera</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <button type="submit">Uppdatera</button>
  </form>
</body>
</html>
