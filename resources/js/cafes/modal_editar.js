 // Modal mostrar/ocultar
 const btnEditar = document.querySelectorAll('.btn-editar')
 const btnSalirModa = document.querySelector('.xEditar')
 const cerrar = document.querySelector('.cEditar')
 const mec = document.querySelector('#mec')

 const nombre = mec.querySelector('.container-modal .contenido-modal form .input #nombre')
 const descripcionCorta = mec.querySelector('.container-modal .contenido-modal form .input #descripcion_corta')
 const descripcionLarga = mec.querySelector('.container-modal .contenido-modal form .input #descripcion_larga')
 const urlLogo = mec.querySelector('.container-modal .contenido-modal form .input #url_logo')
 const eslogan = mec.querySelector('.container-modal .contenido-modal form .input #eslogan')
 const cantidadMesas = mec.querySelector('.container-modal .contenido-modal form .input #cantidad_mesas')
 const capacidad = mec.querySelector('.container-modal .contenido-modal form .input #capacidad')
 const provincia = mec.querySelector('.container-modal .contenido-modal form .input #provincia')
 const canton = mec.querySelector('.container-modal .contenido-modal form .input #canton')
 const distrito = mec.querySelector('.container-modal .contenido-modal form .input #distrito')
 const barrio = mec.querySelector('.container-modal .contenido-modal form .input #barrio')
 const direccion = mec.querySelector('.container-modal .contenido-modal form .input #direccion')
 const max_time_reser = mec.querySelector('.container-modal .contenido-modal form .input #max_time_reser')
 const longitud = mec.querySelector('.container-modal .contenido-modal form .input #longitud')
 const latitud = mec.querySelector('.container-modal .contenido-modal form .input #latitud')
//  const valoracion = mec.querySelector('.container-modal .contenido-modal form .input #promedio_valoracion')
const api = 'https://gist.githubusercontent.com/josuenoel/80daca657b71bc1cfd95a4e27d547abe/raw/5c615419196ed40a3dbdff69cb3d9719b1d6bb1e/provincias_cantones_distritos_costa_rica.json'
const select_provincia = document.querySelector('#edit-provincia')
const select_canton = document.querySelector('#edit-canton')
const select_distrito = document.querySelector('#edit-distrito')

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

 btnEditar.forEach(item => {
  
     item.onclick = () => {
        const formularioEditar = mec.querySelector('.container-modal .contenido-modal form')
        mec.classList.remove('oculto')
        formularioEditar.setAttribute('action', `cafe/${item.getAttribute('data-cafeId')}`)

        nombre.value = item.getAttribute('data-nombre')
        descripcionCorta.value = item.getAttribute('data-dc')
        descripcionLarga.value = item.getAttribute('data-dg')
        urlLogo.value = item.getAttribute('data-urlogo')
        eslogan.value = item.getAttribute('data-eslogan')
        cantidadMesas.value = item.getAttribute('data-cantidadmesas')
        capacidad.value = item.getAttribute('data-capacidad')
        provincia.value = item.getAttribute('data-provincia')
        canton.value = item.getAttribute('data-canton')
        distrito.value = item.getAttribute('data-distrito')
        barrio.value = item.getAttribute('data-barrio')
        direccion.value = item.getAttribute('data-direccion')
        max_time_reser.value = item.getAttribute('data-max_time_reser')
        longitud.value = item.getAttribute('data-longitud')
        latitud.value = item.getAttribute('data-latitud')
        // valoracion.value = item.getAttribute('data-promediovaloracion')
    }
 })

 
  btnSalirModa.onclick = () => {
    mec.classList.add('oculto')
  }
  
  cerrar.onclick = () => {
    mec.classList.add('oculto')
  }

  // 
  const inputsEditar = mec.querySelectorAll('.container-modal .contenido-modal form .contenedor-input-modal .input input')
  const textareaEditar = mec.querySelectorAll('.container-modal .contenido-modal form .contenedor-input-modal .input textarea')
  const guardadmec = document.querySelector('#guardad_mec')

  inputsEditar.forEach(input => {
    input.addEventListener('change', () => {
      if (input.value == '') {
        guardadmec.disabled = true
        guardadmec.style = 'opacity:.5; cursor: no-drop;'
      }else{
        guardadmec.disabled = false
        guardadmec.style = ''
      }
    })
  });

  textareaEditar.forEach(input => {
    input.addEventListener('change', () => {
      if (input.value == '') {
        guardadmec.disabled = true
        guardadmec.style = 'opacity:.5; cursor: no-drop;'
      }else{
        guardadmec.disabled = false
        guardadmec.style = ''
      }
    })
  });