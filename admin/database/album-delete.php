<?php
include('../../security.php');

// Check if AlbumID is set in the GET request
if (isset($_GET['AlbumID'])) {
    $albumID = $_GET['AlbumID'];

    // Prepare the delete query
    $query = "DELETE FROM albums WHERE AlbumID = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $albumID);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the album list page or display a success message
        header("Location: ../album.php?message=Album Deleted Successfully");
        exit(); // Make sure no further code is executed
    } else {
        // Display an error message if the deletion fails
        echo "Error deleting album: " . $connection->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No album ID provided.";
}

// Close the database connection
$connection->close();
?>
