document.addEventListener("DOMContentLoaded", function () {
  const songRows = document.querySelectorAll(".song-row");
  const favoriteButtons = document.querySelectorAll(".add-to-favorite");
  const playerTitle = document.querySelector(".song-title");
  const playerArtist = document.querySelector(".song-artist");
  const audioPlayer = document.querySelector(".audio-player");
  const progressSlider = document.querySelector(".audio-progress");
  const playButton = document.querySelector(".btn-play");
  const skipBackButton = document.querySelector(".skip-back");
  const skipForwardButton = document.querySelector(".skip-forward");

  let currentSongIndex = 0;
  const songs = Array.from(songRows).map((row) => ({
    title: row.getAttribute("data-title"),
    artist: row.getAttribute("data-artist"),
    file: row.getAttribute("data-file"),
    id: row.getAttribute("data-song-id"),
  }));

  function loadSong(index) {
    const song = songs[index];
    playerTitle.textContent = song.title;
    playerArtist.textContent = song.artist;
    audioPlayer.src = song.file;
    audioPlayer.play();
    updatePlayButton(true);
  }

  // Attach click events to song rows for playing songs
  songRows.forEach((row, index) => {
    row.addEventListener("click", function () {
      currentSongIndex = index;
      loadSong(index);
    });
  });

  // Play/pause functionality
  playButton.addEventListener("click", function () {
    if (audioPlayer.paused) {
      audioPlayer.play();
      updatePlayButton(true);
    } else {
      audioPlayer.pause();
      updatePlayButton(false);
    }
  });

  skipBackButton.addEventListener("click", function () {
    currentSongIndex = (currentSongIndex - 1 + songs.length) % songs.length;
    loadSong(currentSongIndex);
  });

  skipForwardButton.addEventListener("click", function () {
    currentSongIndex = (currentSongIndex + 1) % songs.length;
    loadSong(currentSongIndex);
  });

  audioPlayer.addEventListener("ended", function () {
    currentSongIndex = (currentSongIndex + 1) % songs.length;
    loadSong(currentSongIndex);
  });

  audioPlayer.addEventListener("timeupdate", function () {
    progressSlider.value =
      (audioPlayer.currentTime / audioPlayer.duration) * 100 || 0;
    document.querySelector(".current-time").textContent = formatTime(
      audioPlayer.currentTime
    );
    document.querySelector(".duration").textContent = formatTime(
      audioPlayer.duration || 0
    );
  });

  progressSlider.addEventListener("input", function () {
    audioPlayer.currentTime = (this.value / 100) * audioPlayer.duration;
  });

  function updatePlayButton(isPlaying) {
    playButton.innerHTML = isPlaying
      ? '<i class="bx bx-pause"></i>'
      : '<i class="bx bx-play"></i>';
  }

  function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);
    return `${minutes}:${remainingSeconds < 10 ? "0" : ""}${remainingSeconds}`;
  }
});

//FAVORITE

document.addEventListener("DOMContentLoaded", function () {
  const favoriteButtons = document.querySelectorAll(".add-to-favorite");

  favoriteButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      event.stopPropagation(); // Prevent playing the song on add favorite dropdown click
      const songId = this.getAttribute("data-song-id");
      addToFavorites(songId, button);
    });
  });

  function addToFavorites(songId, button) {
    console.log(`Sending request to add song with ID ${songId} to favorites.`);

    fetch("database/favorites-add.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ songId }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          console.log(`Song with ID ${songId} added to favorites.`);
          alert("Succesfully added song to favorites: ");
        } else {
          alert("Failed to add song to favorites: " + data.message);
        }
      })
      .catch((error) => {
        console.error("Error adding to favorites:", error);
        alert("An error occurred while adding the song to favorites.");
      });
  }
});
