<?php

class Seller
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllSellers()
    {
        $stmt = $this->pdo->query("SELECT * FROM sellers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSellerById($sellerId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM sellers WHERE seller_id = ?");
        $stmt->execute([$sellerId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalItemsSubmitted($sellerId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total_items_submitted FROM items WHERE seller_id = ?");
        $stmt->execute([$sellerId]);
        $result = $stmt->fetch();
        return $result['total_items_submitted'];
    }

    public function getTotalItemsSold($sellerId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total_items_sold FROM items WHERE seller_id = ? AND sold = 1");
        $stmt->execute([$sellerId]);
        $result = $stmt->fetch();
        return $result['total_items_sold'];
    }

    public function getTotalSalesAmount($sellerId)
    {
        $stmt = $this->pdo->prepare("SELECT SUM(price) AS total_sales_amount FROM items WHERE seller_id = ? AND sold = 1");
        $stmt->execute([$sellerId]);
        $result = $stmt->fetch();
        return $result['total_sales_amount'];
    }

    public function getTopSellers()
    {
        $stmt = $this->pdo->query("SELECT sellers.*, COUNT(items.item_id) AS total_items_sold
            FROM sellers
            INNER JOIN items ON sellers.seller_id = items.seller_id
            WHERE items.sold = 1
            GROUP BY sellers.seller_id
            ORDER BY total_items_sold DESC
            LIMIT 3");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
