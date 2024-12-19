<?php
include('db/dbconfig.php');

// Query to fetch albums, their song counts, release date, and artist names
$query = "SELECT 
            albums.AlbumID, 
            albums.Title AS AlbumTitle, 
            albums.ReleaseDate, 
            artists.Name AS ArtistName,
            COUNT(songs.SongID) AS SongCount
          FROM albums
          LEFT JOIN songs ON albums.AlbumID = songs.AlbumID
          LEFT JOIN artists ON albums.ArtistID = artists.ArtistID
          GROUP BY albums.AlbumID";

$result = mysqli_query($connection, $query);

$bgColors = ['bg-secondary', 'bg-danger', 'bg-primary', 'bg-warning', 'bg-success']; // Different background colors
$colorIndex = 0;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bgColor = $bgColors[$colorIndex % count($bgColors)]; // Cycle through background colors

        echo "<div class='col-6' onclick='goToAlbumSongs(" . $row['AlbumID'] . ")'>";
        echo "<div class='item p-3 d-flex justify-content-between align-items-start rounded $bgColor cursor-pointer'>";
        echo "<div class='album-info'>";
        echo "<p class='fw-bold text mb-0'>" . htmlspecialchars($row['AlbumTitle']) . "</p>";
        echo "<p class='text mb-0'>By: " . htmlspecialchars($row['ArtistName']) . "</p>";
        echo "<p class='text mb-0'>" . htmlspecialchars($row['SongCount']) . " songs</p>";
        echo "</div>";
        echo "<div class='dropdown'>";
        echo "<button class='btn dropdown-toggle' type='button' id='albumDropdown" . $row['AlbumID'] . "' data-bs-toggle='dropdown' aria-expanded='false' title='Options' onclick='event.stopPropagation()'>";
        echo "<i class='bx bx-dots-vertical-rounded text-white'></i>";
        echo "</button>";
        echo "<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='albumDropdown" . $row['AlbumID'] . "'>";
        echo "<li><a class='dropdown-item' href='album-form-edit.php?AlbumID=" . $row['AlbumID'] . "'>Edit</a></li>";
        echo "<li><button class='dropdown-item delete-album' data-album-id='" . $row['AlbumID'] . "' data-bs-toggle='modal' data-bs-target='#deleteConfirmationModal' onclick='event.stopPropagation()'>Delete</button></li>";
        echo "</ul>";
        echo "</div>"; // End of dropdown
        echo "</div>"; // End of item
        echo "</div>"; // End of col

        $colorIndex++; // Increment color index for the next iteration
    }
} else {
    echo "<p>No albums found.</p>";
}

mysqli_close($connection);
?>

<script>
function goToAlbumSongs(albumID) {
    window.location.href = 'album-songs.php?AlbumID=' + albumID;
}
</script>
<style>
    .music-list {
    overflow-y: auto; /* Allow vertical scrolling */
    overflow-x: hidden; /* Prevent horizontal overflow */
    max-width: 100%; /* Ensure it doesn't exceed the container width */
}
/* Remove the dropdown arrow */
.btn.dropdown-toggle::after {
    display: none; /* Hides the arrow */
}
.items {
    display: flex; /* Use flexbox for layout */
    flex-wrap: wrap; /* Allow items to wrap to the next line */
    width: 100%; /* Ensure items take full width of the container */
}
.item {
    flex: 1 1 calc(50% - 1rem); /* Adjust item width to fit two items per row with some margin */
    box-sizing: border-box; /* Include padding and border in width */
    margin-bottom: 1rem; /* Add some space between rows */
}
.btn.dropdown-toggle::after {
    display: none; /* Hides the arrow */
}
.btn.dropdown-toggle {
    padding-right: 0; /* Optional: removes padding on the right if needed */
    outline: none !important; /* Remove outline */
}
.item:hover {
    background-color: rgba(255, 255, 255, 0.2); /* Lighten background on hover */
}

.dropdown-item:hover {
    background-color: #18181d; /* Change background color on hover */
}
</style>