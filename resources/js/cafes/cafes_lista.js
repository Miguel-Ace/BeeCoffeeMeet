import { api } from "../apis"

const tbody = document.querySelector('.tbody-lista-cafes')
const buscador_usuario = document.querySelector('.buscador-usuario-cafe')
const buscador_nombre_cafe = document.querySelector('.buscador-nombre-cafe')

const iterar_cafes = async (usuario = '', nombre_cafe = '') => {
    const cafes = await api('get','cafe')
    const fragment = document.createDocumentFragment();

    tbody ?
    tbody.textContent = ''
    : ''

    for (const item of cafes) {
        if (item.usuarios.name.toLowerCase().includes(usuario) && item.nombre.toLowerCase().includes(nombre_cafe)) {
            const tr = document.createElement('tr')
            const td_usuario = document.createElement('td')
            td_usuario.textContent = item.usuarios.name
            const td_nombre = document.createElement('td')
            td_nombre.textContent = item.nombre
            const td_descripcion_corta = document.createElement('td')
            td_descripcion_corta.textContent = item.descripcion_corta
            const td_descripcion_larga = document.createElement('td')
            td_descripcion_larga.textContent = item.descripcion_larga
            const td_url_logo = document.createElement('td')
            td_url_logo.textContent = item.url_logo
            const td_eslogan = document.createElement('td')
            td_eslogan.textContent = item.eslogan
            const td_cantidad_mesas = document.createElement('td')
            td_cantidad_mesas.textContent = item.cantidad_mesas
            const td_capacidad = document.createElement('td')
            td_capacidad.textContent = item.capacidad
            const td_provincia = document.createElement('td')
            td_provincia.textContent = item.provincia
            const td_canton = document.createElement('td')
            td_canton.textContent = item.canton
            const td_distrito = document.createElement('td')
            td_distrito.textContent = item.distrito
            const td_barrio = document.createElement('td')
            td_barrio.textContent = item.barrio
            const td_direccion = document.createElement('td')
            td_direccion.textContent = item.direccion
            const td_promedio_valoracion = document.createElement('td')
            td_promedio_valoracion.textContent = item.promedio_valoracion
            const td_max_time_reser = document.createElement('td')
            td_max_time_reser.textContent = item.max_time_reser
    
            tr.appendChild(td_usuario)
            tr.appendChild(td_nombre)
            tr.appendChild(td_descripcion_corta)
            tr.appendChild(td_descripcion_larga)
            tr.appendChild(td_url_logo)
            tr.appendChild(td_eslogan)
            tr.appendChild(td_cantidad_mesas)
            tr.appendChild(td_capacidad)
            tr.appendChild(td_provincia)
            tr.appendChild(td_canton)
            tr.appendChild(td_distrito)
            tr.appendChild(td_barrio)
            tr.appendChild(td_direccion)
            tr.appendChild(td_promedio_valoracion)
            tr.appendChild(td_max_time_reser)
    
            fragment.appendChild(tr)
        }
    }

    tbody ?
    tbody.appendChild(fragment)
    : ''
}

iterar_cafes()

buscador_usuario ?
buscador_usuario.addEventListener('input', (e) => {
    iterar_cafes(e.target.value.toLowerCase(), buscador_nombre_cafe.value)
    // console.log(e.target.value.toLowerCase());
}) : ''

buscador_nombre_cafe ?
buscador_nombre_cafe.addEventListener('input', (e) => {
    iterar_cafes(buscador_usuario.value, e.target.value.toLowerCase())
    // console.log(e.target.value.toLowerCase())
}) : ''