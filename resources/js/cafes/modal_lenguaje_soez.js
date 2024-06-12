import { api } from "../apis"

async function lenguaje() {
    const cerrar = document.querySelector('.contenedor-lenguaje-soez .lenguaje-soez .cerrar span')
    const btn_modal = document.querySelector('.crear-lenguaje-soez')
    const contenedor = document.querySelector('.contenedor-lenguaje-soez')
    const btn_add_palabra = document.querySelector('.add-palabra')
    const input_palabras = document.querySelector('.input-palabras')
    const mostrar_palabras = document.querySelector('.palabras')
    const guardar_todas_palabras = document.querySelector('.add-todas-palabras')
    const id = document.querySelector('#id').textContent

    let palabras = []

    const obtener_palabras_api = await api('get',`palabras_separadas`)

    if (obtener_palabras_api.length != 0) {
        const palabras_a_pasar = obtener_palabras_api.map(x => ({
            palabra: x.palabras
        }))
        sessionStorage.setItem('palabras', JSON.stringify(palabras_a_pasar))
    }

    // 
    if (sessionStorage.getItem('palabras') && sessionStorage.getItem('palabras').length != 0) {
        palabras = JSON.parse(sessionStorage.getItem('palabras'))
        iterar_palabras()
    }

    btn_modal ?
    btn_modal.onclick = () => {
        contenedor.classList.toggle('activo')
    } : ''

    cerrar ?
    cerrar.onclick = () => {
        contenedor.classList.toggle('activo')
    }
    : ''

    btn_add_palabra.onclick = () => {
        if (input_palabras.value != '') {
            palabras = [...palabras, {id: parseInt(id),palabra:input_palabras.value}]
            sessionStorage.setItem('palabras', JSON.stringify(palabras))
            input_palabras.value = ''
            iterar_palabras()
        }
    }

    guardar_todas_palabras.onclick = () => {
        if (palabras.length != 0){
            api('post','palabras_soeces/insert',palabras)
        
            contenedor.classList.toggle('activo')
        
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Guardado correctamente",
                showConfirmButton: false,
                timer: 1500
            });
        }else{
            Swal.fire({
                position: "center",
                icon: "error",
                title: "No hay datos que guardar",
                showConfirmButton: false,
                timer: 1500
            });
        }
    }

    function iterar_palabras() {
        const palabras = sessionStorage.getItem('palabras')
        mostrar_palabras.innerHTML = ''
        for (const item of JSON.parse(palabras)) {
            const span = document.createElement('span')
            span.textContent = item.palabra
            mostrar_palabras.appendChild(span)
        } 
    }
}

lenguaje()