<?php
    include('security.php'); 
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
                            <h5>Trending New Song</h5>
                            <div class="info">
                                <h2>Sining</h2>
                                <h4>Dionela ft. Jay-R</h4>
                                <h5>3 Million Plays</h5>
                                <div class="buttons d-flex gap-3 mb-4">
                                    <button class="btn btn-primary listen-now-btn" 
                                            data-title="Sining" 
                                            data-artist="Dionela ft. Jay-R" 
                                            data-file="music/Sining.mp3">
                                        <i class='bx bx-play-circle'></i> Listen Now
                                    </button>
                                    <i class='bx bxs-heart text-light'></i>
                                </div>
                            </div>
                        </div>
                        <img src="admin/img/sining.jpg" alt="Album Cover" class="img-fluid rounded">
                    </div>

                    <!-- Playlist Section Added Below -->
                    <div class="playlist mt-3 d-flex gap-4">
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

<!-- For the listen now script -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
  const listenNowBtn = document.querySelector(".listen-now-btn");
  const playerTitle = document.querySelector(".song-title");
  const playerArtist = document.querySelector(".song-artist");
  const audioPlayer = document.querySelector(".audio-player");

  function playSong(title, artist, file) {
    playerTitle.textContent = title;
    playerArtist.textContent = artist;
    audioPlayer.src = file;
    audioPlayer.play();
    updatePlayButton(true);
  }

  listenNowBtn.addEventListener("click", function () {
    const title = this.getAttribute("data-title");
    const artist = this.getAttribute("data-artist");
    const file = this.getAttribute("data-file");
    playSong(title, artist, file);
  });

  function updatePlayButton(isPlaying) {
    const playButton = document.querySelector(".btn-play");
    playButton.innerHTML = isPlaying
      ? '<i class="bx bx-pause"></i>'
      : '<i class="bx bx-play"></i>';
  }
});

</script>