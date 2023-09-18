const cards = document.querySelectorAll('.card')
const contenedorCards = document.querySelector('.contenedor-cards')

let cantidad_de_cards = 0
cards.forEach(item => {
    cantidad_de_cards++
});

// console.log(cantidad_de_cards);
if (cantidad_de_cards > 4) {
    contenedorCards.style = 'overflow-x: scroll'
}