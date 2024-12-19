<?php
include('security.php');
include('includes/header.php');

// Get the song ID from the URL parameter
if (isset($_GET['id'])) {
    $songID = (int)$_GET['id']; // Make sure it's an integer

    // Fetch the song data from the database
    $songResult = $connection->query("SELECT * FROM songs WHERE SongID = $songID");
    
    if ($songResult->num_rows > 0) {
        $song = $songResult->fetch_assoc();
    } else {
        die("<div class='alert alert-danger'>Song not found.</div>");
    }

    // Fetch artists and albums for the select options
    $artists = $connection->query("SELECT * FROM artists");
    $albums = $connection->query("SELECT * FROM albums");
} else {
    die("<div class='alert alert-danger'>Invalid song ID.</div>");
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
                            <h5>Edit Song</h5>
                            <!-- Button that will redirect to the previous page -->
                            <a href="javascript:history.back()" class="btn btn-dark">Cancel</a>
                        </div>

                        <!-- Edit Song Form -->
                        <form action="database/edit-song.php" method="POST" enctype="multipart/form-data" class="mb-4">
                            <input type="hidden" name="songID" value="<?php echo $song['SongID']; ?>">
                            
                            <!-- Song Title -->
                            <div class="mb-3">
                                <label for="songTitle" class="form-label">Song Title</label>
                                <input type="text" name="songTitle" id="songTitle" class="form-control" value="<?php echo htmlspecialchars($song['Title']); ?>" required>
                            </div>

                            <!-- Artist -->
                            <div class="mb-3">
                                <label for="artistId" class="form-label">Artist</label>
                                <select name="artistId" id="artistId" class="form-select" required>
                                    <option value="">Select Artist</option>
                                    <?php while ($row = $artists->fetch_assoc()): ?>
                                        <option value="<?php echo $row['ArtistID']; ?>" <?php echo ($row['ArtistID'] == $song['ArtistID']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($row['Name']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <!-- Duration -->
                            <div class="mb-3">
                                <label for="duration" class="form-label">Duration (e.g., 00:03:45)</label>
                                <input type="text" name="duration" id="duration" class="form-control" value="<?php echo htmlspecialchars($song['Duration']); ?>" required>
                            </div>

                            <!-- Album -->
                            <div class="mb-3">
                                <label for="albumId" class="form-label">Album</label>
                                <select name="albumId" id="albumId" class="form-select" required>
                                    <option value="">Select Album</option>
                                    <?php while ($row = $albums->fetch_assoc()): ?>
                                        <option value="<?php echo $row['AlbumID']; ?>" <?php echo ($row['AlbumID'] == $song['AlbumID']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($row['Title']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Song</button>
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
$connection->close(); 
include 'includes/scripts.php'; 
?>
