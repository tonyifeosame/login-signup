<?php
require_once 'include2/config_session_inc.php'; // Corrected file extension
require_once 'include2/signup_view_inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h3>Signup</h3>
    <form action="include2/signup_inc.php" method="post">
        <?php
        signup_inputs(); // Generates input fields
        ?>
        <button type="submit">Signup</button>
        <?php
        check_signup_errors(); // Displays any signup errors
        ?>
    </form>
</div>
</body>
</html>
