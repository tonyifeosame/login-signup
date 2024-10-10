<?php
declare(strict_types=1);

if (!function_exists('is_input_empty')) {
    function is_input_empty(string $username, string $pwd): bool {
        return empty($username) || empty($pwd);
    }
}

if (!function_exists('is_username_invalid')) {
    function is_username_invalid(bool|array $result): bool {
        return !$result;
    }
}

if (!function_exists('is_password_wrong')) {
    function is_password_wrong(string $pwd, string $hashedpwd): bool {
        return !password_verify($pwd, $hashedpwd);
    }
}
?>
