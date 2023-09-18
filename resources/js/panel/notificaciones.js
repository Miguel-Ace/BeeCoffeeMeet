const btnEditar = document.querySelectorAll('.btn-editar')
const modal = document.querySelector('#mec')
const cEditar = document.querySelector('.cEditar')
const xEditar = document.querySelector('.xEditar')
const form = document.querySelector('#form')
// Los inputs o textareas
const notificacion = document.querySelector('#notificacion')
const fechaHora = document.querySelector('#fecha_hora')
const fechaHoraInicio = document.querySelector('#fecha_hora_inicio')
const fechaHoraFin = document.querySelector('#fecha_hora_fin')

btnEditar.forEach(item => {
    item.onclick = () => {
        modal.classList.remove('oculto')
        form.setAttribute('action', `/panel/notificaciones/${item.getAttribute('data-id')}`)
        notificacion.value = item.getAttribute('data-notificacion')
        fechaHora.value = item.getAttribute('data-fh')
        fechaHoraInicio.value = item.getAttribute('data-fhi')
        fechaHoraFin.value = item.getAttribute('data-fhf')
    }
})

cEditar.onclick = () => {
    modal.classList.add('oculto')
}
xEditar.onclick = () => {
    modal.classList.add('oculto')
}
