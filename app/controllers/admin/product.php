<?php

$heading = 'Product Management';
if (isset($_GET['action']) && $_GET['action'] === 'create') {
    $heading = 'Create New Product';
    require "app/views/admin/product/create.view.php";
    return;
}

//if the method is POST, handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Handle form submission
    $name = $_POST['name'];
    $description = $_POST['description'];
    $usersId = $_SESSION['user_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];

    // File upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        global $config;
        $uploadDir = $config['uploads']['path'] . 'products/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . uniqid($_FILES["image"]["name"]) . '-' . basename($_FILES["image"]["name"]);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            echo "<p>File uploaded successfully: <a href='$targetPath'>$fileName</a></p>";
            //Save the image path to $imagePath
            $imagePath = $targetPath;
            //Save the data to the database
            global $db;
            $query = "INSERT INTO products (name, description, image_url, user_id, price, quantity, category_id) VALUES (:name, :description, :image_url, :user_id, :price, :quantity, :category_id)";
            $params = [
                ':name' => $name,
                ':description' => $description,
                ':image_url' => $imagePath,
                ':user_id' => $usersId,
                ':price' => $price,
                ':quantity' => $quantity,
                ':category_id' => $category
            ];
            $db->query($query, $params);

            //get back to the product view
            header("Location: /admin/product");
            exit;

        } else {
            echo "<p>File upload failed.</p>";
        }
    } else {
        echo "<p>No file uploaded.</p>";
    }

    // Redirect or display success message
    // header("Location: /admin/category");
    // exit;

    return;
}

if (isset($_GET['action']) && $_GET['action'] === 'view') {
    require "app/views/admin/product/single.view.php";
    return;
}

require "app/views/admin/product/view.view.php";
