<?php
include('security.php'); 
include('includes/header.php'); 
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'includes/sidebar-artist.php'; ?> 

        <div class="col-md-10 position-relative">
            <?php include 'includes/topbar.php'; ?> 

            <main class="row">
                <!-- Left Side Content -->
                <section class="col-md-8 p-4">
                    <!-- Music List Section -->
                    <div class="music-list-container p-3 mt-3 text-white rounded">
                        <div class="header d-flex justify-content-between mb-3">
                            <?php
                            // Get ArtistID from the URL
                            $artistID = isset($_GET['ArtistID']) ? $_GET['ArtistID'] : null;
                            $artistName = 'Unknown Artist'; // Default value

                            if ($artistID) {
                                // Connect to the database
                                $connection = mysqli_connect("localhost", "root", "", "tunetube");

                                // Fetch artist name from the database
                                $query = "SELECT Name FROM artists WHERE ArtistID = " . (int)$artistID;
                                $result = mysqli_query($connection, $query);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $artistName = htmlspecialchars($row['Name']); // Set the artist name
                                }

                                mysqli_close($connection);
                            }
                            ?>
                            <h5><?php echo $artistName; ?></h5>
                            <a href="javascript:window.history.length > 1 ? history.back() : 'artist.php';" class="btn btn-dark">Cancel</a>
                        </div>

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
                        <!-- This is the scrollable part -->
                        <div class="music-list overflow-y-auto" style="max-height: 520px; max-width: 100%;">
                            <div class="items">
                                <?php include('database/fetch-artist-songs.php'); ?>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

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