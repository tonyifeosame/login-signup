<?php
declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    try {
        require_once 'dbh_inc.php';
        require_once 'login_module_inc.php';
        require_once 'login_contr_inc.php';
        require_once 'config_session_inc.php'; // Ensure this file starts the session

        // ERROR HANDLERS
        $errors = [];

        // Check for empty input fields
        if (is_input_empty($username, $pwd)) {
            $errors['empty_input'] = 'Fill in all fields!';
        } else {
            $result = get_user($pdo, $username);

            // Check if the username is incorrect
            if (is_username_wrong($result)) {
                $errors['login_incorrect'] = 'Incorrect login info!';
            } elseif (is_password_wrong($pwd, $result['pwd'])) {
                // If username exists but password is wrong
                $errors['login_incorrect'] = 'Incorrect login info!';
            }
        }

        // Store errors in session if any exist and redirect back
        if ($errors) {
            $_SESSION['errors_login'] = $errors;
            header('Location: ../login.php');
            exit(); // Stop script execution after redirect
        }

        // No errors, proceed with setting session
        session_regenerate_id(true); // Regenerate session ID for security
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION['last_regeneration'] = time();

        // Redirect to login success page
        header('Location: ../login.php?login=success');
        exit();
    } catch (PDOException $e) {
        die('Query failed: ' . $e->getMessage());
    }
} else {
    header("Location: ../login.php");
    exit();
}

// Define the functions below

// Function to check if input fields are empty
function is_input_empty(string $username, string $pwd): bool {
    return empty($username) || empty($pwd);
}

// Function to check if the username is wrong
function is_username_wrong(?array $result): bool {
    return is_null($result);
}

// Function to verify the password
function is_password_wrong(string $inputPassword, string $storedPassword): bool {
    // Assuming passwords are hashed using password_hash()
    return !password_verify($inputPassword, $storedPassword);
}
?>
