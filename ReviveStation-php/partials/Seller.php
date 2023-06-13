<?php
class Seller {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllSellers() {
     
        $stmt = $this->pdo->prepare("SELECT * FROM sellers ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSellerInfo($sellerId) {
        $result = [
            'num_items_received' => 0,
            'num_items_sold' => 0,
            'total_amount_sold' => 0
        ];

        try {
            // Hämtar antalet poster som säljaren har mottagit
            $stmtReceived = $this->pdo->prepare("SELECT COUNT(*) AS num_items_received FROM items WHERE seller_id = ?");
            $stmtReceived->execute([$sellerId]);
            $resultReceived = $stmtReceived->fetch(PDO::FETCH_ASSOC);

            // Hämtar antalet poster som säljaren har sålt och den totala försäljningsmängden
            $stmtSold = $this->pdo->prepare("SELECT COUNT(*) AS num_items_sold, SUM(price) AS total_amount_sold FROM items WHERE seller_id = ? AND sold = 1");
            $stmtSold->execute([$sellerId]);
            $resultSold = $stmtSold->fetch(PDO::FETCH_ASSOC);

            // Uppdaterar resultatarrayen med de hämtade värdena om de finns
            if ($resultReceived && $resultReceived['num_items_received']) {
                $result['num_items_received'] = $resultReceived['num_items_received'];
            }

            if ($resultSold && $resultSold['num_items_sold'] && $resultSold['total_amount_sold']) {
                $result['num_items_sold'] = $resultSold['num_items_sold'];
                $result['total_amount_sold'] = $resultSold['total_amount_sold'];
            }
        } catch (PDOException $e) {
            echo "Ett fel inträffade: " . $e->getMessage();
        }

        return $result;
    }

    public function getSellerItems($sellerId) {
        $items = [];

        try {
            // Hämtar alla poster som tillhör en säljare
            $stmt = $this->pdo->prepare("SELECT * FROM items WHERE seller_id = ?");
            $stmt->execute([$sellerId]);
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Ett fel inträffade: " . $e->getMessage();
        }

        return $items;
    }
}

?>
