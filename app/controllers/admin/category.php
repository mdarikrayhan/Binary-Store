<?php

$heading = 'Category Management';
if (isset($_GET['action']) && $_GET['action'] === 'create') {
    $heading = 'Create New Category';
    require "app/views/admin/category/create.view.php";
    return;
}

//if the method is POST, handle the form submission

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
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

require "app/views/admin/category/view.view.php";