<?php
// Sanitize string input
function sanitizeString($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Sanitize email
function sanitizeEmail($email) {
    return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}

// Validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Validate phone number (10 digits)
function validatePhone($phone) {
    return preg_match('/^\d{10}$/', $phone);
}

// Validate age (18+)
function validateAge($age) {
    return is_numeric($age) && $age >= 18 && $age <= 120;
}

// Validate blood group
function validateBloodGroup($bloodgroup) {
    $validGroups = ['A positive', 'A negative', 'B positive', 'B negative', 
                    'AB positive', 'AB negative', 'O positive', 'O negative'];
    return in_array($bloodgroup, $validGroups);
}

// Sanitize integer
function sanitizeInt($input) {
    return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
}

// Get POST value safely
function getPost($key, $default = '') {
    return $_POST[$key] ?? $default;
}

// Get GET value safely
function getGet($key, $default = '') {
    return $_GET[$key] ?? $default;
}
