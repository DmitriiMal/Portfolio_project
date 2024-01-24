// Check position of element
function isInViewport(element) {
  const rect = element.getBoundingClientRect();
  return rect.top >= 0 && rect.left >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && rect.right <= (window.innerWidth || document.documentElement.clientWidth);
}

// Attech elements
const heading = document.querySelector('.pecialize');

// Add class
function addClass(callback) {
  if (callback) {
    console.log(callback);
    setTimeout(() => {
      heading.classList.add('animate__fadeInUp', 'red');
    }, 1000);
  } else {
    console.log(callback);
  }
}

isInViewport(heading);

window.addEventListener('scroll', () => {
  addClass(isInViewport(heading));
});
// addClass(isInViewport(heading));
