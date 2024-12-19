// Handle remove favorite button clicks
document.querySelectorAll(".remove-from-favorite").forEach((button) => {
  button.addEventListener("click", function (event) {
    event.stopPropagation(); // Prevent playing the song on favorite button click
    const songId = this.getAttribute("data-song-id");
    removeFromFavorites(songId, button); // Pass button to change icon on success
  });
});

// Remove song from favorites and stop the audio player
function removeFromFavorites(songId, button) {
  console.log(
    `Sending request to remove song with ID ${songId} from favorites.`
  );

  // Stop the audio player when removing from favorites
  const audioPlayer = document.querySelector(".audio-player");
  audioPlayer.pause(); // Pause the player
  audioPlayer.currentTime = 0; // Optionally reset to the start

  // Example: Send an AJAX request to the backend
  fetch("database/favorites-remove.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ songId }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        console.log(`Song with ID ${songId} removed from favorites.`);

        // Remove the song from the displayed list (DOM removal)
        const songRow = button.closest(".song-row");
        if (songRow) {
          songRow.remove();
        }
      } else {
        alert("Failed to remove song from favorites.");
      }
    })
    .catch((error) => {
      console.error("Error removing from favorites:", error);
      alert("An error occurred while removing the song from favorites.");
    });
}
