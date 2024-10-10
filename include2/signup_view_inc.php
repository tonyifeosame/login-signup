<?php

declare(strict_types=1);

function signup_inputs(): void {
    if (isset($_SESSION['signup_data']['username']) && !isset($_SESSION['errors_signup']['username_taken'])) {
        echo '<input type="text" name="username" placeholder="Username" value="' . htmlspecialchars($_SESSION['signup_data']['username'], ENT_QUOTES, 'UTF-8') . '">';
    } else {
        echo '<input type="text" name="username" placeholder="Username">';
    }

    echo '<input type="password" name="pwd" placeholder="Password">';

    if (isset($_SESSION['signup_data']['email']) && !isset($_SESSION['errors_signup']['email_used']) && !isset($_SESSION['errors_signup']['invalid_email'])) {
        echo '<input type="email" name="email" placeholder="E-mail" value="' . htmlspecialchars($_SESSION['signup_data']['email'], ENT_QUOTES, 'UTF-8') . '">';
    } else {
        echo '<input type="email" name="email" placeholder="E-mail">';
    }
}

function check_signup_errors(): void {
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        foreach ($errors as $error) {
            echo '<p class="form-error">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
        }

        // Unset the session errors after displaying them
        unset($_SESSION['errors_signup']);
    } elseif (isset($_GET['signup']) && $_GET['signup'] === 'success') {
        echo '<br>';
        echo "<p class='form-success'>Signup success!</p>";
    }
}
