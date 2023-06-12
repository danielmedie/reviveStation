<?php
require 'partials/connect.php';

$pdo = connect();
$stmt = $pdo->query('SELECT * FROM sellers ORDER BY name');
$sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista över säljare</title>
    <link rel="stylesheet" href="css/list-sellers.css">
</head>
<body>
    <h1>Lista över säljare</h1>
    <ul>
        <?php foreach ($sellers as $seller) : ?>
            <li>
                <span class="seller-name"><?php echo $seller['name']; ?></span>
                <a class="info-button" href="seller-info.php?seller_id=<?php echo $seller['seller_id']; ?>">Info</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
