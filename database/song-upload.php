<?php
include('../security.php');

// Check if form data and file are submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['songFile'])) {
    $songTitle = mysqli_real_escape_string($connection, $_POST['songTitle']);
    
    // Check if artistId or albumId is empty, and set to NULL if true
    $artistId = empty($_POST['artistId']) ? 'NULL' : (int)$_POST['artistId'];
    $duration = mysqli_real_escape_string($connection, $_POST['duration']);
    $albumId = empty($_POST['albumId']) ? 'NULL' : (int)$_POST['albumId'];
    $file = $_FILES['songFile'];

    // Validate file type and size
    $allowedTypes = ['audio/mpeg', 'audio/mp3'];
    $maxFileSize = 10 * 1024 * 1024; // 10 MB
    if (!in_array($file['type'], $allowedTypes) || $file['size'] > $maxFileSize) {
        die("<div class='alert alert-danger'>Invalid file type or size exceeds 10MB.</div>");
    }

    // Create unique file name and move the file to the 'music' directory
    $uploadDir = '../music/';
    $fileName = uniqid() . '-' . basename($file['name']);
    $uploadPath = $uploadDir . $fileName;
    
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        // Insert song metadata into the database
        $filePath = 'music/' . $fileName;
        
        // Prepare the SQL query to insert into the database
        $query = "INSERT INTO songs (Title, Duration, FilePath, AlbumID, ArtistID) 
                  VALUES ('$songTitle', '$duration', '$filePath', $albumId, $artistId)";
        
        if (mysqli_query($connection, $query)) {
            echo "<div class='alert alert-success'>Song uploaded successfully!</div>";
            header("Location: ../songs.php"); // Redirect to songs page
            exit();
        } else {
            unlink($uploadPath); // Remove uploaded file if DB insertion fails
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($connection) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Failed to upload the file.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Invalid request.</div>";
}

mysqli_close($connection);
?>
