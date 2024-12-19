<?php
include('../db/dbconfig.php');

// Get ArtistID from the URL (if available)
$artistID = isset($_GET['ArtistID']) ? $_GET['ArtistID'] : null;

// Query to fetch songs with filtering by ArtistID (if provided)
$query = "SELECT songs.*, artists.Name AS ArtistName 
          FROM songs 
          LEFT JOIN artists ON songs.ArtistID = artists.ArtistID";

// If ArtistID is provided, filter the songs by ArtistID
if ($artistID) {
    $query .= " WHERE songs.ArtistID = " . (int)$artistID;
}

$query .= " ORDER BY songs.SongID ASC"; // Default sorting by SongID in ascending order
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    $counter = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $dataFile = "../" . $row['FilePath']; // Adjust this based on your actual file structure
        echo "<div class='item d-flex justify-content-between align-items-center mb-4 song-row' 
              data-title='" . htmlspecialchars($row['Title']) . "' 
              data-artist='" . htmlspecialchars($row['ArtistName'] ? $row['ArtistName'] : 'Unknown') . "' 
                data-file='" . htmlspecialchars($dataFile) . "'
              data-song-id='" . $row['SongID'] . "'>";

        echo "<div class='info1 d-flex align-items-center gap-3'>";
        echo "<p class='fw-bold'>" . $counter++ . "</p>";
        echo "<img src='img/song-bg.png' class='img-fluid' style='width: 40px; height: 40px;'>";
        echo "<div class='details'>";
        echo "<p class='mb-0 text'>" . htmlspecialchars($row['Title']) . "</p>";
        echo "<h5 class='mb-0'>" . htmlspecialchars($row['ArtistName'] ? $row['ArtistName'] : 'Unknown') . "</h5>";
        echo "</div>";
        echo "</div>";

        echo "<div class='d-flex align-items-center'>";
        echo "<p class='fw-bold mb-0'>" . htmlspecialchars($row['Duration']) . "</p>";
        echo "<button class='btn dropdown-toggle' type='button' id='songDropdown" . $row['SongID'] . "' data-bs-toggle='dropdown' aria-expanded='false' title='Options' onclick='event.stopPropagation()'>";
        echo "<i class='bx bx-dots-vertical-rounded text-white'></i>";
        echo "</button>";
        echo "<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='songDropdown" . $row['SongID'] . "'>";
        echo "<li><button class='dropdown-item add-to-favorite' data-song-id='" . $row['SongID'] . "'>Add to Favorite</button></li>";
        echo "<li><a class='dropdown-item' href='songs-edit.php?id=" . $row['SongID'] . "'>Edit song</a></li>";
        echo "<li><button class='dropdown-item delete-song' data-song-id='" . $row['SongID'] . "' data-bs-toggle='modal' data-bs-target='#deleteConfirmationModal'>Delete song</button></li>";
        echo "<li><a class='dropdown-item' href='#'>Share</a></li>";
        echo "</ul>";
        echo "</div>";
        
        echo "</div>";
    }
} else {
    // Display the message centered
    echo "<div class='no-songs-message text-center' style='width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;'>";
    echo "<p>No songs available.</p>";
    echo "</div>";
}
mysqli_close($connection);
?>

<style>
/* Remove the dropdown arrow */
.btn.dropdown-toggle::after {
    display: none; /* Hides the arrow */
}

.btn.dropdown-toggle {
    padding-right: 0; /* Optional: removes padding on the right if needed */
}
.music-list {
    overflow-y: auto; /* Allow vertical scrolling */
    overflow-x: hidden; /* Prevent horizontal overflow */
    max-width: 100%; /* Ensure it doesn't exceed the container width */
}
</style>
