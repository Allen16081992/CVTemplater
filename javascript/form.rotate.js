"use strict"; // Dhr. Allen Pieter - In collaboration with ChatGPT
var tabs = document.getElementsByClassName("tab");
var currentTabIdx = 0;

// Show the initial tab
showTab(currentTabIdx);

// Function to display a specific tab and update the navigation buttons
function showTab(tabIndex) {
  var currentTab = tabs[tabIndex];
  currentTab.style.display = "block";

  // Hide the 'Back' button on the first tab
  if (tabIndex == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }

  // Change the 'Next' button and attribute on the last tab
  if (tabIndex == tabs.length - 1) {
    document.getElementById("nextBtn").innerHTML = "Signup";
    document.getElementById("nextBtn").setAttribute("name", "submit");
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
    document.getElementById("nextBtn").removeAttribute("name");
  }
  // Update the styling of the step indicators based on the current tab.
  fixStepIndicator(tabIndex);
}

// Function to navigate to the next or previous tab
function nextPrev(direction) {
  var currentTab = tabs[currentTabIdx];

  // Validate the form before moving to the next tab
  if (direction == 1 && !validateForm()) {
    return false;
  }

  currentTab.style.display = "none";
  currentTabIdx += direction;

  // If last tab, submit the form
  if (currentTabIdx >= tabs.length) {
    document.getElementById("rotateForm").submit();
    return false;
  }

  showTab(currentTabIdx);
}

// Validate the form input fields in the current tab
function validateForm() {
  var currentTab = tabs[currentTabIdx];
  var inputs = currentTab.getElementsByTagName("input");
  var isValid = true;

  // Check if the input fields are empty
  for (var inputIdx = 0; inputIdx < inputs.length; inputIdx++) {
    if (inputs[inputIdx].value == "") {
      inputs[inputIdx].className += " invalid"; // Add class 'invalid', css makes the fields red
      isValid = false;
    }
  }

  // Add 'finish' class to the current step if the form is valid
  if (isValid) {
    document.getElementsByClassName("step")[currentTabIdx].className += " finish";
  }

  return isValid;
}

// Update the 'glowing circles' step indicators based on the current tab
function fixStepIndicator(currentStep) {
  var steps = document.getElementsByClassName("step");
  
  // Remove 'active' class from all steps
  for (var stepIdx = 0; stepIdx < steps.length; stepIdx++) {
    steps[stepIdx].className = steps[stepIdx].className.replace(" active", "");
  }
  
  // Add 'active' class to the current step
  steps[currentStep].className += " active";
}