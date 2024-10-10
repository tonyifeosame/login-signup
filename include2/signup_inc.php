<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $email = $_POST['email'];

    try {
        require_once 'dbh_inc.php';         // Database connection
        require_once 'signup_module_inc.php'; // Functions for validation
        require_once 'signup_contr_inc.php';  // Additional signup control logic

        // ERROR HANDLERS
        $errors = [];

        // Check for empty input fields
        if (is_input_empty($username, $pwd, $email)) {
            $errors['empty_input'] = 'Fill in all fields!';
        }

        // Check if the email is invalid
        if (is_email_invalid($email)) {
            $errors['invalid_email'] = 'Invalid email used!';
        }

        // Check if the username is already taken
        if (is_username_taken($pdo, $username)) {
            $errors['username_taken'] = 'Username already taken!';
        }

        // Check if the email is already registered
        if (is_email_registered($pdo, $email)) {
            $errors['email_used'] = 'Email already registered!';
        }

        // Start session and store errors if they exist
        require_once 'config_session_inc.php';  // Corrected file name typo
        if ($errors) {
            $_SESSION['errors_signup'] = $errors;
            $signupData = [
                'username' => $username,
                'email' => $email
            ];
            $_SESSION['signup_data'] = $signupData;
            header('Location: /signup.php');
            exit(); // Ensure the script stops after redirecting
        }

        // Proceed with user creation if no errors
        create_user($pdo, $pwd, $username, $email);
        
        // Close the database connection
        $pdo = null;

        // Redirect to the signup page with a success message
        header('Location: ../signup.php?signup=success');
        exit();

    } catch (PDOException $e) {
        die('Query failed: ' . $e->getMessage());
    }
} else {
    header('Location: ../signup.php');
    exit(); // Ensure termination after redirect
}
