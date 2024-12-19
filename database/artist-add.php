<?php
include('../db/dbconfig.php'); // Include your database configuration

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the artist name and genre from the form
    $artistName = htmlspecialchars(trim($_POST['songTitle']));
    $genre = htmlspecialchars(trim($_POST['genre']));

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $connection->prepare("INSERT INTO artists (Name, Genre) VALUES (?, ?)");
    $stmt->bind_param("ss", $artistName, $genre);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the artist page or display a success message
        header("Location: ../artist.php?success=Artist added successfully");
        exit();
    } else {
        // Handle error
        die("<div class='alert alert-danger'>Error adding artist: " . $stmt->error . "</div>");
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>