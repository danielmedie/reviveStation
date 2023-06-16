<?php

require_once 'partials/Seller.php';

class TopSeller extends Seller
{
    public function getTopSellers($limit = 3)
    {
        $stmt = $this->pdo->prepare("
            SELECT sellers.*, COUNT(items.sold) AS total_items_sold
            FROM sellers
            LEFT JOIN items ON sellers.seller_id = items.seller_id
            WHERE items.sold = 1
            GROUP BY sellers.seller_id
            ORDER BY total_items_sold DESC
            LIMIT ?
        ");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
