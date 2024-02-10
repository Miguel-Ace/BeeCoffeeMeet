<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Café</title>
    <script src="https://kit.fontawesome.com/cd197f289d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=initMap"></script> --}}
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    @vite([
        'resources/sass/cafes.scss',
        'resources/sass/modal.scss',
        'resources/js/cafes/coordenadas.js',
        'resources/js/cafes/modal_crear.js',
        'resources/js/cafes/modal_editar.js',
        'resources/js/cafes/reservas.js',
        'resources/js/cafes/cafes.js',
        'resources/js/cafes/mapa_coordenadas.js',
        'resources/js/cafes/modal_rol.js',
        ])
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
    
    <header>
        <div class="logo">
            <img src="{{asset('img/CupSpot.png')}}" alt="">
        </div>

        <div class="info">
            <p class="crear-rol">Crear <span>Rol</span></p>
            <p class="crear-cafe">Crear <span>Café</span></p>
            <form method="POST" action="{{ url('logout') }}">
                @csrf
                <button type="submit" class="">Salir</button>
            </form>
            <p>Hola: {{auth()->user()->name}}</p>
        </div>
    </header>

    <div class="contenedor-map">
        <div class="mapa">
            <span class="salir">x</span>

            <select id="location">
                <option value="-1">Selecciona una provincia</option>
                <option value="9.932076, -84.079657">San José</option>
                <option value="10.452701, -84.47113">Alajuela</option>
                <option value="9.798384, -83.693848">Cartago</option>
                <option value="10.225734, -85.521698">Guanacaste</option>
                <option value="10.232492, -84.201965">Heredia</option>
                <option value="10.090558, -83.350525">Limón</option>
                <option value="9.256647, -84.221191">Puntarenas</option>
        
            </select>

            <div id="map"></div>
        </div>
    </div>

    <div class="contenedor-roles">
        <div class="roles">
            <div class="encabezado-rol">
                <span class="salir_rol">x</span>
                <p class="">Asignar Roles</p>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Asignar rol</th>
                        <th>Activar cuenta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                            <td class="accion-rol">
                                <form action="{{ url('/assign'.'/'.$user->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" id="role" class="form-control">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" {{ $user->hasRole($role) ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="actualizar">Asignar</button>
                                </form>
                            </td>
                            <td>
                                @if ($user->activo == 1)
                                    <input type="checkbox" id="{{$user->id}}" class="activo" checked>
                                @else
                                    <input type="checkbox" id="{{$user->id}}" class="activo">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <main>
        <div class="contenedor-cards">
            @foreach ($cafes as $cafe)
                @if ($cafe->id_usuario == auth()->user()->id)
                    <div class="card">
                        <div class="logo-card">
                            <img src="{{$cafe->url_logo}}" alt="">
                        </div>
                        <div class="informacion-card">
                            <p class="nombre-empresa">{{$cafe->nombre}}</p>
                            <p class="descripcion-empresa">{{$cafe->descripcion_corta}}</p>
                        </div>
                        <div class="botones-card">
                            <button class="btn-reservacion" data-cafeId="{{$cafe->id}}">Reservaciones</button>
                            
                            <div class="btn-acciones">
                                <a href="{{url('/panel/otros_cafes/'.$cafe->id)}}" class="btn-setting"><i class="fa-solid fa-gear"></i></a>

                                <button class="btn-editar" data-cafeId="{{$cafe->id}}" data-nombre="{{$cafe->nombre}}" data-dc="{{$cafe->descripcion_corta}}" data-dg="{{$cafe->descripcion_larga}}" data-urlogo="{{$cafe->url_logo}}" data-eslogan="{{$cafe->eslogan}}" data-cantidadmesas="{{$cafe->cantidad_mesas}}" data-capacidad="{{$cafe->capacidad}}" data-provincia="{{$cafe->provincia}}" data-canton="{{$cafe->canton}}" data-distrito="{{$cafe->distrito}}" data-barrio="{{$cafe->barrio}}" data-direccion="{{$cafe->direccion}}" data-max_time_reser="{{$cafe->max_time_reser}}" data-longitud="{{$cafe->longitud}}" data-latitud="{{$cafe->latitud}}" data-promediovaloracion="{{$cafe->promedio_valoracion}}"><i class="fa-solid fa-pencil"></i></button>

                                <form action="{{url('cafe/'.$cafe->id)}}"  method="post" id-cafeId="{{$cafe->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-borrar"><i class="fa-solid fa-trash"></i></button>
                                </form>
                                {{-- <button class="btn-borrar" data-cafeId="{{$cafe->id}}"><i class="fa-solid fa-trash"></i></button> --}}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </main>
</body>
</html>

<!-- Modal Crear -->
<div class="modal oculto" id="mcc">
    <div class="container-modal">
        <div class="header-modal">
            <p class="titulo-modal">Crear Café</p>
            <button class="btn-salir-modal x">x</button>
        </div>

        <div class="contenido-modal">
            <form method="post" action="{{route('cafe.store')}}">
                @csrf

                <div class="contenedor-input-modal">
                    <div class="oculto">
                        <label for="id_usuario">id_usuario</label>
                        <input type="number" name="id_usuario" id="id_usuario" value="{{auth()->user()->id}}">
                    </div>

                    <div class="input">
                        {{-- <label for="nombre">Nombre</label> --}}
                        <i class="fa-solid fa-user-tie"></i>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="{{old('nombre')}}">
                    </div>

                    <div class="input">
                        <i class="fa-regular fa-file-lines"></i>
                        <textarea name="descripcion_corta" id="descripcion_corta"  placeholder="Descripción corta">{{old('descripcion_corta')}}</textarea>
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-file-lines"></i>
                        <textarea name="descripcion_larga" id="descripcion_larga"  placeholder="Descripción larga">{{old('descripcion_larga')}}</textarea>
                    </div>

                    <div class="input">
                        {{-- <label for="url_logo">Url logo</label> --}}
                        <i class="fa-solid fa-link"></i>
                        <input type="text" name="url_logo" id="url_logo"  placeholder="Url del logo" value="{{old('url_logo')}}">
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-closed-captioning"></i>
                        <input type="text" name="eslogan" id="eslogan"  placeholder="Eslogan" value="{{old('eslogan')}}">
                    </div>

                    <div class="input">
                        {{-- <label for="cantidad_mesas">Cantidad de mesas</label> --}}
                        <i class="fa-solid fa-table-list"></i>
                        <input type="number" name="cantidad_mesas" id="cantidad_mesas"  placeholder="Cantidad de mesas" value="{{old('cantidad_mesas')}}">
                    </div>

                    <div class="input">
                        {{-- <label for="cantidad_mesas">Cantidad de mesas</label> --}}
                        <i class="fa-solid fa-users"></i>
                        <input type="number" name="capacidad" id="capacidad"  placeholder="Cantidad de personas" value="{{old('capacidad')}}">
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <select name="provincia" id="provincia">
                            <option value="" disabled selected>Seleccione provincia</option>
                            @foreach ($datosCostaRica['provincias'] as $provincia)
                                <option value="{{ $provincia['nombre'] }}">{{ $provincia['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <select name="canton" id="canton">
                            <option value="" disabled selected>Seleccione canton</option>
                            @foreach ($datosCostaRica['provincias'] as $provincia)
                                @foreach ($provincia['cantones'] as $canton)
                                    <option value="{{ $canton['nombre'] }}">{{ $canton['nombre'] }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <select name="distrito" id="distrito">
                            <option value="" disabled selected>Seleccione distrito</option>
                            @foreach ($datosCostaRica['provincias'] as $provincia)
                                @foreach ($provincia['cantones'] as $canton)
                                    @foreach ($canton['distritos'] as $distrito)
                                        <option value="{{ $distrito }}">{{ $distrito }}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <input type="text" name="barrio" id="barrio"  placeholder="barrio" value="{{old('barrio')}}">
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-road"></i>
                        <textarea name="direccion" id="direccion" placeholder="Dirección">{{old('direccion')}}</textarea>
                    </div>

                    <div class="input">
                        <i class="fa-regular fa-clock"></i>
                        <input type="number" name="max_time_reser" id="max_time_reser" min="0"  placeholder="Tiempo de reservación (Minutos)" value="{{old('max_time_reser')}}">
                    </div>

                    <div class="input">
                        {{-- <label for="latitud">latitud</label> --}}
                        <i class="fa-solid fa-route"></i>
                        <input type="text" name="latitud" id="latitud"  placeholder="Latitud" value="{{old('latitud')}}">
                    </div class="input">

                    <div class="input">
                        {{-- <label for="longitud">longitud</label> --}}
                        <i class="fa-solid fa-route"></i>
                        <input type="text" name="longitud" id="longitud"  placeholder="Longitud" value="{{old('longitud')}}">
                    </div>

                    {{-- <div class="input rango">
                        <label for="promedio_valoracion">Promedio valoracion</label>
                        <input type="range" id="promedio_valoracion" name="promedio_valoracion" min="1" max="5" step="1" value="0">
                    </div> --}}
                </div>

                <i class="fa-solid fa-location-dot ico-mapa"></i>
                
                <div class="btns-acciones-modal">
                    <button class="guardar" id="guardad_mcc" type="submit">Guardar</button>
                    <span class="cerrar">Cerrar</span>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Fin Modal Crear --}}

<!-- Modal Reserva -->
<div class="modal oculto" id="mrc">
    <div class="container-modal">
        <div class="header-modal">
            <p class="titulo-modal">Reservaciones </p>
            <button class="btn-salir-modal xReservar">x</button>
        </div>

        <div class="contenido-modal">
            <table>
                <thead>
                    <tr>
                        <td>Usuario</td>
                        <td>Fecha y hora</td>
                        <td>Fecha y hora inicio</td>
                        <td>Fecha y hora fin</td>
                        <td>Cantidad de persona</td>
                        <td>Petición</td>
                        <td>Comentarios</td>
                    </tr>
                </thead>
                <tbody class="tbody-reservaciones">
                    @foreach ($reservaciones as $reservacion)
                        <tr>
                            <td style="display: none">{{$reservacion->id_cafe}}</td>
                            <td>{{$reservacion->id_usuario}}</td>
                            <td>{{$reservacion->fecha_hora}}</td>
                            <td>{{$reservacion->fecha_hora_inicio}}</td>
                            <td>{{$reservacion->fecha_hora_fin}}</td>
                            <td>{{$reservacion->cantidad_personas}}</td>
                            <td>{{$reservacion->peticion}}</td>
                            <td>{{$reservacion->comentarios}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Fin Modal Reserva --}}

<!-- Modal Editar -->
<div class="modal oculto" id="mec">
    <div class="container-modal">
        <div class="header-modal">
            <p class="titulo-modal">Editar Café</p>
            <button class="btn-salir-modal xEditar">x</button>
        </div>

        <div class="contenido-modal">
            {{-- action="{{url('/'.auth()->user()->name.'/'.$cafe->id)}}" --}}
            <form method="post">
                @csrf
                @method('PATCH')

                <div class="contenedor-input-modal">
                    <div class="oculto">
                        <label for="id_usuario">id_usuario</label>
                        <input type="number" name="id_usuario" id="id_usuario" value="{{auth()->user()->id}}">
                    </div>

                    <div class="input">
                        {{-- <label for="nombre">Nombre</label> --}}
                        <i class="fa-solid fa-user-tie"></i>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="{{old('nombre')}}">
                    </div>

                    <div class="input">
                        <i class="fa-regular fa-file-lines"></i>
                        <textarea name="descripcion_corta" id="descripcion_corta"  placeholder="Descripción corta">{{old('descripcion_corta')}}</textarea>
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-file-lines"></i>
                        <textarea name="descripcion_larga" id="descripcion_larga"  placeholder="Descripción larga">{{old('descripcion_larga')}}</textarea>
                    </div>

                    <div class="input">
                        {{-- <label for="url_logo">Url logo</label> --}}
                        <i class="fa-solid fa-link"></i>
                        <input type="text" name="url_logo" id="url_logo"  placeholder="Url del logo" value="{{old('url_logo')}}">
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-closed-captioning"></i>
                        <input type="text" name="eslogan" id="eslogan"  placeholder="Eslogan" value="{{old('eslogan')}}">
                    </div>

                    <div class="input">
                        {{-- <label for="cantidad_mesas">Cantidad de mesas</label> --}}
                        <i class="fa-solid fa-table-list"></i>
                        <input type="number" name="cantidad_mesas" id="cantidad_mesas"  placeholder="Cantidad de mesas" value="{{old('cantidad_mesas')}}">
                    </div>

                    <div class="input">
                        {{-- <label for="cantidad_mesas">Cantidad de mesas</label> --}}
                        <i class="fa-solid fa-users"></i>
                        <input type="number" name="capacidad" id="capacidad"  placeholder="Cantidad de personas" value="{{old('capacidad')}}">
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <select name="provincia" id="provincia">
                            <option value="" disabled selected>Seleccione provincia</option>
                            @foreach ($datosCostaRica['provincias'] as $provincia)
                                <option value="{{ $provincia['nombre'] }}">{{ $provincia['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <select name="canton" id="canton">
                            <option value="" disabled selected>Seleccione canton</option>
                            @foreach ($datosCostaRica['provincias'] as $provincia)
                                @foreach ($provincia['cantones'] as $canton)
                                    <option value="{{ $canton['nombre'] }}">{{ $canton['nombre'] }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <select name="distrito" id="distrito">
                            <option value="" disabled selected>Seleccione distrito</option>
                            @foreach ($datosCostaRica['provincias'] as $provincia)
                                @foreach ($provincia['cantones'] as $canton)
                                    @foreach ($canton['distritos'] as $distrito)
                                        <option value="{{ $distrito }}">{{ $distrito }}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <input type="text" name="barrio" id="barrio"  placeholder="barrio" value="{{old('barrio')}}">
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-road"></i>
                        <textarea name="direccion" id="direccion" placeholder="Dirección">{{old('direccion')}}</textarea>
                    </div>

                    <div class="input">
                        <i class="fa-regular fa-clock"></i>
                        <input type="number" name="max_time_reser" id="max_time_reser" min="0"  placeholder="Tiempo de reservación (Minutos)" value="{{old('max_time_reser')}}">
                    </div>

                    <div class="input">
                        {{-- <label for="latitud">latitud</label> --}}
                        <i class="fa-solid fa-route"></i>
                        <input type="text" name="latitud" id="latitud"  placeholder="Latitud" value="{{old('latitud')}}">
                    </div class="input">

                    <div class="input">
                        {{-- <label for="longitud">longitud</label> --}}
                        <i class="fa-solid fa-route"></i>
                        <input type="text" name="longitud" id="longitud"  placeholder="Longitud" value="{{old('longitud')}}">
                    </div>
                    {{-- <div class="input rango">
                        <label for="promedio_valoracion">Promedio valoracion</label>
                        <input type="range" id="promedio_valoracion" name="promedio_valoracion" min="1" max="5" step="1" value="0">
                    </div> --}}
                </div>

                <i class="fa-solid fa-location-dot ico-mapa"></i>

                <div class="btns-acciones-modal">
                    <button class="guardar" id="guardad_mec" type="submit">Guardar</button>
                    <span class="cerrar cEditar">Cerrar</span>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Fin Modal Editar --}}

<script>
    const btnReservacion = document.querySelectorAll('.btn-reservacion')
    const tbodyReservaciones = document.querySelectorAll('.tbody-reservaciones tr')

    btnReservacion.forEach(item => {
        item.addEventListener('click', () => {
            const idCafe = item.getAttribute('data-cafeid')
            // console.log(idCafe);

            tbodyReservaciones.forEach(item => {
                const valorCafeId = item.querySelector('td:nth-child(1)')
                if (valorCafeId.textContent != idCafe) {
                    item.style = 'display:none'
                    console.log(item);
                }else{
                    item.style = ''
                }
            });
        })
    });
</script>