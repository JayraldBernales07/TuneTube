<?php
include('../security.php');

// Check if ArtistID is set in the GET request
if (isset($_GET['ArtistID'])) {
    $artistID = $_GET['ArtistID'];

    // Prepare the delete query
    $query = "DELETE FROM artists WHERE ArtistID = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $artistID);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the artist list page or display a success message
        header("Location: ../artist.php?message=Song Deleted Successfully");
        exit(); // Make sure no further code is executed
    } else {
        // Display an error message if the deletion fails
        echo "Error deleting artist: " . $connection->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No artist ID provided.";
}

// Close the database connection
$connection->close();
?>
