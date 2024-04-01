// Modal de imagen
const imagenes = document.querySelectorAll('tbody tr .img img')
const modal_img = document.querySelector('.img-mostrar')

imagenes.forEach(item => {
    item.addEventListener('click', () => {
        modal_img.querySelector('img').src = item.src
        modal_img.classList.add('activo')
    })
});

modal_img.onclick = () => {
    modal_img.classList.remove('activo')
}