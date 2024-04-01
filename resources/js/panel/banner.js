const btnEditar = document.querySelectorAll('.btn-editar')
const modal = document.querySelector('#mec')
const cEditar = document.querySelector('.cEditar')
const xEditar = document.querySelector('.xEditar')
const form = document.querySelector('#form')
// Los inputs o textareas
// const url_imagen = document.querySelector('#url_imagen')
const fechaHora = document.querySelector('#fecha_hora')
const fechaHoraInicio = document.querySelector('#fecha_hora_inicio')
const fechaHoraFin = document.querySelector('#fecha_hora_fin')

btnEditar.forEach(item => {
    item.onclick = () => {
        modal.classList.toggle('oculto')
        form.setAttribute('action', `/panel/banner/${item.getAttribute('data-id')}`)
        // url_imagen.value = item.getAttribute('data-urlimagen')
        fechaHora.value = item.getAttribute('data-fh')
        fechaHoraInicio.value = item.getAttribute('data-fhi')
        fechaHoraFin.value = item.getAttribute('data-fhf')
    }
})

cEditar.onclick = () => {
    modal.classList.toggle('oculto')
}
xEditar.onclick = () => {
    modal.classList.toggle('oculto')
}