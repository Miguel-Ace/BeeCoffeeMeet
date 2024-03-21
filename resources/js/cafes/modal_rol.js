const btn_salir = document.querySelector('.salir_rol')
const btn_crear_rol = document.querySelector('.crear-rol')
const contenedor_roles = document.querySelector('.contenedor-roles')

btn_crear_rol ?
btn_crear_rol.addEventListener('click', () => {
    contenedor_roles.classList.add('activo')
}) : ''

btn_salir.addEventListener('click', () => {
    contenedor_roles.classList.remove('activo')
})