<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/cd197f289d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/sass/panel.scss','resources/sass/modal_panel.scss','resources/js/panel/panel.js'])
</head>
<body>
    @if (session('mensaje'))
        <style>
            .custom-popup-class {
                width: 50rem; /* Ancho personalizado */
                font-size: 1.3rem
            }
        </style>

        <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: '{{session('mensaje')}}',
            showConfirmButton: false,
            timer: 1500,
            customClass: {
                popup: 'custom-popup-class', // Clase personalizada para el contenedor de la alerta
            },
            })
        </script>
    @endif

    <main>
        <div class="izq">
            <div class="toggle"><span></span></div>

            <div class="iconos">
                <a href="{{url('/panel/otros_cafes/'.$id)}}">
                    <i class="fa-solid fa-mug-hot"></i>
                    <span>Otros cafés</span>
                </a>
                <a href="{{url('/panel/notificaciones/'.$id)}}">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Notificaciones</span>
                </a>
                <a href="{{url('/panel/banner/'.$id)}}">
                    <i class="fa-regular fa-image"></i>
                    <span>Banner</span>
                </a>
                <a href="{{url('/panel/multimedias/'.$id)}}">
                    <i class="fa-solid fa-file-video"></i>
                    <span>Imagen/Video</span>
                </a>
                <a href="{{url('/panel/comentarios/'.$id)}}">
                    <i class="fa-regular fa-comments"></i>
                    <span>Comentarios</span>
                </a>
            </div>

            <a href="{{url('/')}}" class="icono-cerrar-sesion">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>

        <div class="der">
            <div class="container">
                <div class="crear">
                    <div class="encabezado-form">
                        <p class="titulo-page">Crear: <span>@yield('titulo')</span></p>

                        <p>{{$cafeNombre->nombre}}</p>
                    </div>
                    @yield('formulario')
                </div>
                
                <div class="tabla">
                    <div class="encabezado-tabla">
                        <p>Tabla:</p>
                    </div>
                    @yield('tablas')
                </div>
            </div>
        </div>
    </main>
</body>
</html>