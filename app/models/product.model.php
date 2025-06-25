<?php
class Product
{
    private $name;
    private $description;
    private $imageUrl;
    private $price;
    private $quantity;
    private $categoryId;
    private $usersId;
    private $createdAt;

    public function __construct()
    {

    }
    public function createProduct($name, $description, $imageUrl, $price, $quantity, $categoryId, $usersId)
    {
        global $db;
        $query = "INSERT INTO products (name, description, image_url, price, quantity, category_id, user_id) VALUES (:name, :description, :image_url, :price, :quantity, :category_id, :user_id)";
        $params = [
            ':name' => $name,
            ':description' => $description,
            ':image_url' => $imageUrl,
            ':price' => $price,
            ':quantity' => $quantity,
            ':category_id' => $categoryId,
            ':user_id' => $usersId
        ];
        return $db->query($query, $params);
    }
    public function getAllProducts()
    {
        global $db;
        $query = "SELECT * FROM products";
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProductById($id)
    {
        global $db;
        $query = "SELECT * FROM products WHERE id = :id";
        $params = [':id' => $id];
        return $db->query($query, $params)->fetch(PDO::FETCH_ASSOC);
    }
    public function getProductsByCategoryId($categoryId)
    {
        global $db;
        $query = "SELECT * FROM products WHERE category_id = :category_id";
        $params = [':category_id' => $categoryId];
        return $db->query($query, $params)->fetchAll(PDO::FETCH_ASSOC);
    }
}