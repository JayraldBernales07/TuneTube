// document.addEventListener("DOMContentLoaded", function() {
//     const ajaxLinks = document.querySelectorAll(".ajax-link");
//     const mainContent = document.querySelector("main");

//     ajaxLinks.forEach(link => {
//         link.addEventListener("click", function(event) {
//             event.preventDefault();
//             const url = this.getAttribute("href");

//             fetch(url)
//                 .then(response => response.text())
//                 .then(data => {
//                     const parser = new DOMParser();
//                     const doc = parser.parseFromString(data, "text/html");
//                     const newContent = doc.querySelector("main").innerHTML;
//                     mainContent.innerHTML = newContent;

//                     // Reattach event listeners to the newly loaded content
//                     attachEventListeners();
//                 })
//                 .catch(error => console.error("Error loading page:", error));
//         });
//     });

//     function attachEventListeners() {
//         // Example: Reattach play button event listener
//         const playButton = document.querySelector(".btn-play");
//         playButton.addEventListener("click", function() {
//             const audioPlayer = document.querySelector(".audio-player");
//             if (audioPlayer.paused) {
//                 audioPlayer.play();
//             } else {
//                 audioPlayer.pause();
//             }
//             updatePlayButton(!audioPlayer.paused);
//         });

//         // Reattach other necessary event listeners, such as song row clicks, etc.
//         const songRows = document.querySelectorAll(".song-row");
//         songRows.forEach((row, index) => {
//             row.addEventListener("click", function() {
//                 currentSongIndex = index;
//                 loadSong(index);
//             });
//         });

//         // Similar functions for favorite buttons, etc.
//     }

//     function updatePlayButton(isPlaying) {
//         const playButton = document.querySelector(".btn-play");
//         playButton.innerHTML = isPlaying
//             ? '<i class="bx bx-pause"></i>'
//             : '<i class="bx bx-play"></i>';
//     }

//     function loadSong(index) {
//         // This should be adjusted to fetch song details as per the previous script
//     }

//     // Initial attachment of event listeners
//     attachEventListeners();
// });
