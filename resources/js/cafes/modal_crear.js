 // Modal mostrar/ocultar
 const crearCafe = document.querySelector('.crear-cafe')
 const btnSalirModa = document.querySelector('.x')
 const cerrar = document.querySelector('.cerrar')
 const modal = document.querySelector('.modal')
 const mcc = document.querySelector('#mcc')
 
 
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
   condiDireccion
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

// evitar que presionen dos veces el botón crear
// Agrega un controlador de eventos al botón
guardadMcc.addEventListener('click', () => {
  if (guardadMcc.disabled == false) {
    setTimeout(function () {
      guardadMcc.disabled = true;
    }, 10); // Cambia 10 a la cantidad de milisegundos que desees
  }
});