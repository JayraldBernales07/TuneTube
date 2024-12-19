<?php
$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "tunetube";

$connection = mysqli_connect($server_name, $db_username, $db_password, $db_name);

// Query to fetch artists, their song counts, and genres
$query = "SELECT artists.ArtistID, 
                 artists.Name AS ArtistName, 
                 artists.Genre AS Genre, 
                 COUNT(songs.SongID) AS SongCount 
          FROM artists 
          LEFT JOIN songs ON artists.ArtistID = songs.ArtistID 
          GROUP BY artists.ArtistID 
          ORDER BY artists.Name ASC";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    $counter = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='item d-flex justify-content-between align-items-center mb-4 song-row' 
              data-artist='" . htmlspecialchars($row['ArtistName']) . "' 
              data-genre='" . htmlspecialchars($row['Genre'] ? $row['Genre'] : 'No Genre') . "' 
              data-song-count='" . htmlspecialchars($row['SongCount']) . "' 
              data-artist-id='" . $row['ArtistID'] . "'  onclick='goToArtistSongs(" . $row['ArtistID'] . ")'>";

        echo "<div class='info1 d-flex align-items-center gap-3'>";
        echo "<p class='fw-bold'>" . $counter++ . "</p>";
        echo "<img src='img/th.jpg' class='img-fluid' style='width: 40px; height: 40px; border-radius: 25%;'>";
        echo "<div class='details'>";
        echo "<p class='mb-0 text'>" . htmlspecialchars($row['ArtistName']) . "</p>";
        echo "<h5 class='mb-0'>" . htmlspecialchars($row['Genre'] ? $row['Genre'] : 'No Genre') . "</h5>";
        echo "</div>";
        echo "</div>";

        echo "<div class='d-flex align-items-center'>";
        echo "<p class='fw-bold mb-0'>" . htmlspecialchars($row['SongCount']) . " songs</p>";
        echo "<button class='btn dropdown-toggle' type='button' id='songDropdown" . $row['ArtistID'] . "' data-bs-toggle='dropdown' aria-expanded='false' title='Options' onclick='event.stopPropagation()'>";
        echo "<i class='bx bx-dots-vertical-rounded text-white'></i>";
        echo "</button>";        
        echo "<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='songDropdown" . $row['ArtistID'] . "'>";
        echo "<li><a class='dropdown-item' href='artist-form-edit.php?ArtistID=" . $row['ArtistID'] . "'>Edit</a></li>";
        echo "<li><button class='dropdown-item delete-artist' data-artist-id='" . $row['ArtistID'] . "' data-bs-toggle='modal' data-bs-target='#deleteConfirmationModal' onclick='event.stopPropagation()'>Delete</button></li>";
        echo "</ul>";
        echo "</div>";
        
        echo "</div>";
    }
} else {
    echo "<p>No artists found.</p>";
}
mysqli_close($connection);
?>

<script>
function goToArtistSongs(artistID) {
    window.location.href = 'artist-songs.php?ArtistID=' + artistID;
}
</script>

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
