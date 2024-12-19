<?php
include('security.php'); 
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
        <?php include 'includes/sidebar-artist.php'; ?> 

        <div class="col-md-10 position-relative">
            <?php include 'includes/topbar.php'; ?> 

            <main class="row">
                <section class="col-md-8 p-4">
                    <div class="music-list-container p-3 mt-3 text-white rounded">
                        <div class="header d-flex justify-content-between mb-3">
                            <h5>Add Artist</h5>
                            <a href="artist.php" class="btn btn-dark">Cancel</a>
                        </div>

                        <!-- Song Upload Form -->
                        <form action="database/artist-add.php" method="POST" enctype="multipart/form-data" class="mb-4">
                            <div class="mb-3">
                                <label for="songTitle" class="form-label">Artist Name</label>
                                <input type="text" name="songTitle" id="songTitle" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre</label>
                                <select name="genre" id="genre" class="form-control" required>
                                    <option value="" disabled selected>Select</option>
                                    <option value="Pop">Pop</option>
                                    <option value="Pop Soul">Pop Soul</option>
                                    <option value="Rock">Rock</option>
                                    <option value="Jazz">Jazz</option>
                                    <option value="Classical">Classical</option>
                                    <option value="Hip-hop">Hip-Hop</option>
                                    <option value="Country">Country</option>
                                    <option value="Electronic">Electronic</option>
                                    <option value="Reggae">Reggae</option>
                                    <option value="Blues">Blues</option>
                                    <option value="Metal">Metal</option>
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
$connection->close(); // Close the database connectionection
include 'includes/scripts.php'; 
?>
