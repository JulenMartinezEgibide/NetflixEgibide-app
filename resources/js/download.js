// si el enlace con la clase button-link y tiene por texto Descargar al ses clickeado, se muestra un mensaje Gracias por descargar

document.addEventListener('click', function (e) {
    if (e.target.matches('.button-link') && e.target.textContent === 'Descargar') {
        alert('Gracias por descargar con nosotros!');
    }
});
