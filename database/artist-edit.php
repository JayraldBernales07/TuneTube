<?php
include('../db/dbconfig.php'); // Include your database configuration

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the artist ID, name, and genre from the form
    $artistID = htmlspecialchars(trim($_POST['ArtistID']));
    $artistName = htmlspecialchars(trim($_POST['ArtistName']));
    $genre = htmlspecialchars(trim($_POST['Genre']));

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $connection->prepare("UPDATE artists SET Name = ?, Genre = ? WHERE ArtistID = ?");
    $stmt->bind_param("ssi", $artistName, $genre, $artistID);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the artist page or display a success message
        header("Location: ../artist.php?success=Artist updated successfully");
        exit();
    } else {
        // Handle error
        die("<div class='alert alert-danger'>Error updating artist: " . $stmt->error . "</div>");
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>
