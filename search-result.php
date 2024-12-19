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
                              <h5>Search results</h5>
                            </div>
                                              
                            <!-- This is the scrollable part -->
                            <div class="music-list overflow-auto" style="max-height: 520px;">
                                <div class="items">
                                  <!-- include('database/search.php'); -->
                                  <?php include('database/search-binary.php'); ?> <!-- Using binary search -->
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
<style>
    /* Remove the dropdown arrow */
.btn.dropdown-toggle::after {
    display: none; /* Hides the arrow */
}
</style>