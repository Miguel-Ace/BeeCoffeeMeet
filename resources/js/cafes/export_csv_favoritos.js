import { api } from "../apis"

async function exportarSoporte() {
    // Crear contenido del archivo CSV
    let csvContent = 'data:text/csv;charset=utf-8,';
    csvContent += 'Nombre;Telefono;Correo\n'; // Encabezados de las columnas

    const favoritos = await api('get','favoritos')

    for (const favorito of favoritos) {
        const nombre = favorito.usuarios.name.normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/ñ/g, 'n')
        const tel = favorito.usuarios.telefono
        const correo = favorito.usuarios.email.normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/ñ/g, 'n')

        csvContent += `${nombre};${tel};${correo}\n`
    }

    // Crear el enlace de descarga
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement('a');
    link.setAttribute('href', encodedUri);
    link.setAttribute('download', 'Favoritos.csv');
    // Simular el clic en el enlace para iniciar la descarga
    link.click();
}

// Agregar un botón para iniciar la exportación
const btn_exportar = document.querySelector('.expor-csv-favoritos')
btn_exportar.addEventListener('click', () => {
    exportarSoporte()
})