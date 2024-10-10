<?php
//$dsn = 'mysql:host=localhost;dbname=myfirstdatabase';
$dbusername = 'root';
$dbpassword = '';
$host = 'localhost';
$dbname='myseconddatabase';
try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Connection successful
    // Optionally, you can add a log or message to confirm successful connection
    // echo "Connection successful"; // You can uncomment for debugging

} catch (PDOException $e) {
    // Handle connection error
    echo 'Connection failed: ' . $e->getMessage();
}
