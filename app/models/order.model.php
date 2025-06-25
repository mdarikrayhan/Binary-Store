<?php
class Order
{

    private $id;
    private $user_id;
    private $order_status;
    private $cost;
    private $shipping_address;
    private $shipping_phone;
    private $quantity;
    private $created_at;
    public function __construct()
    {
        // Constructor logic if needed
    }
    public function createOrder($product_id, $user_id, $order_status, $cost, $shipping_address, $shipping_phone, $quantity)
    {
        global $db;
        $query = "INSERT INTO orders (product_id, user_id, order_status, cost, shipping_address, shipping_phone, quantity) VALUES (:product_id, :user_id, :order_status, :cost, :shipping_address, :shipping_phone, :quantity)";
        $params = [
            ':product_id' => $product_id,
            ':user_id' => $user_id,
            ':order_status' => $order_status,
            ':cost' => $cost,
            ':shipping_address' => $shipping_address,
            ':shipping_phone' => $shipping_phone,
            ':quantity' => $quantity
        ];
        return $db->query($query, $params);
    }
    public function getAllOrders()
    {
        global $db;
        $query = "SELECT * FROM orders";
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrdersByUserId($user_id)
    {
        global $db;
        $query = "SELECT * FROM orders WHERE user_id = :user_id";
        $params = [':user_id' => $user_id];
        return $db->query($query, $params)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrderById($id)
    {
        global $db;
        $query = "SELECT * FROM orders WHERE id = :id";
        $params = [':id' => $id];
        return $db->query($query, $params)->fetch(PDO::FETCH_ASSOC);
    }
}
