const toggle = document.querySelector('.toggle span')
const lateral = document.querySelector('.izq')
const catalogo = document.querySelectorAll('.iconos a')

if (localStorage.getItem('clave') == 1) {
    lateral.style = 'flex: 0 0 5%;'
    toggle.classList.toggle('activo')
    catalogo.forEach(item => {
        item.classList.toggle('activo')
        item.querySelector('i').classList.toggle('activo')
        item.querySelector('span').classList.toggle('activo')
    })
}

toggle.onclick = () => {
    if (localStorage.getItem('clave') == 1) {
        localStorage.setItem('clave', 0);
    }else{
        localStorage.setItem('clave', 1);
    }

    lateral.style = 'flex: 0 0 5%;'
    toggle.classList.toggle('activo')
    catalogo.forEach(item => {
        item.classList.toggle('activo')
        item.querySelector('i').classList.toggle('activo')
        item.querySelector('span').classList.toggle('activo')
    })
}

// Comparar titulo de la página actual con el catálogo
const encabezadoForm = document.querySelector('.encabezado-form .titulo-page span').textContent

catalogo.forEach(item => {
    const icon = item.querySelector('i')
    const texto = item.querySelector('span').textContent
    
    if (texto == encabezadoForm.trim()) {
        item.style = 'opacity: 1;'
        console.log(icon);
    }
})
