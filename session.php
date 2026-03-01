<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['login']);
}

// Check if admin is logged in
function isAdmin() {
    return isset($_SESSION['login']) && isset($_SESSION['fname']);
}

// Redirect to login if not authenticated
function requireLogin($redirectTo = 'index.php') {
    if (!isLoggedIn()) {
        header("Location: $redirectTo");
        exit;
    }
}

// Redirect to admin login if not authenticated
function requireAdminLogin() {
    if (!isLoggedIn()) {
        header("Location: adminlogin.php");
        exit;
    }
}

// Logout user
function logout($redirectTo = 'index.php') {
    session_unset();
    session_destroy();
    header("Location: $redirectTo");
    exit;
}
