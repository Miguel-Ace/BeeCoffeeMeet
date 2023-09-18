const btnEditar = document.querySelectorAll('.btn-editar')
const modal = document.querySelector('#mec')
const cEditar = document.querySelector('.cEditar')
const xEditar = document.querySelector('.xEditar')
const form = document.querySelector('#form')
// Los inputs o textareas
const otrosCafe = document.querySelector('#otros_cafe')

btnEditar.forEach(item => {
    item.onclick = () => {
        modal.classList.remove('oculto')
        otrosCafe.value = item.getAttribute('data-otroCafe')
        form.setAttribute('action', `/panel/otros_cafes/${item.getAttribute('data-id')}`)
    }
})

cEditar.onclick = () => {
    modal.classList.add('oculto')
}
xEditar.onclick = () => {
    modal.classList.add('oculto')
}
