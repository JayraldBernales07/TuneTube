<?php
include('../db/dbconfig.php');

// Query to fetch only 4 songs with artist name
$query = "SELECT songs.*, artists.Name AS ArtistName FROM songs 
          JOIN artists ON songs.ArtistID = artists.ArtistID
          LIMIT 4";  // Add LIMIT 4 to fetch only 4 songs

$result = mysqli_query($connection, $query);

if(mysqli_num_rows($result) > 0) {
    $counter = 1;
    while($row = mysqli_fetch_assoc($result)) {
        $dataFile = "../" . $row['FilePath']; // Adjust this based on your actual file structure
        echo "<div class='item d-flex justify-content-between align-items-center mb-2 song-row' 
              data-title='" . htmlspecialchars($row['Title']) . "' 
              data-artist='" . htmlspecialchars($row['ArtistName']) . "' 
              data-file='" . htmlspecialchars($dataFile) . "'>";
        
        
        echo "<div class='info1 d-flex align-items-center gap-3'>";
        echo "<p class='fw-bold'>" . $counter++ . "</p>";
        echo "<img src='img/song-bg.png' class='img-fluid' style='width: 40px; height: 40px;'>";
        echo "<div class='details'>";
        echo "<p class='mb-0 text'>" . htmlspecialchars($row['Title']) . "</p>";
        echo "<h5 class='mb-0'>" . htmlspecialchars($row['ArtistName']) . "</h5>";
        echo "</div>";
        echo "</div>";

        echo "<p class='fw-bold' style='margin-right: 10px;'>" . htmlspecialchars($row['Duration']) . "</p>";  // Adjust if Duration exists
        
        echo "</div>";
    }
} else {
    echo "No songs available.";
}
mysqli_close($connection);
?>
