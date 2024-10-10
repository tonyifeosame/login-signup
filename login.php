<?php
require_once 'include2/config_session_inc.php';
require_once 'include2/login_view_inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="form-container">
    <h3>Login</h3>
    <form action="include2/login_inc.php" method="post">
        <input type="text" name="username" placeholder="Username" autocomplete="off" required>
        <input type="password" name="pwd" placeholder="Password" autocomplete="off" required>
        <button type="submit">Login</button>
        <p>Click here to signup <a href="index.php">Signup</a></p>
    </form>
    <?php
    check_login_errors();
    ?>
</div>
</body>
</html>
