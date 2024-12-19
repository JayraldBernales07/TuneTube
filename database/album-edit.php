<?php
include('../db/dbconfig.php'); // Include your database configuration

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the Id , Date and Artist
    $albumID = htmlspecialchars(trim($_POST['AlbumID']));
    $title = htmlspecialchars(trim($_POST['Title']));
    $releaseDate = htmlspecialchars(trim($_POST['ReleaseDate']));
    $artistID = htmlspecialchars(trim($_POST['artistId']));

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $connection->prepare("UPDATE albums SET Title = ?, ReleaseDate = ?, ArtistID = ? WHERE AlbumID = ?");
    $stmt->bind_param("ssii", $title, $releaseDate, $artistID, $albumID);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the album page or display a success message
        header("Location: ../album.php?success=Album updated successfully");
        exit();
    } else {
        // Handle error
        die("<div class='alert alert-danger'>Error updating album: " . $stmt->error . "</div>");
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>
