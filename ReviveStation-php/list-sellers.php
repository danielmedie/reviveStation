<?php
require 'partials/connect.php';

$pdo = connect(); 
$stmt = $pdo->query('SELECT * FROM sellers ORDER BY name'); // Sorterar efter namn
$sellers = $stmt->fetchAll(PDO::FETCH_ASSOC); 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista över säljare</title>
    <link rel="stylesheet" href="css/list-sellers.css">
</head>
<body>
<a href="index.php" class="back-to-menu">Tillbaka till menyn</a>

    <h1>Lista över säljare</h1>
    <ul>
        <!-- Loopar igenom varje säljare i $sellers-arrayen -->
        <?php foreach ($sellers as $seller) : ?> 
            <li>
                <span class="seller-name"><?php echo $seller['name']; ?></span> 
                <a class="info-button" href="seller-info.php?seller_id=<?php echo $seller['seller_id']; ?>">Info</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
