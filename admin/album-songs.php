<?php
include('../security.php');
include('includes/header.php');

// Fetch album details if AlbumID is provided
if (isset($_GET['AlbumID'])) {
    $albumID = $_GET['AlbumID'];

    // Fetch album details including ArtistID
    $query = "SELECT * FROM albums WHERE AlbumID = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $albumID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $album = $result->fetch_assoc();
        $artistID = $album['ArtistID'];
    } else {
        echo "Album not found.";
        exit;
    }

    // Fetch all artists
    $artists = $connection->query("SELECT * FROM artists");

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
                <!-- Left Side Content -->
                <section class="col-md-8 p-4">
                    <!-- Music List Section -->
                    <div class="music-list-container p-3 mt-3 text-white rounded">
                        <div class="header d-flex justify-content-between mb-3">
                            <?php
                            $albumName = htmlspecialchars($album['Title']); // Set the album name
                            ?>
                            <h5><?php echo $albumName; ?></h5>
                            <a href="album.php" class="btn btn-dark">Cancel</a>
                        </div>
                        <!-- This is the scrollable part -->
                        <div class="music-list overflow-y-auto" style="max-height: 520px; max-width: 100%;">
                            <div class="items">
                                <?php include('database/fetch-album-songs.php'); ?>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this artist?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a id="confirmDeleteButton" class="btn btn-danger" href="#">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Audio Player Section -->
            <?php include 'includes/audioplayer.php'; ?>
        </div>
    </div>
</div>

<?php include 'includes/scripts.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    let songIdToDelete;

    // Event listener for delete buttons
    document.querySelectorAll('.delete-song').forEach(button => {
        button.addEventListener('click', function() {
            songIdToDelete = this.getAttribute('data-song-id');
            const deleteUrl = 'database/songs-delete.php?id=' + songIdToDelete;
            document.getElementById('confirmDeleteButton').setAttribute('href', deleteUrl);
        });
    });
});
</script>