const elements = document.querySelectorAll('[demo-set-page-loaded-class-for-demo]');
window.addEventListener('load', function() {
  for (let i = 0; i < elements.length; i++) {
    const element = elements[i];
    element.classList.add('page-loaded');
  }
});