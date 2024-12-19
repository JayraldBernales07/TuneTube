<?php
include('../../security.php');

// Check if song ID is provided in the URL
if (isset($_GET['id'])) {
    $songID = (int)$_GET['id']; // Get the song ID from the URL and make sure it's an integer

    // Fetch the song file path from the database
    $selectQuery = "SELECT FilePath FROM songs WHERE SongID = $songID";
    $result = mysqli_query($connection, $selectQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $song = mysqli_fetch_assoc($result);
        $filePath = $song['FilePath']; // Get the file path from the database

        // Delete the song file from the server if it exists
        if (file_exists('../../' . $filePath)) {
            if (!unlink('../../' . $filePath)) {
                die("<div class='alert alert-danger'>Error deleting the song file.</div>");
            }
        } else {
            echo "<div class='alert alert-warning'>Song file not found on the server.</div>";
        }

        // Delete the song from the database
        $deleteQuery = "DELETE FROM songs WHERE SongID = $songID";
        if (mysqli_query($connection, $deleteQuery)) {
            // Redirect to the previous page
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?message=Song Deleted Successfully");
            exit(); // Make sure no further code is executed
        } else {
            // If the deletion fails, show an error
            die("<div class='alert alert-danger'>Error deleting song from database: " . mysqli_error($connection) . "</div>");
        }
    } else {
        // If song doesn't exist
        die("<div class='alert alert-danger'>Song not found in the database.</div>");
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    // If no ID is provided, show an error message
    die("<div class='alert alert-danger'>No song ID provided to delete.</div>");
}
?>
