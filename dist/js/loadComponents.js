function loadElements(location, element, callback) {
  let xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    if (this.status == 200) {
      document.querySelector(element).innerHTML = this.responseText;
      if (callback) {
        callback();
      }
    }
  };
  xhttp.open('GET', location, true);
  xhttp.send();
}

// Highlight Current Page in the navbar
function highlightCurrentPage() {
  // Get the current page URL or any identifier you are using to determine the current page
  let currentPage = window.location.pathname;
  let links = document.querySelectorAll('nav ul a');

  links.forEach((link) => {
    // Remove "current" class from all links
    link.classList.remove('current');

    // Add "current" class to the link corresponding to the current page
    if (currentPage.charAt(currentPage.length - 1) == link.getAttribute('href') || '/' + link.getAttribute('href') === currentPage || '/dist/' + link.getAttribute('href') === currentPage) {
      link.classList.add('current');
    }
  });
}

// Update year in the footer
function getYear() {
  let year = new Date().getFullYear();
  console.log(year);
  document.querySelector('#copyright').innerHTML = `Copyright &copy; ${year} Dmitrii Malyshkin`;
}

loadElements('navbar.html', 'nav', highlightCurrentPage);
loadElements('footer.html', 'footer', getYear);
