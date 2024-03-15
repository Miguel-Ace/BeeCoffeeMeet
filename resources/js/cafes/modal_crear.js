 // Modal mostrar/ocultar
 const crearCafe = document.querySelector('.crear-cafe')
 const btnSalirModa = document.querySelector('.x')
 const cerrar = document.querySelector('.cerrar')
 const modal = document.querySelector('.modal')
 const mcc = document.querySelector('#mcc')
 const api = 'https://gist.githubusercontent.com/josuenoel/80daca657b71bc1cfd95a4e27d547abe/raw/5c615419196ed40a3dbdff69cb3d9719b1d6bb1e/provincias_cantones_distritos_costa_rica.json'
 const select_provincia = document.querySelector('#provincia')
 const select_canton = document.querySelector('#canton')
 const select_distrito = document.querySelector('#distrito')
 
 fetch(api)
 .then(response => response.json())
 .then(result => {
   for (const key in result.provincias) {
     const option = document.createElement('option')
     option.setAttribute('value', result.provincias[key].nombre)
     option.textContent = result.provincias[key].nombre
     select_provincia.appendChild(option)
    //  console.log(result.provincias[key].nombre)
  }

  select_provincia.addEventListener('input', () => {
    select_canton.textContent = ''
    select_distrito.textContent = ''
    for (const key in result.provincias) {
      if (select_provincia.value == result.provincias[key].nombre) {
        const index = key
        for (const key2 in result.provincias[key].cantones) {
          const option = document.createElement('option')
          option.setAttribute('value', result.provincias[index].cantones[key2].nombre)
          option.textContent = result.provincias[index].cantones[key2].nombre
          select_canton.appendChild(option)
          // console.log(result.provincias[index].cantones[key2])
        }
      }
    }
  })

  select_canton.addEventListener('input', () => {
    select_distrito.textContent = ''
    for (const key in result.provincias) {
      if (select_provincia.value == result.provincias[key].nombre) {
        const index = key
        for (const key2 in result.provincias[key].cantones) {
          if (select_canton.value == result.provincias[index].cantones[key2].nombre) {
            for (const key3 in result.provincias[index].cantones[key2].distritos) {
              const option = document.createElement('option')
              option.setAttribute('value', result.provincias[index].cantones[key2].distritos[key3])
              option.textContent = result.provincias[index].cantones[key2].distritos[key3]
              select_distrito.appendChild(option)
              // console.log(result.provincias[index].cantones[key2].distritos[key3])
            }
          }
        }
      }
    }
  })
 })
 
 
 crearCafe.onclick = () => {
   mcc.classList.remove('oculto')
 }

 btnSalirModa.onclick = () => {
   modal.classList.add('oculto')
 }
 
 cerrar.onclick = () => {
   modal.classList.add('oculto')
 }

 // Validar formualario modal
 const nombre = document.querySelector('#nombre')
 const descripcionCorta = document.querySelector('#descripcion_corta')
 const descripcionLarga = document.querySelector('#descripcion_larga')
 const urlLogo = document.querySelector('#url_logo')
 const eslogan = document.querySelector('#eslogan')
 const cantidadMesas = document.querySelector('#cantidad_mesas')
 const capacidad = document.querySelector('#capacidad')
 const provincia = document.querySelector('#provincia')
 const canton = document.querySelector('#canton')
 const distrito = document.querySelector('#distrito')
 const barrio = document.querySelector('#barrio')
 const direccion = document.querySelector('#direccion')
 const longitud = document.querySelector('#longitud')
 const latitud = document.querySelector('#latitud')
 const maxTimeReser = document.querySelector('#max_time_reser')
 // const promedioValoracion = document.querySelector('#promedio_valoracion')

 const guardadMcc = document.querySelector('#guardad_mcc')

bloquearBoton()

function bloquearBoton() {
 const condiNombre = nombre.value == ''
 const condiDescripcionCorta = descripcionCorta.value == ''
 const condiDescripcionLarga = descripcionLarga.value == ''
 const condiUrlLogo= urlLogo.value == ''
 const condiEslogan = eslogan.value == ''
 const condiCantidadMesas = cantidadMesas.value == ''
 const condiCapacidad = capacidad.value == ''
 const condiProvincia = provincia.value == ''
 const condiCanton = canton.value == ''
 const condiDistrito = distrito.value == ''
 const condiBarrio = barrio.value == ''
 const condiDireccion = direccion.value == ''
 const condiLongitud = longitud.value == ''
 const condiLatitud = latitud.value == ''
 const condiMaxTimeReser = maxTimeReser.value == ''
 // const condiPromedioValoracion = promedioValoracion.value == ''

 if (
   condiNombre ||
   condiDescripcionCorta ||
   condiDescripcionLarga ||
   condiUrlLogo ||
   condiEslogan ||
   condiCantidadMesas ||
   condiCapacidad ||
   condiProvincia ||
   condiCanton ||
   condiDistrito ||
   condiBarrio ||
   condiDireccion ||
   condiLongitud ||
   condiLatitud ||
   condiMaxTimeReser
 ) {
   guardadMcc.disabled = true
   guardadMcc.style = 'opacity:.5; cursor: no-drop;'
 }else{
   guardadMcc.disabled = false
   guardadMcc.style = ''
 }
}

nombre.addEventListener('change', () => {
 bloquearBoton()
})
descripcionCorta.addEventListener('change', () => {
 bloquearBoton()
})
descripcionLarga.addEventListener('change', () => {
 bloquearBoton()
})
urlLogo.addEventListener('change', () => {
 bloquearBoton()
})
eslogan.addEventListener('change', () => {
 bloquearBoton()
})
cantidadMesas.addEventListener('change', () => {
 bloquearBoton()
})
capacidad.addEventListener('change', () => {
 bloquearBoton()
})
provincia.addEventListener('change', () => {
 bloquearBoton()
})
canton.addEventListener('change', () => {
 bloquearBoton()
})
distrito.addEventListener('change', () => {
 bloquearBoton()
})
barrio.addEventListener('change', () => {
 bloquearBoton()
})
direccion.addEventListener('change', () => {
 bloquearBoton()
})
longitud.addEventListener('change', () => {
 bloquearBoton()
})
latitud.addEventListener('change', () => {
 bloquearBoton()
})
maxTimeReser.addEventListener('change', () => {
 bloquearBoton()
})

// evitar que presionen dos veces el botón crear
// Agrega un controlador de eventos al botón
guardadMcc.addEventListener('click', () => {
  if (guardadMcc.disabled == false) {
    setTimeout(function () {
      guardadMcc.disabled = true;
    }, 10); // Cambia 10 a la cantidad de milisegundos que desees
  }
});