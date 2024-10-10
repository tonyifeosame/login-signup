<?php
declare(strict_types=1);

// Session security settings
ini_set('session.use_only_cookies', '1');
ini_set('session.use_strict_mode', '1');
session_set_cookie_params([
    'lifetime' => 1800, // 30 minutes
    'domain' => 'localhost',
    'path' => '/',
    'secure' => false, // Set to true if using HTTPS
    'httponly' => true,
]);

session_start();

if (isset($_SESSION["user_id"])) {
    if (!isset($_SESSION['last_regeneration'])) {
        regenerate_session_id_loggedin();
        $_SESSION["last_regeneration"] = time();
    } else {
        $interval = 60 * 30; // 30 minutes
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id_loggedin();
        }
    }
} else {
    if (!isset($_SESSION['last_regeneration'])) {
        regenerate_session_id();
        $_SESSION["last_regeneration"] = time();
    } else {
        $interval = 60 * 30; // 30 minutes
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id();
        }
    }
}

// Function to regenerate session ID for logged-in users
function regenerate_session_id_loggedin(): void {
    session_regenerate_id(true); // Regenerates the session and deletes the old one
    $userid = $_SESSION["user_id"];
    $newSessionid = session_create_id($userid . '_');
    session_id($newSessionid);
    $_SESSION['last_regeneration'] = time();
}

// Function to regenerate session ID for guest users
function regenerate_session_id(): void {
    session_regenerate_id(true); // Regenerates the session and deletes the old one
    $_SESSION['last_regeneration'] = time();
}
?>
