<aside class="player-section col-md-4 p-4 text-white position-absolute end-0">
    <div class="d-flex flex-column align-items-center">
        <img src="img/player.png" alt="Album Cover" class="img-fluid mb-3 rounded" width="100%">
        <h3 class="song-title">Song Title</h3>
        <p class="text song-artist">Artist Name</p>
        
        <!-- Time and Progress -->
        <div class="d-flex align-items-center gap-2 w-100 mb-3">
            <span class="current-time">0:00</span>
            <input type="range" class="form-range flex-grow-1 audio-progress" min="0" max="100" step="1">
            <span class="duration">0:00</span>
        </div>
        
        <!-- Controls -->
        <div class="d-flex justify-content-center gap-4 mb-3">
            <button class="btn btn-outline-light skip-back">
                <i class="bx bx-skip-previous"></i>
            </button>
            <button class="btn btn-primary btn-play">
                <i class="bx bx-play"></i>
            </button>
            <button class="btn btn-outline-light skip-forward">
                <i class="bx bx-skip-next"></i>
            </button>
        </div>

        <!-- Hidden Audio Element -->
        <audio class="audio-player" style="display:none;"></audio>
    </div>
</aside>
