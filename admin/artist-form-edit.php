<?php
include('../security.php');
include('includes/header.php');

// Fetch artist details if ArtistID is provided
if (isset($_GET['ArtistID'])) {
    $artistID = $_GET['ArtistID'];

    $query = "SELECT * FROM artists WHERE ArtistID = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $artistID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $artist = $result->fetch_assoc();
    } else {
        echo "Artist not found.";
        exit;
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
} else {
    echo "No artist ID provided.";
    exit;
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
                            <h5>Edit Artist</h5>
                            <a href="artist.php" class="btn btn-dark">Cancel</a>
                        </div>

                        <!-- Edit Artist Form -->
                        <form action="database/artist-edit.php" method="POST" enctype="multipart/form-data" class="mb-4">
                            <input type="hidden" name="ArtistID" value="<?php echo $artist['ArtistID']; ?>">
                            
                            <div class="mb-3">
                                <label for="ArtistName" class="form-label">Artist Name</label>
                                <input type="text" name="ArtistName" id="ArtistName" class="form-control" value="<?php echo htmlspecialchars($artist['Name']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="Genre" class="form-label">Genre</label>
                                <select name="Genre" id="Genre" class="form-control" required>
                                    <option value="" disabled>Select</option>
                                    <option value="Pop" <?php echo $artist['Genre'] == 'Pop' ? 'selected' : ''; ?>>Pop</option>
                                    <option value="Pop Soul" <?php echo $artist['Genre'] == 'Pop Soul' ? 'selected' : ''; ?>>Pop Soul</option>
                                    <option value="Rock" <?php echo $artist['Genre'] == 'Rock' ? 'selected' : ''; ?>>Rock</option>
                                    <option value="Jazz" <?php echo $artist['Genre'] == 'Jazz' ? 'selected' : ''; ?>>Jazz</option>
                                    <option value="Classical" <?php echo $artist['Genre'] == 'Classical' ? 'selected' : ''; ?>>Classical</option>
                                    <option value="Hip-hop" <?php echo $artist['Genre'] == 'Hip-hop' ? 'selected' : ''; ?>>Hip-Hop</option>
                                    <option value="Country" <?php echo $artist['Genre'] == 'Country' ? 'selected' : ''; ?>>Country</option>
                                    <option value="Electronic" <?php echo $artist['Genre'] == 'Electronic' ? 'selected' : ''; ?>>Electronic</option>
                                    <option value="Reggae" <?php echo $artist['Genre'] == 'Reggae' ? 'selected' : ''; ?>>Reggae</option>
                                    <option value="Blues" <?php echo $artist['Genre'] == 'Blues' ? 'selected' : ''; ?>>Blues</option>
                                    <option value="Metal" <?php echo $artist['Genre'] == 'Metal' ? 'selected' : ''; ?>>Metal</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Update Artist</button>
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
include('includes/scripts.php'); 
?>
