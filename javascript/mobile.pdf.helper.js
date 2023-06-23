"use strict"; // Dhr. Allen Pieter
const isPortrait = window.matchMedia("(orientation: portrait)").matches;
const button = document.getElementById('PDF');

button.onclick = function() {
  if (window.matchMedia("(orientation: portrait)").matches) {
    window.open('config/download.config.php', '_blank');
  } else {
    window.location.href = 'config/download.config.php';
  }
};