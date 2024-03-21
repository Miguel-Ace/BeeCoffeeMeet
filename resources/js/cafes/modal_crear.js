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
   sessionStorage.setItem('stateCreate',1)
  }
  
  btnSalirModa.onclick = () => {
    modal.classList.add('oculto')
    sessionStorage.setItem('stateCreate',0)
  }
  
  cerrar.onclick = () => {
    modal.classList.add('oculto')
    sessionStorage.setItem('stateCreate',0)
 }

 if (JSON.parse(sessionStorage.getItem('stateCreate')) === 1) {
    mcc.classList.remove('oculto')
 }