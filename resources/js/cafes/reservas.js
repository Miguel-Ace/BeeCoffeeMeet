const xReservar = document.querySelector('.xReservar')
const mrc = document.querySelector('#mrc')
const btnReservacion = document.querySelectorAll('.btn-reservacion')

btnReservacion.forEach(item => {
    // console.log(item);
    item.onclick = () => {
        mrc.classList.remove('oculto')
    }
});

xReservar.addEventListener('click', () => {
    mrc.classList.add('oculto')
})