<?php
// Start the session
include('db/dbconfig.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to view favorite songs.";
    exit();
}

// Retrieve user ID from session
$userId = $_SESSION['user_id'];

// Query to fetch favorite songs with artist name for the logged-in user
$query = "SELECT songs.*, artists.Name AS ArtistName 
          FROM songs 
          LEFT JOIN artists ON songs.ArtistID = artists.ArtistID
          JOIN favorites ON songs.SongID = favorites.SongID
          WHERE favorites.UserID = ?"; // Filter by user ID
$stmt = $connection->prepare($query);
if ($stmt === false) {
    die("Error preparing statement: " . $connection->error);
}
$stmt->bind_param("i", $userId); // Bind user ID
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        // Use a default value if artist name is NULL
        $artistName = $row['ArtistName'] ? htmlspecialchars($row['ArtistName']) : 'Unknown Artist';
        
        echo "<div class='item d-flex justify-content-between align-items-center mb-4 song-row' 
              data-title='" . htmlspecialchars($row['Title']) . "' 
              data-artist='" . $artistName . "' 
              data-file='" . htmlspecialchars($row['FilePath']) . "' 
              data-song-id='" . $row['SongID'] . "'>"; // Add the SongID as a data attribute
        
        echo "<div class='info1 d-flex align-items-center gap-3'>";
        echo "<p class='fw-bold'>" . $counter++ . "</p>";
        echo "<img src='admin/img/song-bg.png' class='img-fluid' style='width: 40px; height: 40px;'>";
        echo "<div class='details'>";
        echo "<p class='mb-0 text'>" . htmlspecialchars($row['Title']) . "</p>";
        echo "<h5 class='mb-0'>" . $artistName . "</h5>";
        echo "</div>";
        echo "</div>";

        // Separate section for duration and button to remove from favorites
        echo "<div class='d-flex align-items-center gap-3'>";
        echo "<p class='fw-bold mb-0'>" . htmlspecialchars($row['Duration']) . "</p>";
        echo "<button class='btn remove-from-favorite' data-song-id='" . $row['SongID'] . "' title='Remove from Favorites'>
                <i class='bx bxs-minus-square text-white'></i>
              </button>";
        echo "</div>";
        
        echo "</div>";
    }
} else {
    echo "No favorite songs available.";
}
$stmt->close();
$connection->close();
?>

