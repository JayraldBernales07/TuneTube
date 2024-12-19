<?php
    include('security.php'); 
    include('includes/header.php'); 
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
                            <h5>Album</h5>
                                <!-- Dropdown Button (Dot Icon) -->
                                <div class="dropdown">
                                    <i class="bx bx-dots-vertical" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;" title="Option"></i>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                      <li><a class="dropdown-item" href="album-form-add.php">Add Album</a></li>
                                      <li><a class="dropdown-item" href="#">Multi-select</a></li>
                                      <li><a class="dropdown-item" href="#">Share</a></li>
                                    </ul>
                                </div>
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
                                            Are you sure you want to delete this album?
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
                                <div class="items row p-3 g-6">
                                    <?php include('database/fetch-album.php'); ?>
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
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    let albumIdToDelete;

    // Event listener for delete buttons
    document.querySelectorAll('.delete-album').forEach(button => {
        button.addEventListener('click', function() {
            albumIdToDelete = this.getAttribute('data-album-id');
            const deleteUrl = 'database/album-delete.php?AlbumID=' + albumIdToDelete;
            document.getElementById('confirmDeleteButton').setAttribute('href', deleteUrl);
        });
    });
});
</script>