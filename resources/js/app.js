import './bootstrap';

import Alpine from 'alpinejs';

import 'flowbite';

window.Alpine = Alpine;

Alpine.start();

//create
document.addEventListener("DOMContentLoaded", function(event) {
  document.getElementById('defaultModalButton').click();
});


// document.addEventListener('DOMContentLoaded', function() {
//   let i = 1;
//   let button = document.getElementById('admin-action-dropdown-btn-' + i);
//   while (button) {
//     let divToHide = document.getElementById('admin-action-dropdown-' + i);
//     button.addEventListener('click', function() {
//       event.stopPropagation()
//       divToHide.classList.remove('hidden');
//       divToHide.classList.add('absolute');
//     });

//     i++;
//     button = document.getElementById('admin-action-dropdown-btn-' + i);
//   }
  
//   document.addEventListener('click', function (event) {
//     const buttons = Array.from(document.querySelectorAll('[id^="admin-action-dropdown-btn-"]'));
//     const divs = Array.from(document.querySelectorAll('[id^="admin-action-dropdown-"]'));
//     if (!buttons.includes(event.target) && !divs.includes(event.target)) {
//       divs.forEach(div => div.classList.add('hidden'));
//     }
//   });

// });

// function fillUpdateModal(id) {
//   const header = document.getElementById('update-header');
//   header.textContent = "Update record of ID = " + id;

//   const row = document.getElementById('user-' + id);
//   const tdElements = row.querySelectorAll('td');
//   const tdValues = Array.from(tdElements).map(td => td.textContent);
//   tdValues.shift();
//   tdValues.pop();
//   console.log(tdValues);

//   const fields = ['updateUser-name','updateUser-username','updateUser-email','updateUser-role','updateUser-faculty_id'];
//   fields.forEach((field, index) => {
//     const element = document.getElementById(field);
//     element.value = tdValues[index];
//   });

//   const deleteForm = document.getElementById('deleteUser');
//   deleteForm.setAttribute('action','/admin-dashboard/users/' + id);
// }

// document.addEventListener('DOMContentLoaded', function() {
//   // Get the hidden button
//   const realButton = document.getElementById('updateProductButton');

//   // Get all the visible buttons
//   const visibleButtons = document.querySelectorAll('[id^="triggerUpdateBtn-"]');

//   // Add a click event listener to each visible button
//   visibleButtons.forEach(function(button) {
//     button.addEventListener('click', function() {
//       // Extract x from the button's ID
//       const x = button.id.split('-')[1];
//       console.log('Button with x =', x, 'clicked');

//       // Trigger a click event on the hidden button
//       realButton.click();

//       fillUpdateModal(x);
//     });
//   });
// });