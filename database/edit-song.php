<?php
include('../security.php'); // Make sure user is authorized

// Check if form data is posted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the posted values
    $songID = (int)$_POST['songID'];
    $songTitle = mysqli_real_escape_string($connection, $_POST['songTitle']);
    $artistId = (int)$_POST['artistId'];
    $albumId = (int)$_POST['albumId'];
    $duration = mysqli_real_escape_string($connection, $_POST['duration']);

    // Prepare the query to update song details
    $updateQuery = "UPDATE songs 
                    SET Title = '$songTitle', ArtistID = $artistId, AlbumID = $albumId, Duration = '$duration'
                    WHERE SongID = $songID";

    // Execute the query
    if (mysqli_query($connection, $updateQuery)) {

        // Handle file upload for song (MP3)
        if (!empty($_FILES['songFile']['name'])) {
            $songFile = $_FILES['songFile'];
            $songFileName = $songFile['name'];
            $songFileTmpName = $songFile['tmp_name'];
            $songFileSize = $songFile['size'];
            $songFileError = $songFile['error'];
            $songFileType = $songFile['type'];

            // Check if file is an MP3
            $allowed = ['audio/mp3'];
            if (in_array($songFileType, $allowed)) {
                if ($songFileError === 0) {
                    if ($songFileSize < 50000000) { // File size limit (50MB)
                        $fileNameNew = uniqid('', true) . "." . pathinfo($songFileName, PATHINFO_EXTENSION);
                        $fileDestination = 'uploads/songs/' . $fileNameNew;
                        move_uploaded_file($songFileTmpName, $fileDestination);

                        // Update the song's file path in the database
                        $updateFileQuery = "UPDATE songs SET FilePath = '$fileDestination' WHERE SongID = $songID";
                        mysqli_query($connection, $updateFileQuery);
                    } else {
                        echo "<div class='alert alert-danger'>File is too big!</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>There was an error uploading the file!</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Invalid file type. Only MP3 is allowed!</div>";
            }
        }

        // Handle file upload for song image (if applicable)
        if (!empty($_FILES['songImage']['name'])) {
            $songImage = $_FILES['songImage'];
            $imageFileName = $songImage['name'];
            $imageFileTmpName = $songImage['tmp_name'];
            $imageFileSize = $songImage['size'];
            $imageFileError = $songImage['error'];
            $imageFileType = $songImage['type'];

            // Check if file is an image
            $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (in_array($imageFileType, $allowedImageTypes)) {
                if ($imageFileError === 0) {
                    if ($imageFileSize < 5000000) { // File size limit (5MB)
                        $imageNameNew = uniqid('', true) . "." . pathinfo($imageFileName, PATHINFO_EXTENSION);
                        $imageDestination = 'uploads/images/' . $imageNameNew;
                        move_uploaded_file($imageFileTmpName, $imageDestination);

                        // Update the song's image path in the database
                        $updateImageQuery = "UPDATE songs SET ImagePath = '$imageDestination' WHERE SongID = $songID";
                        mysqli_query($connection, $updateImageQuery);
                    } else {
                        echo "<div class='alert alert-danger'>Image file is too big!</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>There was an error uploading the image!</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Invalid image type. Only JPG, PNG, and JPEG are allowed!</div>";
            }
        }

        echo "<div class='alert alert-success'>Song updated successfully!</div>";
        header("Location: ../songs.php"); // Redirect to songs list
    } else {
        echo "<div class='alert alert-danger'>Error updating song: " . mysqli_error($connection) . "</div>";
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
