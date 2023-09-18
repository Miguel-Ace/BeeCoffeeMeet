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
 const longitud = mec.querySelector('.container-modal .contenido-modal form .input #longitud')
 const latitud = mec.querySelector('.container-modal .contenido-modal form .input #latitud')
 const valoracion = mec.querySelector('.container-modal .contenido-modal form .input #promedio_valoracion')

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
        longitud.value = item.getAttribute('data-longitud')
        latitud.value = item.getAttribute('data-latitud')
        valoracion.value = item.getAttribute('data-promediovaloracion')
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