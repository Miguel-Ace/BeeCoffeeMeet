const cards = document.querySelectorAll('.card')
const contenedorCards = document.querySelector('.contenedor-cards')

let cantidad_de_cards = 0
cards.forEach(item => {
    cantidad_de_cards++
});

// console.log(cantidad_de_cards);
if (cantidad_de_cards > 4) {
    contenedorCards.style = 'overflow-x: scroll'
}

new gridjs.Grid({
    search: true,
    sort: true,
    // resizable: true,
    pagination: {
        limit:8
    },
    style: {
        th:{
            'background-color': '#aa644e',
            'color': 'white'
        }
    },
    language: {
        search: {
            placeholder: 'Buscar...'
        },
        pagination: {
            previous: 'Anterior',
            next: 'Siguiente',
            showing: 'Mostrando',
            results: () => 'Resultados'
        },
        sort: {
            sortAsc: 'Ordenar ascendente',
            sortDesc: 'Ordenar descendente'
        },
        loading: 'Cargando...',
        noRecordsFound: 'No se encontraron registros',
        error: 'Ocurrió un error al cargar los datos'
    },
    columns: ["Usuario", "Fecha y hora", "Fecha y hora inicio", "Fecha y hora fin", "Cantidad de persona", "Petición", "Comentarios"],
    server: {
        url: 'https://cupspot.io/api/reservaciones',
        then: data => data.map(el => 
            [el.usuarios.name, el.fecha_hora, el.fecha_hora_inicio, el.fecha_hora_fin, el.cantidad_personas, el.peticion, el.comentarios]
        )
    }
  }).render(document.getElementById("wrapper"));