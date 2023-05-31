"use strict";
// Play sound on page load.
document.addEventListener('DOMContentLoaded', function() {
    var roundElement = document.getElementById('round');
//    var audioElement = document.getElementById('mySound');
    roundElement.style.opacity = 1;
//    audioElement.play();
});

// Play sound on click.
//document.addEventListener('DOMContentLoaded', function() {
//  var button = document.getElementById('action');
//  var audioElement = document.getElementById('mySound');

//  button.addEventListener('click', function() {
//    audioElement.play();
//  });

//  button.addEventListener('mouseout', function() {
//    audioElement.pause();
//    audioElement.currentTime = 0;
//  });
//});

//const roundElement = document.getElementById('round');
//const actionButton = document.getElementById('action');

//actionButton.addEventListener('click', function() {
//  roundElement.style.opacity = 1;
//});


// Play sound on hover.
function PlaySound(soundobj) {
  var thissound = document.getElementById(soundobj);
  thissound.play();
}

//function StopSound(soundobj) {
//  var thissound = document.getElementById(soundobj);
//  thissound.pause();
//  thissound.currentTime = 0;
//}

