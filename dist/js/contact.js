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
  let params = `name=${name.value}&subject=${subject.value}&email=${email.value}&phone=${phone.value}&msg=${msg.value}`; //creating the parameters for the POST method
  console.log(params);

  let request = new XMLHttpRequest(); //creating new request

  request.open('POST', 'process.php', true); //connecting to the process.php file
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //setting header for POST method
  request.onload = function () {
    if (this.status == 200) {
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      console.table(response);
      // document.getElementById('submit-message').innerHTML = `<h5 id="submit-message" class="my-1 lead">${response[0]}</h5>`;
      submitMessage.innerHTML = `<h5 class="my-1 lead">${response.outputMessage}</h5>`;

      submitMessage.innerHTML += `<p class="">${response.nameError}</p>`;
      submitMessage.innerHTML += `<p class="">${response.emailError}</p>`;
      submitMessage.innerHTML += `<p class="">${response.msgError}</p>`;

      name.placeholder = response.nameError;
      email.placeholder = response.emailError;
      msg.placeholder = response.msgError;
    } else {
      console.log(this.responseText);
      document.getElementById('submit-message').innerText = `<h5 id="submit-message" class="my-1 lead">Something went very wrong :(</h5>`;
    }
  };
  request.send(params); //send parameters to be further processed by php
}

// <i class="fa-solid fa-wind"></i>
// <i class="fa-solid fa-envelope"></i>
// <i class="fa-regular fa-envelope"></i>
// <i class="fa-solid fa-envelope-circle-check"></i>
// <i class="fa-solid fa-shield"></i>
