<?php
// require 'connect.php';
require 'partials/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    // Validera och spara den nya säljaren i databasen
    if (!empty($name)) {
        $pdo = connect();
        $stmt = $pdo->prepare('INSERT INTO sellers (name) VALUES (:name)');
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        header('Location: list-sellers.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lägg till säljare</title>
    <link rel="stylesheet" href="css/add-seller.css">
</head>
<body>
    <a href="index.php" class="back-to-menu">Tillbaka till menyn</a>
    <h1>Lägg till säljare</h1>
    <form method="post">
        <label for="name">Säljarens namn:</label>
        <input type="text" id="name" name="name">
        <button type="submit">Lägg till</button>
    </form>

</body>
</html>
