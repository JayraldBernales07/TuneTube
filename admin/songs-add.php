<?php
include('../security.php'); 
include('includes/header.php'); 

// Fetch artists
$artists = $connection->query("SELECT ArtistID, Name FROM artists");
if (!$artists) {
    die("<div class='alert alert-danger'>Error fetching artists: " . $connection->error . "</div>");
}

// Fetch albums
$albums = $connection->query("SELECT AlbumID, Title FROM albums");
if (!$albums) {
    die("<div class='alert alert-danger'>Error fetching albums: " . $connection->error . "</div>");
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'includes/sidebar-songs.php'; ?> 

        <div class="col-md-10 position-relative">
            <?php include 'includes/topbar.php'; ?> 

            <main class="row">
                <section class="col-md-8 p-4">
                    <div class="music-list-container p-3 mt-3 text-white rounded">
                        <div class="header d-flex justify-content-between mb-3">
                            <h5>Upload Song</h5>
                            <a href="songs.php" class="btn btn-dark">Cancel</a>
                        </div>

                        <!-- Song Upload Form -->
                        <form action="database/song-upload.php" method="POST" enctype="multipart/form-data" class="mb-4">
                            <div class="mb-3">
                                <label for="songTitle" class="form-label">Song Title</label>
                                <input type="text" name="songTitle" id="songTitle" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="artistId" class="form-label">Artist</label>
                                <select name="artistId" id="artistId" class="form-select" >
                                    <option value="">Select Artist</option>
                                    <?php while ($row = $artists->fetch_assoc()): ?>
                                        <option value="<?php echo $row['ArtistID']; ?>"><?php echo htmlspecialchars($row['Name']); ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Duration (e.g., 00:03:45)</label>
                                <input type="text" name="duration" id="duration" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="albumId" class="form-label">Album</label>
                                <select name="albumId" id="albumId" class="form-select" >
                                    <option value="">Select Album</option>
                                    <?php while ($row = $albums->fetch_assoc()): ?>
                                        <option value="<?php echo $row['AlbumID']; ?>"><?php echo htmlspecialchars($row['Title']); ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="songFile" class="form-label">Upload Song (MP3)</label>
                                <input type="file" name="songFile" id="songFile" class="form-control" accept=".mp3" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload Song</button>
                        </form>
                    </div>
                </section>
            </main>

            <!-- Audio Player Section -->
            <?php include 'includes/audioplayer.php'; ?> 
        </div>
    </div>
</div>

<?php 
$connection->close(); // Close the database connectionection
include 'includes/scripts.php'; 
?>