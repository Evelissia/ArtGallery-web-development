document.addEventListener('DOMContentLoaded', function () {
  const menuToggle = document.querySelector('.menu-toggle');
  const navMenu = document.querySelector('nav.col-8');

  menuToggle.addEventListener('click', function () {
    this.classList.toggle('active');
  });
});
