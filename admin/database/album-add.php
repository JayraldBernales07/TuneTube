<?php
include('../../db/dbconfig.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $albumTitle = $connection->real_escape_string($_POST['albumTitle']);
    $releaseDate = $connection->real_escape_string($_POST['releaseDate']);
    $artistID = $connection->real_escape_string($_POST['artist']);

    // Insert into the albums table
    $query = "INSERT INTO albums (Title, ReleaseDate, ArtistID) VALUES ('$albumTitle', '$releaseDate', $artistID)";

    if ($connection->query($query)) {
        header('Location: ../album.php?message=Album added successfully');
        exit();
    } else {
        die("Error adding album: " . $connection->error);
    }
}
?>
