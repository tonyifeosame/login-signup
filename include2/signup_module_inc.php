<?php

declare(strict_types=1);

// Get username from the database
function get_username(object $pdo, string $username): ?array {
    $query = 'SELECT username FROM users WHERE username = :username;';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ?: null; // Return null if no result found
}

// Get email from the database
function get_email(object $pdo, string $email): ?array {
    $query = 'SELECT username FROM users WHERE email = :email;';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ?: null; // Return null if no result found
}

function set_user(object $pdo, string $pwd, string $username, string $email): void {
    // Hash the password before storing it
    $options = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $query = 'INSERT INTO users (username, email, pwd) VALUES (:username, :email, :pwd)';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pwd', $hashedPwd, PDO::PARAM_STR);
    $stmt->execute();
}

