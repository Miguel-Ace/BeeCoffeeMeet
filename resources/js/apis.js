export async function api(estado,url,datos = []) {
    // Definir la URL del endpoint para obtener el token
    const URL_SERVER = 'https://cupspot.io/api';
    const URL_LOCAL = 'http://127.0.0.1:8000/api';
    const URL = URL_SERVER
    const tokenEndpoint = `${URL}/login`;

    // Definir los datos de autenticación (por ejemplo, nombre de usuario y contraseña)
    const credentials = {
        email: 'ramses.rivas@gmail.com',
        password: 'TecladoJirafaCableFigura'
    };

    // Configurar la solicitud HTTP para obtener el token
    const requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            // Otros encabezados según sea necesario
        },
        body: new URLSearchParams(credentials),
    };

    const respuesta = await fetch(tokenEndpoint, requestOptions)
    const resultado = await respuesta.json()

    const token = resultado.access_token

    if (estado === 'get') {
        const urlGet = `${URL}/${url}`
        const option = {
            method: 'GET',
            headers: {
                // 'content-type': 'application/json',
                'authorization': `Bearer ${token}`,
            },
        }

        const respuesta = await fetch(urlGet, option)
        const resultado = await respuesta.json()
        return resultado
    }

    if (estado === 'post') {
        const urlPost = `${URL}/${url}`
        const option = {
            method: 'post',
            headers: {
                'content-type': 'application/json',
                'authorization': `Bearer ${token}`,
            },
            body: JSON.stringify(datos),
        }

        return await fetch(urlPost, option)
        // const respuesta = await fetch(urlGet, option)
        // const resultado = await respuesta.json()
        // return console.log(await respuesta.json());
    }
}