<?php

class Category
{
    private $name;
    private $description;
    private $image_url;
    private $user_id;

    public function __construct()
    {

    }

    public function getCategoryDataById($id)
    {
        global $db;
        $query = "SELECT * FROM categories WHERE id = :id";
        $params = [':id' => $id];
        return $db->query($query, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCategories()
    {
        global $db; // Use the global database instance
        $query = "SELECT * FROM categories";
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createCategory($name, $description, $image_url, $user_id)
    {
        global $db; // Use the global database instance
        $query = "INSERT INTO categories (name, description, image_url, user_id, created_at) 
                  VALUES (:name, :description, :image_url, :user_id, NOW())";
        $params = [
            ':name' => $name,
            ':description' => $description,
            ':image_url' => $image_url,
            ':user_id' => $user_id
        ];
        return $db->query($query, $params);
    }

    public function updateCategory($id, $name, $description, $image_url)
    {
        global $db;
        $query = "UPDATE categories SET name = :name, description = :description, image_url = :image_url WHERE id = :id";
        $params = [
            ':id' => $id,
            ':name' => $name,
            ':description' => $description,
            ':image_url' => $image_url
        ];
        return $db->query($query, $params);
    }

    public function deleteCategory($id)
    {
        global $db;
        $query = "DELETE FROM categories WHERE id = :id";
        $params = [':id' => $id];
        return $db->query($query, $params);
    }
}
