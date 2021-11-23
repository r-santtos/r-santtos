// your function
const preventForm = function(event) {
  event.preventDefault();
  document.getElementById('form').reset();
};

// your form
const form = document.getElementById("form");

// attach event listener
form.addEventListener("submit", preventForm, true);