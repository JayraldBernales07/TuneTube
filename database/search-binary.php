<?php
// Include database configuration
include('db/dbconfig.php');

// Get the search term from the URL, if it exists
$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

// Query to fetch songs and their artists from the database
$query = "SELECT songs.*, artists.Name AS ArtistName 
          FROM songs 
          LEFT JOIN artists ON songs.ArtistID = artists.ArtistID";
$result = mysqli_query($connection, $query);

// Collect songs into an array
$songs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $songs[] = $row; // Add each song to the array
}

// Bubble Sort function to sort songs by title
function bubble_sort(&$songs) {
    $n = count($songs); // Get the number of songs
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            // Compare titles in a case-insensitive manner
            if (strcasecmp($songs[$j]['Title'], $songs[$j + 1]['Title']) > 0) {
                // Swap if the current title is greater than the next title
                $temp = $songs[$j];
                $songs[$j] = $songs[$j + 1];
                $songs[$j + 1] = $temp;
            }
        }
    }
}

// Sort songs by title using Bubble Sort
bubble_sort($songs);

// Binary search function for song titles
function binary_search($songs, $searchTerm) {
    $low = 0;
    $high = count($songs) - 1;
    $matchingSongs = []; // Array to hold matching songs

    while ($low <= $high) {
        $mid = intval(($low + $high) / 2); // Find the middle index
        $title = $songs[$mid]['Title']; // Get the title of the middle song

        // Check if the current song title matches the search term
        if (stripos($title, $searchTerm) !== false) {
            // If a match is found, add it to the results
            $matchingSongs[] = $songs[$mid];

            // Check left side for more matches
            for ($i = $mid - 1; $i >= 0; $i--) {
                if (stripos($songs[$i]['Title'], $searchTerm) !== false) {
                    $matchingSongs[] = $songs[$i];
                } else {
                    break; // Stop if no more matches are found
                }
            }

            // Check right side for more matches
            for ($i = $mid + 1; $i < count($songs); $i++) {
                if (stripos($songs[$i]['Title'], $searchTerm) !== false) {
                    $matchingSongs[] = $songs[$i];
                } else {
                    break; // Stop if no more matches are found
                }
            }
            break; // Exit the loop once we found a match
        } elseif (strcasecmp($title, $searchTerm) < 0) {
            $low = $mid + 1; // Search in the right half
        } else {
            $high = $mid - 1; // Search in the left half
        }
    }

    return $matchingSongs; // Return all matching songs
}

// Search for the term using binary search
$matchingSongs = [];
if (!empty($searchTerm)) {
    $matchingSongs = binary_search($songs, $searchTerm);
}

// Output the result
if (!empty($matchingSongs)) {
    $counter = 1;
    foreach ($matchingSongs as $song) {
        echo "<div class='item d-flex justify-content-between align-items-center mb-4 song-row' 
              data-title='" . htmlspecialchars($song['Title']) . "' 
              data-artist='" . htmlspecialchars($song['ArtistName'] ? $song['ArtistName'] : 'Unknown') . "' 
              data-file='" . htmlspecialchars($song['FilePath']) . "' 
              data-song-id='" . $song['SongID'] . "'>";

        echo "<div class='info1 d-flex align-items-center gap-3'>";
        echo "<p class='fw-bold'>" . $counter++ . "</p>";
        echo "<img src='admin/img/song-bg.png' class='img-fluid' style='width: 40px; height: 40px;'>";
        echo "<div class='details'>";
        echo "<p class='mb-0 text'>" . htmlspecialchars($song['Title']) . "</p>";
        echo "<h5 class='mb-0'>" . htmlspecialchars($song['ArtistName'] ? $song['ArtistName'] : 'Unknown') . "</h5>";
        echo "</div>"; // Close details div
        echo "</div>"; // Close info1 div

        echo "<div class='d-flex align-items-center'>";
        echo "<p class='fw-bold mb-0'>" . htmlspecialchars($song['Duration']) . "</p>";
        echo "<button class='btn dropdown-toggle' type='button' id='songDropdown" . $song['SongID'] . "' data-bs-toggle='dropdown' aria-expanded='false' title='Options' onclick='event.stopPropagation()'>";
        echo "<i class='bx bx-dots-vertical-rounded text-white'></i>";
        echo "</button>";
        echo "<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='songDropdown" . $song['SongID'] . "'>";
        echo "<li><button class='dropdown-item add-to-favorite' data-song-id='" . $song['SongID'] . "'>Add to Favorite</button></li>";
        echo "<li><a class='dropdown-item' href='songs-edit.php?id=" . $song['SongID'] . "'>Edit song</a></li>";
        echo "<li><a class='dropdown-item' href='database/songs-delete.php?id=" . $song['SongID'] . "'>Delete song</a></li>";
        echo "<li><a class='dropdown-item' href='#'>Share</a></li>";
        echo "</ul>";
        echo "</div>"; // Close d-flex div
        echo "</div>"; // Close item div
    }
} else {
    echo "No songs found.";
}

mysqli_close($connection);
?>