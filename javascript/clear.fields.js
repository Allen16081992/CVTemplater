"use strict"; // Dhr. Allen Pieter
// Function to clear fields by their name attribute
function clearFields(formName, ...fieldNames) {
  const form = document.forms[formName];
  fieldNames.forEach((fieldName) => {
    const fields = form.querySelectorAll(`[name="${fieldName}"]`);
    fields.forEach((field) => {
      field.value = "";
    });
  });
}

// Attach event listeners to the clear buttons

// Clear account fields
document.querySelector('[name="clearAccount"]').addEventListener('click', function(event) {
  clearFields('account', 'username', 'pwd', 'email', 'pwdR');
});

// Clear address fields
document.querySelector('[name="clearAddress"]').addEventListener('click', function(event) {
  clearFields('address', 'streetname', 'postalcode', 'city', 'nationality');
});

// Clear personal fields
document.querySelector('[name="clearPersonal"]').addEventListener('click', function(event) {
  clearFields('personal', 'firstname', 'lastname', 'phone', 'birth');
});