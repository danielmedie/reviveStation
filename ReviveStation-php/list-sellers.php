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

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            background-color: #fff;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .seller-name {
            font-weight: bold;
        }

        .info-button {
            padding: 6px 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .info-button:hover {
            background-color: #45a049;
        }
    </style>
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
