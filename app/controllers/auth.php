<?php
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
// echo "URI: $uri\n";
// echo "Method: " . $_SERVER['REQUEST_METHOD'] . "\n";
$heading = "User Management";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'signin') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Validate the input data
        if (empty($email) || empty($password)) {
            // Handle the error, e.g., redirect back with an error message
            header('Location: /signin?error=Please fill in all fields');
            exit();
        }

        // Create a new User instance
        $user = new User();
        $checkLogin = $user->login($email, $password);
        if ($checkLogin) {
            global $db;
            $query = "SELECT * FROM users WHERE email = :email";
            $params = [':email' => $email];
            $userData = $db->query($query, $params)->fetch();

            // Store user data in session
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['user_role'] = $userData['role'];
            $_SESSION['user_email'] = $userData['email'];
            $_SESSION['user_first_name'] = $userData['first_name'];
            $_SESSION['user_last_name'] = $userData['last_name'];

            header('Location: /');
            exit();

        } else {
            header('Location: /signin?error=Invalid email or password');
            exit();
        }

    }

    if ($_POST['action'] === 'signup') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $division = $_POST['division'];
        $district = $_POST['district'];
        $upazila = $_POST['upazila'];
        $zipcode = $_POST['zipcode'];

        // Validate the input data
        if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($phone) || empty($division) || empty($district) || empty($upazila) || empty($zipcode)) {
            // Handle the error, e.g., redirect back with an error message
            header('Location: /signup&error=Please fill in all fields');
            exit();
        }

        // Create a new User instance
        $user = new User();
        // Save the user to the database
        $user->save($first_name, $last_name, $email, $password, $phone, $division, $district, $upazila, $zipcode);
        // Redirect to the login page
        header('Location: /signin');
        exit();
    }
    if ($_POST['action'] === 'logout') {
        // Destroy the session to log out the user
        session_destroy();
        header('Location: /');
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($uri === '/profile') {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /signin');
            exit();
        }
        // Load the profile view
        require "app/views/auth/profile.view.php";
        exit();
    }
    if ($uri === '/signin') {
        // If the user is already logged in, redirect to the home page
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            exit();
        }
        require "app/views/auth/signin.view.php";
        exit();
    }
    if ($uri === '/signup') {
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            exit();
        }
        require "app/views/auth/signup.view.php";
        exit();
    }
}


//require "views/signin.view.php";

