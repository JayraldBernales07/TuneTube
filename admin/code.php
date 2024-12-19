<?php
include('../security.php');

if(isset($_POST['login_btn']))
{
    $email_login = $_POST['Email'];
    $password_login = $_POST['Password'];

    // Prepare and execute the query to fetch user data based on email
    $query = "SELECT * FROM users WHERE Email = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $email_login);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if(password_verify($password_login, $user['Password'])) {
            // Password is correct
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['Email'] = $email_login;
            
            if($user['Role'] == "Admin") {
                header('Location: main.php');
            } else if($user['Role'] == "User") {
                header('Location: ../main.php');
            }
        } else {
            // Incorrect password
            $_SESSION['status'] = 'Incorrect Password';
            $_SESSION['status_type'] = 'error'; 
            header('Location: ../index.php');
        }
    } else {
        // User not found
        $_SESSION['status'] = 'Username is Invalid';
        $_SESSION['status_type'] = 'error'; 
        header('Location: ../index.php');
    }
}
?>
