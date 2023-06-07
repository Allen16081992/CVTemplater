"use strict";
// Error messages for submitting no values.
// Target - Login fields
var loginForm = document.forms['popup'];
if (loginForm) {
  loginForm.onsubmit = function(event) {
    if(this.username.value.trim() == ""){
      displayErrorMessage(".error-uid", "&bull; No Username Provided!");
      event.preventDefault();
      return false;
    }
    if(this.pwd.value.trim() == ""){
      displayErrorMessage(".error-pwd", "&bull; No Password Provided!");
      event.preventDefault();
      return false;
    }
  }
}

// Target - New Resume/CVName field
var resumeForm = document.forms['popup2'];
if (resumeForm) {
  resumeForm.onsubmit = function(event) {
    if(this.cvname.value.trim() == ""){
      displayErrorMessage(".error-res", "&bull; Please name your resume.");
      event.preventDefault();
      return false;
    }
  }
}

// Target - Delete Resume/CVName Select
var deleteForm = document.forms['popup3'];
if (deleteForm) {
  deleteForm.onsubmit = function(event) {
    // Validate select element
    var selectedOption = deleteForm.selectCv.value;
    if (selectedOption === "") {
      displayErrorMessage(".error-select", "&bull; Please select an option.");
      event.preventDefault();
      return false;
    }
  };
}

// Error message function.
function displayErrorMessage(selector, message) {
  var errorElement = document.querySelector(selector);
  if (errorElement) {
    errorElement.innerHTML = message;
    errorElement.style.display = "block";
  }
}