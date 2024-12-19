<?php
include('../db/dbconfig.php');

// Query to fetch artist names
$query = "SELECT ArtistID, Name FROM artists LIMIT 6";  // Fetch only 6 artists for display
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    $colors = ['bg-info', 'bg-secondary', 'bg-danger', 'bg-primary', 'bg-warning', 'bg-success'];
    $index = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $colorClass = $colors[$index % count($colors)];
        $artistID = htmlspecialchars($row['ArtistID']);
        $artistName = nl2br(htmlspecialchars($row['Name']));
        echo "<div class='col-6'>";
        echo "<div class='item p-3 d-flex align-items-center justify-content-center rounded $colorClass cursor-pointer' 
                onclick='redirectToArtist($artistID)'>";
        echo "<p class='fw-bold text-center m-0'>$artistName</p>";
        echo "</div>";
        echo "</div>";
        $index++;
    }
} else {
    echo "<p>No artists available.</p>";
}

mysqli_close($connection);
?>
<script>
    function redirectToArtist(artistID) {
    window.location.href = 'artist-songs.php?ArtistID=' + artistID;
}
</script>

<style>
    .genres .item {
    height: 80px; /* Set a fixed height for uniformity */
    text-align: center;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    word-wrap: break-word;
}

.genres .item p {
    margin: 0;
    line-height: 1.2;
    font-weight: 600;
    color: white; /* Ensure text is visible on background colors */
}

.cursor-pointer {
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.cursor-pointer:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

</style>