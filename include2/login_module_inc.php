<?php
declare(strict_types=1);

function get_user(object $pdo, string $username): ?array {
    $query = 'SELECT * FROM users WHERE username = :username';
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ?: null; // Return null if no result found
}
?>
