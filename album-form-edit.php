<?php
include('security.php');
include('includes/header.php');

// Fetch artist details if AlbumID is provided
if (isset($_GET['AlbumID'])) {
    $artists = $connection->query("SELECT * FROM artists");
    $albumID = $_GET['AlbumID'];

    include('db/dbconfig.php');
    $query = "SELECT * FROM albums WHERE AlbumID = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $albumID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $album = $result->fetch_assoc();
    } else {
        echo "Album not found.";
        exit;
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
} else {
    echo "No album ID provided.";
    exit;
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
                            <h5>Edit Album</h5>
                            <a href="album.php" class="btn btn-dark">Cancel</a>
                        </div>

                        <!-- Edit Artist Form -->
                        <form action="database/album-edit.php" method="POST" enctype="multipart/form-data" class="mb-4">
                            <input type="hidden" name="AlbumID" value="<?php echo $album['AlbumID']; ?>">
                            
                            <div class="mb-3">
                                <label for="Title" class="form-label">Album</label>
                                <input type="text" name="Title" id="Title" class="form-control" value="<?php echo htmlspecialchars($album['Title']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="ReleaseDate" class="form-label">Release Date</label>
                                <input type="date" name="ReleaseDate" id="ReleaseDate" class="form-control" value="<?php echo htmlspecialchars($album['ReleaseDate']); ?>" required>
                            </div>
                            <!-- Artist -->
                            <div class="mb-3">
                                <label for="artistId" class="form-label">Artist</label>
                                <select name="artistId" id="artistId" class="form-select" required>
                                    <option value="">Select Artist</option>
                                    <?php while ($row = $artists->fetch_assoc()): ?>
                                        <option value="<?php echo $row['ArtistID']; ?>" <?php echo ($row['ArtistID'] == $album['ArtistID']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($row['Name']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Update Album</button>
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
