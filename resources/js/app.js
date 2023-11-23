import './bootstrap';

import Alpine from 'alpinejs';

import 'flowbite';

window.Alpine = Alpine;

Alpine.start();

//========================================NEW==========================================

// Handle dark mode toggle ====================================================================================
var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Change the icons inside the button based on previous settings
if (localStorage.getItem('color-theme') === 'dark') {
    themeToggleLightIcon.classList.remove('hidden');
    document.documentElement.classList.add('dark');
    localStorage.setItem('color-theme', 'dark');
} else {
    themeToggleDarkIcon.classList.remove('hidden');
    document.documentElement.classList.remove('dark');
    localStorage.setItem('color-theme', 'light');
}

var themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', function() {

    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }

    // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }
    
});


//=====================================OLD==================================================
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

// ==================================================================
