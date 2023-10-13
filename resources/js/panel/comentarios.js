const btnActiva = document.querySelectorAll('.btn-activar')
const btnDesactivar = document.querySelectorAll('.btn-desactivar')
const form = document.querySelector('#form')
// Los inputs o textareas
const activo = document.querySelector('#activo')

btnActiva.forEach(item => {
    item.onclick = () => {
        form.setAttribute('action', `/panel/comentarios/${item.getAttribute('data-id')}`)
        activo.value = item.getAttribute('activo')
        form.querySelector('#guardad_mec').click()
    }
})

btnDesactivar.forEach(item => {
    item.onclick = () => {
        form.setAttribute('action', `/panel/comentarios/${item.getAttribute('data-id')}`)
        activo.value = item.getAttribute('activo')
        form.querySelector('#guardad_mec').click()
    }
})

// Cambiar números de activo en "SI" o "NO"
const tbodyActivos = document.querySelectorAll('tbody tr')

tbodyActivos.forEach(item => {
    const camActivo = item.querySelector('td:nth-child(4)')

    if (camActivo.textContent == 1) {
        camActivo.textContent = "Si"
        camActivo.style = "background-color:#0B5345;color:white"
        item.querySelector('td:nth-child(5) .btn-activar').disabled = true
        item.querySelector('td:nth-child(5) .btn-activar').style = "opacity:.4"
    }else{
        camActivo.textContent = "No"
        camActivo.style = "background-color:#922B21;color:white"
        item.querySelector('td:nth-child(5) .btn-desactivar').disabled = true
        item.querySelector('td:nth-child(5) .btn-desactivar').style = "opacity:.4"
    }
});