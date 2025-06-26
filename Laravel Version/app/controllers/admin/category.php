<?php

$heading = 'Category Management';
if (isset($_GET['action']) && $_GET['action'] === 'create') {
    $heading = 'Create New Category';
    require "app/views/admin/category/create.view.php";
    return;
}

// Handle view action for a single category
if (isset($_GET['action']) && $_GET['action'] === 'view' && isset($_GET['id'])) {
    $heading = 'View Category';
    require "app/views/admin/category/single.view.php";
    return;
}

// Handle update action
if (isset($_GET['action']) && $_GET['action'] === 'update' && !isset($_POST['id'])) {
    $heading = 'Update Category';
    require "app/views/admin/category/update.view.php";
    return;
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $category = new Category();
    $category->deleteCategory($id);
    header("Location: /admin/category");
    exit;
}

//if the method is POST, handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if it's an update
    if (isset($_GET['action']) && $_GET['action'] === 'update' && isset($_POST['id'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $currentImage = $_POST['current_image'];

        // Check if a new image was uploaded
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            global $config;
            $uploadDir = $config['uploads']['path'] . 'categories/';
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

        // Update the category
        $category = new Category();
        $category->updateCategory($id, $name, $description, $imagePath);

        // Redirect back to the category view
        header("Location: /admin/category");
        exit;
    } else {
        // Handle new category creation
        $name = $_POST['name'];
        $description = $_POST['description'];
        $usersId = $_SESSION['user_id'];

        // File upload
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            global $config;
            $uploadDir = $config['uploads']['path'] . 'categories/';
            //get unique file name from every upload
            $fileName = time(). uniqid($_FILES["image"]["name"]) . '-' . basename($_FILES["image"]["name"]);
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
                echo "<p>File uploaded successfully: <a href='$targetPath'>$fileName</a></p>";
                //Save the image path to $imagePath
                $imagePath = $targetPath;
                // Create a new category instance
                $category = new Category();
                // Set the category data
                $category->createCategory(
                    $name,
                    $description,
                    $imagePath,
                    $usersId
                );

                //get back to the category view
                header("Location: /admin/category");
                exit;

            } else {
                echo "<p>File upload failed.</p>";
            }
        } else {
            echo "<p>No file uploaded.</p>";
        }
    }
}

require "app/views/admin/category/view.view.php";
