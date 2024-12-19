<?php
// Start session only if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include security which in turn includes database connection
include('security.php');  

// Check if the form is submitted
if (isset($_POST['register_btn'])) {
    // Retrieve form data
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $confirmPassword = $_POST['ConfirmPassword'];
    $hash = password_hash($password, PASSWORD_BCRYPT);

    // Validate passwords match
    if ($password !== $confirmPassword) {
        $_SESSION['status'] = "Passwords do not match!";
        $_SESSION['status_type'] = 'error';  // Set type to 'error'
        header('Location: index.php');
        exit();
    }

    // Check if email already exists
    $stmt = $connection->prepare("SELECT * FROM users WHERE Email = ?");
    if (!$stmt) {
        $_SESSION['status'] = "Database error: " . $connection->error;
        $_SESSION['status_type'] = 'error';  // Set type to 'error'
        header('Location: index.php');
        exit();
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['status'] = "Email already in use!";
        $_SESSION['status_type'] = 'error';  // Set type to 'error'
        header('Location: index.php');
        exit();
    }

    // Skip password hashing, store plain-text password
    $role = "User";  // Default role

    // Insert the user into the database
    $stmt = $connection->prepare("INSERT INTO users (Username, Password, Email, Role) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        $_SESSION['status'] = "Database error: " . $connection->error;
        $_SESSION['status_type'] = 'error';  // Set type to 'error'
        header('Location: index.php');
        exit();
    }
    $stmt->bind_param("ssss", $username, $hash, $email, $role);

    if ($stmt->execute()) {
        $_SESSION['status'] = "Registration successful! Please log in.";
        $_SESSION['status_type'] = 'success';  // Set type to 'success'
        header('Location: index.php');  // Redirect to login page on success
        exit();
    } else {
        $_SESSION['status'] = "Error registering user!";
        $_SESSION['status_type'] = 'error';  // Set type to 'error'
        header('Location: index.php');
        exit();
    }
} else {
    // If the form is not submitted properly, redirect
    $_SESSION['status'] = "Invalid request.";
    $_SESSION['status_type'] = 'error';  // Set type to 'error'
    header('Location: index.php');
    exit();
}
?>
