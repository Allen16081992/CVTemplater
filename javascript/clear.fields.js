"use strict";
// Function to clear fields by their name attribute
function clearFields(formName, ...fieldNames) {
  const form = document.forms[formName];
  fieldNames.forEach((fieldName) => {
    const field = form.elements[fieldName];
    if (field) {
      field.value = "";
    }
  });
}

// Clear account fields
document.forms['account'].onsubmit = function(event) {
  clearFields('account', 'username', 'pwd', 'email', 'pwdR');
  // Additional logic for account form submission
};

// Clear address fields
document.forms['address'].onsubmit = function(event) {
  clearFields('address', 'streetname', 'postalcode', 'city', 'nationality');
  // Additional logic for address form submission
};

// Clear personal fields
document.forms['personal'].onsubmit = function(event) {
  clearFields('personal', 'firstname', 'lastname', 'phone', 'birth');
  // Additional logic for personal form submission
};

// Clear account fields
function ClearAccFields() {
  clearFields('account', 'username', 'pwd', 'email', 'pwdR');
}

// Clear address fields
function ClearAddrFields() {
  clearFields('address', 'streetname', 'postalcode', 'city', 'nationality');
}

// Clear personal fields
function ClearPersFields() {
  clearFields('personal', 'firstname', 'lastname', 'phone', 'birth');
}

// Resume Intersection

// Clear resume field
document.forms['resume'].onsubmit = function(event) {
  clearFields('resume', 'resumetitle');
  // Additional logic for account form submission
};

// Clear profile fields
document.forms['profile'].onsubmit = function(event) {
  clearFields('profile', 'intro', 'desc');
  // Additional logic for account form submission
};

// Clear resume field
function ClearResField() {
  clearFields('resume', 'resumetitle');
}

// Clear profile fields
function ClearProfFields() {
  clearFields('profile', 'intro', 'desc');
}


