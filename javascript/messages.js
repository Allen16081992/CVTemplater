"use strict"; // Dhr. Allen Pieter
// Error messages for submitting no values.
// Target Index - Login fields
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

// Target Client - New Resume Window
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

// Target Client - Delete Resume Window
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

// Target Client - Resume tab
var resumeForm = document.forms['resume'];
if (resumeForm) {
  resumeForm.onsubmit = function(event) {
    if(this.cvname.value.trim() == ""){
      displayErrorMessage(".error-resume-tab", "Please name your resume.");
      event.preventDefault();
      return false;
    }
  }
}

// Target Client - Profile tab (became conditional)

// Target Client - Work tab
var resumeForm = document.forms['experience'];
if (resumeForm) {
  resumeForm.onsubmit = function(event) {
    if(this.from.value.trim() == ""){         
      displayErrorMessage(".error-work-tab", "No date of employment.");
      event.preventDefault();
      return false;
    }
    if(this.until.value.trim() == ""){
      displayErrorMessage(".error-work-tab", "No date of unemployment.");
      event.preventDefault();
      return false;
    }
    if(this.worktitle.value.trim() == ""){
      displayErrorMessage(".error-work-tab", "Please provide your profession.");
      event.preventDefault();
      return false;
    }
    if(this.company.value.trim() == ""){
      displayErrorMessage(".error-work-tab", "No company provided.");
      event.preventDefault();
      return false;
    }
    if(this.workdesc.value.trim() == ""){
      displayErrorMessage(".error-work-tab", "No job summary provided.");
      event.preventDefault();
      return false;
    }
  }
}

// Target Client - Education tab
var resumeForm = document.forms['education'];
if (resumeForm) {
  resumeForm.onsubmit = function(event) {
    if(this.from.value.trim() == ""){         
      displayErrorMessage(".error-education-tab", "No start date provided.");
      event.preventDefault();
      return false;
    }
    if(this.until.value.trim() == ""){
      displayErrorMessage(".error-education-tab", "No graduation date provided.");
      event.preventDefault();
      return false;
    }
    if(this.edutitle.value.trim() == ""){
      displayErrorMessage(".error-education-tab", "No education provided.");
      event.preventDefault();
      return false;
    }
    if(this.company.value.trim() == ""){
      displayErrorMessage(".error-education-tab", "No school provided.");
      event.preventDefault();
      return false;
    }
    if(this.edudesc.value.trim() == ""){
      displayErrorMessage(".error-education-tab", "No education summary provided.");
      event.preventDefault();
      return false;
    }
  }
}

// Target Client - Skills tab
var resumeForm = document.forms['skills'];
if (resumeForm) {
  resumeForm.onsubmit = function(event) {
    if(this.technical.value.trim() == ""){         
      displayErrorMessage(".error-skill-tab", "No skills provided.");
      event.preventDefault();
      return false;
    }
    if(this.language.value.trim() == ""){
      displayErrorMessage(".error-skill-tab", "No language provided.");
      event.preventDefault();
      return false;
    }
    if(this.interest.value.trim() == ""){
      displayErrorMessage(".error-skill-tab", "No interest or hobby provided.");
      event.preventDefault();
      return false;
    }
  }
}

// Error message function.
function displayErrorMessage(selector, message) {
  var errorElement = document.querySelector(selector);
  if (errorElement) {
    errorElement.innerHTML = message;
    errorElement.style.display = "block";
  }
}