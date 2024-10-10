<?php

declare(strict_types=1);

// Check if inputs are empty
function is_input_empty(string $username, string $pwd, string $email): bool {
    return empty($username) || empty($pwd) || empty($email);
}

// Check if the email is invalid
function is_email_invalid(string $email): bool {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Check if the username is already taken
function is_username_taken(object $pdo, string $username): bool {
    return get_username($pdo, $username) !== null;
}

// Check if the email is already registered
function is_email_registered(object $pdo, string $email): bool {
    return get_email($pdo, $email) !== null;
}

// Create a new user
function create_user(object $pdo, string $pwd, string $username, string $email): void {
    set_user($pdo, $pwd, $username, $email); // Corrected the function name to set_user
}
