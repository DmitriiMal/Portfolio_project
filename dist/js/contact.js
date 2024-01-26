document.getElementById('myForm').addEventListener('submit', insertName);
//POST with Inserting user into db

function insertName(e) {
  e.preventDefault(); //this prevents the page from refreshing after submitting
  let name = document.getElementById('name');
  let subject = document.getElementById('subject');
  let email = document.getElementById('email');
  let phone = document.getElementById('phone');
  let msg = document.getElementById('msg');
  let submitMessage = document.getElementById('submit-message');
  let errorMessage = document.getElementById('error-message');
  let myButton = document.getElementById('myButton');
  let params = `name=${name.value}&subject=${subject.value}&email=${email.value}&phone=${phone.value}&msg=${msg.value}`; //creating the parameters for the POST method
  console.log(params);

  let request = new XMLHttpRequest(); //creating new request

  request.open('POST', 'process.php', true); //connecting to the process.php file
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //setting header for POST method
  request.onload = function () {
    if (this.status == 200) {
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      // console.table(response);

      if (response.outputMessage == 'success') {
        // Replace button with icons
        myButton.innerHTML = `<i class="fa-solid fa-wind fa-flip-horizontal fa-2xl" style="color: #333333;"></i> <i class="fa-solid fa-envelope-circle-check fa-2xl" style="color: #333333;"></i>`;
        submitMessage.innerHTML = `Thank you for your message! ;)`;
        // Reset errorMessage
        errorMessage.innerHTML = '';
        // Delete input values
        let textInput = document.querySelectorAll('.text-input');
        textInput.forEach((input) => {
          input.value = '';
        });

        // Reset placeholders
        name.placeholder = 'Name';
        email.placeholder = 'Email Address';
        msg.placeholder = 'Enter Message';
      } else {
        // Display validation messages
        submitMessage.innerHTML = `${response.outputMessage}`;
        errorMessage.innerHTML = `<p>${response.nameError}</p>`;
        errorMessage.innerHTML += `<p>${response.emailError}</p>`;
        errorMessage.innerHTML += `<p>${response.msgError}</p>`;

        name.placeholder = response.nameError;
        email.placeholder = response.emailError;
        msg.placeholder = response.msgError;
      }
    } else {
      console.log(this.responseText);
      submitMessage.innerHTML = `Something went wrong :( Please try later`;
      errorMessage.innerHTML = `<p class="">Whoopsie! My contact form is on a coffee break ☕. No worries, just try again later. Feel free to drop me an email or ring me up in the meantime! 📧📞 </p>`;
      myButton.innerHTML = `<i class="fa-solid fa-triangle-exclamation fa-2xl" style="color: #333333;"></i>`;
    }
  };
  request.send(params); //send parameters to be further processed by php
}

// <i class="fa-solid fa-shield"></i>
