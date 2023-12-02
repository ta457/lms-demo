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
