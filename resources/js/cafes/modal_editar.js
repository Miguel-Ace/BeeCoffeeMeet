 // Modal mostrar/ocultar
 const btnEditar = document.querySelectorAll('.btn-editar')
 const btnSalirModa = document.querySelector('.xEditar')
 const cerrar = document.querySelector('.cEditar')
 const mec = document.querySelector('#mec')

 const nombre = mec.querySelector('.container-modal .contenido-modal form .input #nombre')
 const descripcionCorta = mec.querySelector('.container-modal .contenido-modal form .input #descripcion_corta')
 const descripcionLarga = mec.querySelector('.container-modal .contenido-modal form .input #descripcion_larga')
//  const urlLogo = mec.querySelector('.container-modal .contenido-modal form .input #url_logo')
 const eslogan = mec.querySelector('.container-modal .contenido-modal form .input #eslogan')
 const cantidadMesas = mec.querySelector('.container-modal .contenido-modal form .input #cantidad_mesas')
 const capacidad = mec.querySelector('.container-modal .contenido-modal form .input #capacidad')
//  const provincia = mec.querySelector('.container-modal .contenido-modal form .input #provincia')
//  const canton = mec.querySelector('.container-modal .contenido-modal form .input #canton')
//  const distrito = mec.querySelector('.container-modal .contenido-modal form .input #distrito')
 const barrio = mec.querySelector('.container-modal .contenido-modal form .input #barrio')
 const direccion = mec.querySelector('.container-modal .contenido-modal form .input #direccion')
 const max_time_reser = mec.querySelector('.container-modal .contenido-modal form .input #max_time_reser')
 const longitud = mec.querySelector('.container-modal .contenido-modal form .input #longitud')
 const latitud = mec.querySelector('.container-modal .contenido-modal form .input #latitud')

  // Api 
  const server = 'http://161.22.40.55/api'
  const local = 'http://127.0.0.1:8000/api'
  const url = server
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

  for (const key in result.provincias) {
    const index = key
    for (const key2 in result.provincias[key].cantones) {
      const option = document.createElement('option')
      option.setAttribute('value', result.provincias[index].cantones[key2].nombre)
      option.textContent = result.provincias[index].cantones[key2].nombre
      select_canton.appendChild(option)
      // console.log(result.provincias[index].cantones[key2])
    }
  }
  
  for (const key in result.provincias) {
    const index = key
    for (const key2 in result.provincias[key].cantones) {
      for (const key3 in result.provincias[index].cantones[key2].distritos) {
        const option = document.createElement('option')
        option.setAttribute('value', result.provincias[index].cantones[key2].distritos[key3])
        option.textContent = result.provincias[index].cantones[key2].distritos[key3]
        select_distrito.appendChild(option)
        // console.log(result.provincias[index].cantones[key2].distritos[key3])
      }
    }
  }
  // select_provincia.addEventListener('input', () => {
  //   select_canton.textContent = ''
  //   select_distrito.textContent = ''
  //   for (const key in result.provincias) {
  //     if (select_provincia.value == result.provincias[key].nombre) {
  //       const index = key
  //       for (const key2 in result.provincias[key].cantones) {
  //         const option = document.createElement('option')
  //         option.setAttribute('value', result.provincias[index].cantones[key2].nombre)
  //         option.textContent = result.provincias[index].cantones[key2].nombre
  //         select_canton.appendChild(option)
  //         // console.log(result.provincias[index].cantones[key2])
  //       }
  //     }
  //   }
  // })

  // select_canton.addEventListener('input', () => {
  //   select_distrito.textContent = ''
  //   for (const key in result.provincias) {
  //     if (select_provincia.value == result.provincias[key].nombre) {
  //       const index = key
  //       for (const key2 in result.provincias[key].cantones) {
  //         if (select_canton.value == result.provincias[index].cantones[key2].nombre) {
  //           for (const key3 in result.provincias[index].cantones[key2].distritos) {
  //             const option = document.createElement('option')
  //             option.setAttribute('value', result.provincias[index].cantones[key2].distritos[key3])
  //             option.textContent = result.provincias[index].cantones[key2].distritos[key3]
  //             select_distrito.appendChild(option)
  //             // console.log(result.provincias[index].cantones[key2].distritos[key3])
  //           }
  //         }
  //       }
  //     }
  //   }
  // })
})

async function getApis() {
  // Generar el token
  const tokenEndpoint = `${url}/login`;
  
  const credenciales_get_token = {
    // email: 'acevedo51198mac@gmail.com',
    // password: '12345678',
    email: 'ramses.rivas@gmail.com',
    password: 'TecladoJirafaCableFigura',
}
  
  const option_token = {
      method: 'POST',
      body: new URLSearchParams(credenciales_get_token),
  };
  
  const response_token = await fetch(tokenEndpoint, option_token)
  const result_token = await response_token.json()
  const token = result_token.access_token
  // console.log(token);
  // ===== Fin generar el token =====

  const view_editar = (idCafe) => {
    mec.classList.remove('oculto')
    const formularioEditar = mec.querySelector('.container-modal .contenido-modal form')
    formularioEditar.setAttribute('action', `cafe/${idCafe}`)
    sessionStorage.setItem('stateEdit',1)
    sessionStorage.setItem('cafe',idCafe)
  
    const opciones = {
        headers: {
            'Content-Type': 'application/json',
            authorization: `Bearer ${token}`
        }
    }
    fetch(`${url}/cafe/${idCafe}`,opciones)
    .then(res => res.json())
    .then(result => {
      // console.log(result);
      nombre.value = result.nombre
      descripcionCorta.value = result.descripcion_corta
      descripcionLarga.value = result.descripcion_larga
      // urlLogo.value = result.url_logo
      eslogan.value = result.eslogan
      cantidadMesas.value = result.cantidad_mesas
      capacidad.value = result.capacidad
      barrio.value = result.barrio
      direccion.value = result.direccion
      max_time_reser.value = result.max_time_reser
      longitud.value = result.longitud
      latitud.value = result.latitud
      select_provincia.value = result.provincia
      select_canton.value = result.canton
      select_distrito.value = result.distrito
      // valoracion.value = result.
    })
  }
  
  for (const item of btnEditar) {
    item.onclick = () => {
      const id_cafe = parseInt(item.getAttribute('data-cafeId'))
      view_editar(id_cafe)
      // console.log(id_cafe);
    }
  }
  
   
    btnSalirModa.onclick = () => {
      mec.classList.add('oculto')
      sessionStorage.setItem('stateEdit',0)
      sessionStorage.removeItem('cafe')
    }
    
    cerrar.onclick = () => {
      mec.classList.add('oculto')
      sessionStorage.setItem('stateEdit',0)
      sessionStorage.removeItem('cafe')
    }
  
    // 
    const guardadmec = document.querySelector('#guardad_mec')
  
    if (JSON.parse(sessionStorage.getItem('stateEdit')) === 1) {
      mec.classList.remove('oculto')
      view_editar(JSON.parse(sessionStorage.getItem('cafe')))
    }
}

getApis()