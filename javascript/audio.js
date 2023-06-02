"use strict";
// Play sound on page load.
document.addEventListener('DOMContentLoaded', function() {
    var roundElement = document.getElementById('round');
    roundElement.style.opacity = 1;
});

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

