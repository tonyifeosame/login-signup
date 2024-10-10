<?php
declare(strict_types=1);

function check_login_errors(): void {
    if (isset($_SESSION['errors_login'])) {
        $errors = $_SESSION['errors_login'];

        echo '<br>';

        foreach ($errors as $error) {
            echo '<p class="form-error">' . htmlspecialchars($error) . '</p>';
        }

        unset($_SESSION["errors_login"]);
    } elseif (isset($_GET['login']) && $_GET['login'] === 'success') {
        echo '<br>';
        echo '<p class="form-success">Login success!</p>';
    }
}
?>
