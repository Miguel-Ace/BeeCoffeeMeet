const btnEditar = document.querySelectorAll('.btn-editar')
const modal = document.querySelector('#meh')
const cEditar = document.querySelector('.cEditar')
const xEditar = document.querySelector('.xEditar')
const form = document.querySelector('#form')
// Los inputs o textareas
const dia = document.querySelector('#dia')
const hi = document.querySelector('#hora_inicio')
const hf = document.querySelector('#hora_fin')

btnEditar.forEach(item => {
    item.onclick = () => {
        modal.classList.toggle('oculto')
        dia.value = item.getAttribute('data-dia')
        hi.value = item.getAttribute('data-hi')
        hf.value = item.getAttribute('data-hf')
        form.setAttribute('action', `/panel/horarios/${item.getAttribute('data-id')}`)
    }
})

cEditar.onclick = () => {
    modal.classList.toggle('oculto')
}
xEditar.onclick = () => {
    modal.classList.toggle('oculto')
}
