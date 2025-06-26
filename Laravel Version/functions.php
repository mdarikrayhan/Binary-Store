<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}

function redirect($path) {
    header("Location: {$path}");
    exit();
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

function getErrorMessage() {
    if (isset($_GET['error'])) {
        return htmlspecialchars($_GET['error']);
    }
    return null;
}

function getSuccessMessage() {
    if (isset($_GET['success'])) {
        return htmlspecialchars($_GET['success']);
    }
    return null;
}
