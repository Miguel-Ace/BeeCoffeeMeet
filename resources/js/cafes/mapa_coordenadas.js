// var mymap = L.map('map').setView([9.748917, -83.753428], 8);

// L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     maxZoom: 19
// }).addTo(mymap);

// mymap.on('click', function (e) {
//   var latitud = e.latlng.lat;
//   var longitud = e.latlng.lng;

//   console.log("Latitud: " + latitud);
//   console.log("Longitud: " + longitud);
//   // alert("Coordenadas: " + e.latlng);
// });

// Obtener Coordenadas
window.onload = obtenerCoordenadas;

const icoMapa = document.querySelectorAll('.ico-mapa')
const divMapa = document.querySelector('.mapa')
const salirMapa = document.querySelector('.salir')
let latInput
let lonInput

icoMapa.forEach(item => {
  item.onclick = () => {
    latInput = item.parentElement.querySelector('.contenedor-input-modal #latitud')
    lonInput = item.parentElement.querySelector('.contenedor-input-modal #longitud')
      divMapa.classList.add('activo')
  }
})

salirMapa.onclick = () => {
    divMapa.classList.remove('activo')
}

function obtenerCoordenadas() {
  // if (navigator.geolocation) {
  //   navigator.geolocation.getCurrentPosition(function(position) {
  //     const latitud = position.coords.latitude;
  //     const longitud = position.coords.longitude;
  //     const map = L.map('map').setView([latitud, longitud], 17);
  //     agregarMapa(map)
  //   })
  // } else {
  //   const map = L.map('map').setView([9.748917, -83.753428], 8);
  //   agregarMapa(map)
  // }
  const map = L.map('map').setView([9.748917, -83.753428], 8);
  agregarMapa(map)
}

function agregarMapa(map) {
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  // Agregar un marcador en el mapa
  let marker;

  // Manejar el evento click en el mapa
  map.on('click', function (e) {
    const latitud = e.latlng.lat.toString();
    const longitud = e.latlng.lng.toString();

    latInput.value =  latitud.substring(0, 9)
    lonInput.value = longitud.substring(0, 10)
    
    console.log("Latitud: " + latitud.substring(0, 9));
    console.log("Longitud: " + longitud.substring(0, 10));

    // Obtener las coordenadas de la ubicación seleccionada
    var latlng = e.latlng;

    // Si ya hay un marcador, quitarlo del mapa
    if (marker) {
      map.removeLayer(marker);
    }

    // Crear un nuevo marcador en la ubicación seleccionada
    marker = L.marker(latlng).addTo(map);

    // Puedes agregar una ventana emergente al marcador si lo deseas
    marker.bindPopup('Ubicación seleccionada: ' + latlng.toString()).openPopup();
  });

  // Mostrar ubicación según el select
  document.querySelector('#location').addEventListener('change', (e) => {
    let coords = e.target.value.split(",")
    map.flyTo(coords,10)
  })
}