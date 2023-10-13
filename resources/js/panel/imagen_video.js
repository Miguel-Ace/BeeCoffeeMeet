const btnEditar = document.querySelectorAll('.btn-editar')
const modal = document.querySelector('#mec')
const cEditar = document.querySelector('.cEditar')
const xEditar = document.querySelector('.xEditar')
const form = document.querySelector('#form')
// Los inputs o textareas
const url_imagen_video = document.querySelector('#url_imagen_video')

btnEditar.forEach(item => {
    item.onclick = () => {
        modal.classList.toggle('oculto')
        form.setAttribute('action', `/panel/multimedias/${item.getAttribute('data-id')}`)
        url_imagen_video.value = item.getAttribute('data-iv')
    }
})

cEditar.onclick = () => {
    modal.classList.toggle('oculto')
}
xEditar.onclick = () => {
    modal.classList.toggle('oculto')
}

const url_imagen_video1 = document.querySelector('#url_imagen_video1')
// Expresiones regulares para URLs de imagen y video
const imageRegex = /\.(jpg|jpeg|png|gif|bmp)$/i; // Puedes agregar más extensiones si es necesario
const videoRegex = /\.(mp4|avi|mov|wmv)$/i; // Puedes agregar más extensiones si es necesario

url_imagen_video1.addEventListener('change', () => {
    // Verifica si la URL coincide con las expresiones regulares
    if (imageRegex.test(url_imagen_video1.value)) {
        console.log('Es una URL de imagen');
    } else if (videoRegex.test(url_imagen_video1.value)) {
        console.log('Es una URL de video');
    } else {
        const cortandoUrl = url_imagen_video1.value.substring(17)
        url_imagen_video1.value = cortandoUrl
        console.log('No es una URL de imagen ni de video')
    }
})