// Dhr. A Pieter.
var cells = document.getElementsByClassName('row-field');
var inputCounter = 1;

for (var i = 0; i < cells.length; i++) {
  cells[i].addEventListener('click', function(event) {
    // Check if the click event occurred on the input field
    if (event.target.classList.contains('input-field')) {
      var inputField = event.target;

      // Get the input field's value
      var inputValue = inputField.value;

      // Get the parent cell element
      var cell = inputField.parentElement;

      // Replace the input field with the value
      cell.innerHTML = inputValue;

      // Increment the input counter if the input field was removed
      inputCounter++;

      return; // Exit if the click occurred on the input field itself
    }

    // Check if the cell already contains an input field
    var inputField = this.querySelector('.input-field');
    if (inputField) {
      return; // Exit if an input field already exists
    }

    // Get the cell's current value
    var currentValue = this.textContent.trim();

    // Create an input field with the current value
    inputField = document.createElement('input');
    inputField.setAttribute('type', 'text');
    inputField.setAttribute('class', 'input-field');
    inputField.setAttribute('name', 'Skill[' + inputCounter + ']'); // Assign unique name
    inputField.value = currentValue;

    // Increment the input counter for the next input field
    inputCounter++;

    // Replace the cell's content with the input field
    this.innerHTML = '';
    this.appendChild(inputField);

    // Set focus on the input field
    inputField.focus();
  });
}