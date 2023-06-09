<?php
require 'partials/connect.php';

$pdo = new PDO('mysql:host=localhost;dbname=revivestation;charset=utf8', 'root', 'abc123');

$stmt = $pdo->query("SELECT items.*, sellers.name AS seller_name FROM items INNER JOIN sellers ON items.seller_id = sellers.seller_id");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Plagglista</title>
  <link rel="stylesheet" href="css/list-item.css">
</head>
<body>
  <a href="index.php" class="back-to-menu">Tillbaka till menyn</a>

  <h1>Plagglista</h1>
  <form>
    <table>
      <thead>
        <tr>
          <th>Namn</th>
          <th>Säljare</th>
          <th>Inlämningsdatum</th>
          <th>Pris</th>
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
            <td><?php echo $item['price']; ?></td>
            <td>
              <input type="checkbox" disabled <?php echo $item['sold'] ? 'checked' : ''; ?>>
            </td>
            <td>
              <a href="item.php?item_id=<?php echo $item['item_id']; ?>">Redigera</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </form>
</body>
</html>
