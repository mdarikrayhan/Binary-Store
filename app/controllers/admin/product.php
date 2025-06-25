<?php

$heading = 'Product Management';
if (isset($_GET['action']) && $_GET['action'] === 'create') {
    $heading = 'Create New Product';
    require "app/views/admin/product/create.view.php";
    return;
}

// Handle update action
if (isset($_GET['action']) && $_GET['action'] === 'update' && !isset($_POST['id'])) {
    $heading = 'Update Product';
    require "app/views/admin/product/update.view.php";
    return;
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = new Product();
    $product->deleteProduct($id);
    header("Location: /admin/product");
    exit;
}

//if the method is POST, handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if it's an update
    if (isset($_GET['action']) && $_GET['action'] === 'update' && isset($_POST['id'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];
        $currentImage = $_POST['current_image'];

        // Check if a new image was uploaded
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            global $config;
            $uploadDir = $config['uploads']['path'] . 'products/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . uniqid($_FILES["image"]["name"]) . '-' . basename($_FILES["image"]["name"]);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
                $imagePath = $targetPath;
            } else {
                echo "<p>File upload failed.</p>";
                $imagePath = $currentImage;
            }
        } else {
            // Keep the current image
            $imagePath = $currentImage;
        }

        // Update the product
        $product = new Product();
        $product->updateProduct($id, $name, $description, $imagePath, $price, $quantity, $category);

        // Redirect back to the product view
        header("Location: /admin/product");
        exit;
    } else {
        // Handle new product creation
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
                $product = new Product();
                $product->createProduct($name, $description, $imagePath, $price, $quantity, $category, $usersId);

                //get back to the product view
                header("Location: /admin/product");
                exit;

            } else {
                echo "<p>File upload failed.</p>";
            }
        } else {
            echo "<p>No file uploaded.</p>";
        }
    }

    return;
}

if (isset($_GET['action']) && $_GET['action'] === 'view') {
    require "app/views/admin/product/single.view.php";
    return;
}

require "app/views/admin/product/view.view.php";
