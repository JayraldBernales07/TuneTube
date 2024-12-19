<?php
    include('../security.php'); 
    include('includes/header.php'); 
?>
<div class="container-fluid">
    <div class="row">
        <?php include 'includes/sidebar.php'; ?> 

        <div class="col-md-10 position-relative">
            <?php include 'includes/topbar.php'; ?> 

            <main class="row">
                <!-- Left Side Content -->
                <section class="col-md-8 p-4">
                    <!-- Song Info with Image -->
                    <div class="trending d-flex align-items-center">
                        <div class="left flex-grow-1">
                            <h5>Trending New Song <strong> (ADMIN)</strong></h5>
                            <div class="info">
                                <h2>Sining</h2>
                                <h4>Dionela ft. Jay-R</h4>
                                <h5>3 Million Plays</h5>
                                <div class="buttons d-flex gap-3 mb-4">
                                    <button class="btn btn-success">
                                        <i class='bx bx-play-circle'></i> Edit Song
                                    </button>
                                    <button class="btn btn-danger">
                                        <i class='bx bx-play-circle'></i> Delete Song
                                    </button>
                                    <i class='bx bxs-heart text-light'></i>
                                </div>
                            </div>
                        </div>
                        <img src="img/sining.jpg" alt="Album Cover" class="img-fluid rounded">
                    </div>

                    <!-- Playlist Section Added Below -->
                    <div class="playlist mt-3 d-flex gap-4">
                        <!-- Genres Section -->
                        <!-- Genres Section -->
                        <div class="genres p-3 text-white rounded" style="width: 40%;">
                            <div class="header d-flex justify-content-between mb-3">
                                <h5>Artist</h5>
                                <a href="artist.php" class="text">See all</a>
                            </div>
                            <div class="items row g-2">
                                <?php
                                    // Include the PHP code to fetch and display songs here
                                    include('database/dash-fetch-artist.php'); 
                                ?>
                     
                            </div>
                        </div>
            
                        <!-- Music List Section -->
                        <div class="music-list p-3 text-white rounded" style="width: 65%;">
                            <div class="header d-flex justify-content-between mb-3">
                                <h5>Top Songs</h5>
                                <a href="songs.php" class="text">See all</a>
                            </div>
                            <div class="items">
                                <?php
                                    // Include the PHP code to fetch and display songs here
                                    include('database/dash-fetch-songs.php'); 
                                ?>
                                <style>
                                    .song-row {
                                        cursor: pointer;
                                        transition: background-color 0.3s ease;
                                        padding: 8px;
                                        border-radius: 5px;
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <!-- Player Section -->
            <?php include 'includes/audioplayer.php'; ?> 
        </div>
    </div>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
