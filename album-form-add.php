<?php
include('security.php'); 
include('includes/header.php'); 

// Fetch artists for the artist dropdown
$artists = $connection->query("SELECT ArtistID, Name FROM artists");
if (!$artists) {
    die("<div class='alert alert-danger'>Error fetching artists: " . $connection->error . "</div>");
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'includes/sidebar-album.php'; ?> 

        <div class="col-md-10 position-relative">
            <?php include 'includes/topbar.php'; ?> 

            <main class="row">
                <section class="col-md-8 p-4">
                    <div class="music-list-container p-3 mt-3 text-white rounded">
                        <div class="header d-flex justify-content-between mb-3">
                            <h5>Add Album</h5>
                            <a href="album.php" class="btn btn-dark">Cancel</a>
                        </div>

                        <!-- Album Upload Form -->
                        <form action="database/album-add.php" method="POST" enctype="multipart/form-data" class="mb-4">
                            <div class="mb-3">
                                <label for="albumTitle" class="form-label">Album Title</label>
                                <input type="text" name="albumTitle" id="albumTitle" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="releaseDate" class="form-label">Release Date</label>
                                <input type="date" name="releaseDate" id="releaseDate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="artist" class="form-label">Artist</label>
                                <select name="artist" id="artist" class="form-control" required>
                                    <option value="" disabled selected>Select Artist</option>
                                    <?php
                                    // Populate artist dropdown
                                    while ($artist = $artists->fetch_assoc()) {
                                        echo "<option value='" . htmlspecialchars($artist['ArtistID']) . "'>" . htmlspecialchars($artist['Name']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
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
$connection->close(); // Close the database connection
include 'includes/scripts.php'; 
?>
