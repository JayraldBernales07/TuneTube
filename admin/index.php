<?php
session_start();
include('../db/dbconfig.php');

if (!$connection) {
    header("Location: ../db/dbconfig.php"); // Make sure the database connection path is correct
    exit(); // Always call exit after a header redirect to stop further script execution
}

if (!isset($_SESSION['Email'])) {
    header('Location: ../index.php'); // Redirect to the login page outside of the admin folder
    exit(); // Ensure the script stops here after redirect
}

?>