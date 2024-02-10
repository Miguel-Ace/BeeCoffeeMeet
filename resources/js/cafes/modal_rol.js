async function roles(){
    const btn_salir = document.querySelector('.salir_rol')
    const btn_crear_rol = document.querySelector('.crear-rol')
    const contenedor_roles = document.querySelector('.contenedor-roles')
    const check_activo = document.querySelectorAll('.activo')
    // url
    const server = 'http://161.22.40.55/api'
    const local = 'http://127.0.0.1:8000/api'
    const url = server
    
    // Generar el token
    const tokenEndpoint = `${url}/login`;
    
    const credenciales_get_token = {
        email: 'acevedo51198mac@gmail.com',
        password: '12345678',
    }
    
    const option_token = {
        method: 'POST',
        body: new URLSearchParams(credenciales_get_token),
    };
    
    const response_token = await fetch(tokenEndpoint, option_token)
    const result_token = await response_token.json()
    const token = result_token.access_token
    // ===== Fin generar el token =====
    
    btn_crear_rol.addEventListener('click', () => {
        contenedor_roles.classList.add('activo')
    })
    
    btn_salir.addEventListener('click', () => {
        contenedor_roles.classList.remove('activo')
    })
    
    for (const item of check_activo) {
        item.addEventListener('change', () => {
            const procesar_update = (estado, id) => {
                const url_user = `${url}/user/update/${id}`

                const credenciales_put_user = {
                    activo: estado
                }
    
                const opciones = {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        authorization: `Bearer ${token}`
                    },
                    body: JSON.stringify(credenciales_put_user)
                }
                
                fetch(url_user,opciones)
            }

            if (item.checked) {
                // console.log('El checkbox está marcado');
                // Tu lógica adicional cuando el checkbox está marcado
                procesar_update(1,item.getAttribute('id'))
            } else {
                // console.log('El checkbox está desmarcado');
                // Tu lógica adicional cuando el checkbox está desmarcado
                procesar_update(0,item.getAttribute('id'))
            }
        })
    }
}

roles()