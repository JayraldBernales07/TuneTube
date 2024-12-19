<?php
include('security.php'); 
include('includes/header.php'); 
?>
<div class="container-fluid">
    <div class="row">
        <?php include 'includes/sidebar-songs.php'; ?> 

        <div class="col-md-10 position-relative">
            <?php include 'includes/topbar.php'; ?> 

              <main class="row">
                  <!-- Left Side Content -->
                  <section class="col-md-8 p-4">
                      <!-- Music List Section -->
                      <div class="music-list-container p-3 mt-3 text-white rounded">
                          <div class="header d-flex justify-content-between mb-3">
                              <h5>Songs List</h5>
                              <!-- Dropdown Button (Dot Icon) -->
                              <div class="dropdown">
                                <i class="bx bx-dots-vertical" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;" title="Option"></i>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                  <li><a class="dropdown-item" href="songs-add.php">Add Songs</a></li>
                                  <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#sortModal">
                                      Sort by
                                    </button>
                                  </li>
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
                                              Are you sure you want to delete this song?
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                              <a id="confirmDeleteButton" class="btn btn-danger" href="#">Delete</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- Modal Structure for Sort by -->
                              <div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="sortModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm"> <!-- Make modal smaller -->
                                  <div class="modal-content"> <!-- Modal background -->
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="sortModalLabel">Sort Order</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px;"></button>
                                    </div>
                                <div class="modal-body">
                                  <!-- Sort Options in Modal with Checkboxes -->
                                  <ul class="list-unstyled">
                                      <li class="d-flex justify-content-between align-items-center">
                                          <label for="alphabetical" class="form-check-label">Sort by song title</label>
                                          <input type="radio" name="sortOption" id="alphabetical" class="form-check-input" value="title" />
                                      </li>
                                      <li class="d-flex justify-content-between align-items-center">
                                          <label for="dateAdded" class="form-check-label">Sort by date added</label>
                                          <input type="radio" name="sortOption" id="dateAdded" class="form-check-input" value="date" />
                                      </li>
                                      <li class="d-flex justify-content-between align-items-center">
                                          <label for="artist" class="form-check-label">Sort by artist</label>
                                          <input type="radio" name="sortOption" id="artist" class="form-check-input" value="artist" />
                                      </li>
                                  </ul>
                                </div>
                              </div>
                          </div>
                        </div>
                                              
                          <!-- This is the scrollable part -->
                          <div class="music-list overflow-auto" style="max-height: 520px;">
                              <div class="items">
                                  <?php include('database/fetch-songs.php'); ?>
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
document.querySelectorAll('input[name="sortOption"]').forEach((radio) => {
    radio.addEventListener('change', function() {
        const sortBy = this.value;
        fetchSongs(sortBy);
    });
});

function fetchSongs(sortBy) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'database/fetch-songs.php?sort=' + sortBy, true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.querySelector('.items').innerHTML = this.responseText;
        }
    };
    xhr.send();
}

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