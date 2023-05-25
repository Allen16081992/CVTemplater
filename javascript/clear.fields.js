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

// Example usage:
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
