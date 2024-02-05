const nav = document.querySelector('.navbar');
const grid = document.querySelector('.grid-container');

window.addEventListener('scroll', function () {
    nav.classList.toggle('active', window.scrollY > 0);
    grid.classList.toggle('active', window.scrollY > 0);
});

