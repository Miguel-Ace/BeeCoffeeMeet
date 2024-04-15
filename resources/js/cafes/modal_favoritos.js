import { api } from "../apis"
const contenedor_favoritos = document.querySelector('.contenedor-favoritos')
const btn_favoritos = document.querySelectorAll('.btn-favoritos')
const cerrar = document.querySelector('.contenedor-favoritos .favoritos .cerrar span')
const meter_datos = document.querySelector('.favoritos .todos-datos')
// const titulo_favoritos = document.querySelector('.favoritos .contenedor-input titulo-favoritos')


const comprobar = () => {
    const existe = document.querySelector('.datos')

    if (!existe) {
        meter_datos.innerHTML = `<span>No se econtraron usuarios</span>`
    }
}

const iterar = async (id_cafe) => {
    meter_datos.textContent = ''
    for (const item of await api('get','favoritos')) {
        if (item.id_local === id_cafe) {
            const p = document.createElement('p')
            p.classList.add('datos')
            p.innerHTML = `
                <span><span class="atributo">Nombre:</span> ${item.usuarios.name}</span>
                <span><span class="atributo">Correo:</span> ${item.usuarios.email}</span>
                <span><span class="atributo">Teléfono:</span> ${item.usuarios.telefono ? item.usuarios.telefono : 'Sin especificar'}</span>
            `
            meter_datos.appendChild(p)
        }
    }
    comprobar()
}

for (const item of btn_favoritos) {
    item.onclick = () => {
        contenedor_favoritos.classList.toggle('activo')
        iterar(parseInt(item.getAttribute('data-cafeId')))
    }
}

cerrar.onclick = () => {
    contenedor_favoritos.classList.toggle('activo')
}