// Footer

function loadElements(location, element) {
  let xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    if (this.status == 200) {
      document.querySelector(element).innerHTML = this.responseText;
    }
  };
  xhttp.open('GET', location, true);
  xhttp.send();
}

loadElements('footer.html', 'footer');
