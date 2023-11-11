import './bootstrap';

import Alpine from 'alpinejs';

import 'flowbite';

window.Alpine = Alpine;

Alpine.start();

//create item modal
document.addEventListener("DOMContentLoaded", function (event) {
  document.getElementById('defaultModalButton').click();
});

//confirm delete item modal
document.addEventListener("DOMContentLoaded", function (event) {
  document.getElementById('deleteButton').click();
});

//add member to class - dynamically search ----------=================================
// Get the input element
const searchBar = document.getElementById('class-search-user');
// Add an event listener for input changes
searchBar.addEventListener('input', function () {
  // Get the input value
  const inputValue = searchBar.value.toLowerCase();

  // Get all list items
  const listItems = document.querySelectorAll('tbody tr[id^="class-search-user-result-"]');

  // Loop through each list item
  listItems.forEach(function (item) {
    // Get the text content of the list item
    const itemText = item.textContent.toLowerCase();
    // Check if the input value is empty
    if (inputValue === '') {
      // If empty, add the 'hidden' class
      item.classList.add('hidden');
    } else {
      // If not empty, check if the item text contains the input value
      if (itemText.includes(inputValue)) {
        // If it does, remove the 'hidden' class
        item.classList.remove('hidden');
      } else {
        // If it doesn't, add the 'hidden' class
        item.classList.add('hidden');
      }
    }
  });
});
//===================================================================================

//========handling class members edit ========================================
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
const header = document.getElementById('class-members-header');
checkboxes.forEach(checkbox => {
  checkbox.addEventListener('click', () => {
    // if (checkbox.checked) {
      header.textContent = "Class members changed! Click Update to apply.";
      header.classList.add('text-rose-400');
    //}
  });
});