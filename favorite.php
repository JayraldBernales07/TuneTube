<?php
include('security.php'); 
include('includes/header.php'); 
?>
<div class="container-fluid">
    <div class="row">
        <?php include 'includes/sidebar-fav.php'; ?> 

        <div class="col-md-10 position-relative">
            <?php include 'includes/topbar.php'; ?> 

            <main class="row">
                <!-- Left Side Content -->
                <section class="col-md-8 p-4">
                    <!-- Music List Section -->
                    <div class="music-list-container p-3 mt-3 text-white rounded">
                        <div class="header d-flex justify-content-between mb-3">
                            <h5>Favorites</h5>
                              <!-- Dropdown Button (Dot Icon) -->
                              <div class="dropdown">
                                  <i class="bx bx-dots-vertical" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;" title="Option"></i>
                                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="songs.php">Add Songs</a></li>
                                    <li><a class="dropdown-item" href="#">Share</a></li>
                                  </ul>
                                </div>
                              </div>
                        <!-- This is the scrollable part -->
                        <div class="music-list overflow-auto" style="max-height: 520px;">
                            <div class="items">
                                <?php include('database/fetch-favorite.php'); ?>
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
