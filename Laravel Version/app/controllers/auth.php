<?php
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$heading = "User Management";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'signin') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validate the input data
        if (empty($email) || empty($password)) {
            redirect('/signin?error=Please fill in all fields');
        }

        // Validate email format
        if (!validateEmail($email)) {
            redirect('/signin?error=Please enter a valid email address');
        }

        // Create a new User instance
        $user = new User();
        $checkLogin = $user->login($email, $password);

        if ($checkLogin) {
            // Get user data using the model
            $userData = $user->getUserByEmail($email);

            // Store user data in session
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['user_role'] = $userData['role'];
            $_SESSION['user_email'] = $userData['email'];
            $_SESSION['user_first_name'] = $userData['first_name'];
            $_SESSION['user_last_name'] = $userData['last_name'];

            redirect('/');
        } else {
            redirect('/signin?error=Invalid email or password');
        }
    }

    if ($_POST['action'] === 'signup') {
        $first_name = $_POST['first_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $division = $_POST['division'] ?? '';
        $district = $_POST['district'] ?? '';
        $upazila = $_POST['upazila'] ?? '';
        $zipcode = $_POST['zipcode'] ?? '';

        // Validate the input data
        if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || 
            empty($phone) || empty($division) || empty($district) || empty($upazila) || empty($zipcode)) {
            redirect('/signup?error=Please fill in all fields');
        }

        // Validate email format
        if (!validateEmail($email)) {
            redirect('/signup?error=Please enter a valid email address');
        }

        // Create a new User instance
        $user = new User();

        // Check if email already exists
        if ($user->emailExists($email)) {
            redirect('/signup?error=Email already exists');
        }

        // Save the user to the database
        $result = $user->save($first_name, $last_name, $email, $password, $phone, $division, $district, $upazila, $zipcode);

        if ($result) {
            redirect('/signin?success=Account created successfully. Please sign in.');
        } else {
            redirect('/signup?error=Failed to create account. Please try again.');
        }
    }

    if ($_POST['action'] === 'logout') {
        // Destroy the session to log out the user
        session_destroy();
        redirect('/');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($uri === '/profile') {
        // Check if the user is logged in
        if (!isLoggedIn()) {
            redirect('/signin');
        }
        // Load the profile view
        require "app/views/auth/profile.view.php";
        exit();
    }

    if ($uri === '/signin') {
        // If the user is already logged in, redirect to the home page
        if (isLoggedIn()) {
            redirect('/');
        }
        require "app/views/auth/signin.view.php";
        exit();
    }

    if ($uri === '/signup') {
        if (isLoggedIn()) {
            redirect('/');
        }
        require "app/views/auth/signup.view.php";
        exit();
    }

    if ($uri === '/logout') {
        // Destroy the session to log out the user
        session_destroy();
        redirect('/');
    }
}
