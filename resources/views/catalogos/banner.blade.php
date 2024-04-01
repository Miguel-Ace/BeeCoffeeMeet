@extends('plantillas.panel')

@vite(['resources/js/panel/banner.js','resources/js/panel/modal_imagenes.js','resources/sass/modal_imagenes.scss'])

@section('titulo')
    Banner
@endsection

@section('formulario')
    <form action="{{route('banner.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="contenedor-inputs">
            <div class="input" style="display: none">
                <label for="id_cafe">id_cafe</label>
                <input type="number" name="id_cafe" id="id_cafe" value="{{$id}}">
            </div>

            <div class="input">
                <label for="url_imagen">Seleccione un banner</label>
                <input type="file" name="url_imagen" id="url_imagen" accept="image/*"  value="{{old('url_imagen')}}">
            </div>

            <div class="input">
                <label for="fecha_hora">Fecha y hora</label>
                <input type="datetime-local" name="fecha_hora" id="fecha_hora">
            </div>

            <div class="input">
                <label for="fecha_hora_inicio">Fecha y hora inicio</label>
                <input type="datetime-local" name="fecha_hora_inicio" id="fecha_hora_inicio">
            </div>

            <div class="input">
                <label for="fecha_hora_fin">Fecha y hora fin</label>
                <input type="datetime-local" name="fecha_hora_fin" id="fecha_hora_fin">
            </div>

            {{-- <div class="input" style="display: none">
                <input type="text" name="activo" value="1" id="activo">
            </div> --}}
        </div>

        <div class="contenedor-btn">
            <button class="btn-guardar">Guardar</button>
        </div>
    </form>
@endsection

@section('tablas')
    <table>
        <thead>
            <tr>
                <td>Url imagen</td>
                <td>Fecha y hora</td>
                <td>Fecha y hora inicio</td>
                <td>Fecha y hora fin</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($otrosBanner as $banner)
                @if ($banner->id_cafe == $id)
                    <tr>
                        <td class="img">
                            <img src="{{asset('storage/banners/'.$banner->url_imagen)}}" style="width: 5rem; height: 4rem" alt="">
                        </td>
                        <td>{{$banner->fecha_hora}}</td>
                        <td>{{$banner->fecha_hora_inicio}}</td>
                        <td>{{$banner->fecha_hora_fin}}</td>
                        <td class="acciones">
                            <button type="button" class="btn-editar" data-id="{{$banner->id}}" data-urlimagen="{{$banner->url_imagen}}" data-fh="{{$banner->fecha_hora}}" data-fhi="{{$banner->fecha_hora_inicio}}" data-fhf="{{$banner->fecha_hora_fin}}">
                                <i class="fa-solid fa-pencil"></i>
                            </button>

                            <form class="btn-borrar"  method="post" action="{{url('/panel/banner/'.$banner->id.'/'.$banner->url_imagen)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn-borrar"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection

<!-- Modal Editar -->
<div class="modal" id="mec">
    <div class="container-modal">
        <div class="header-modal">
            <p class="titulo-modal">Editar Campos</p>
            <button class="btn-salir-modal xEditar">x</button>
        </div>

        <div class="contenido-modal">
            {{-- action="{{url('/'.auth()->user()->name.'/'.$cafe->id)}}" --}}
            <form method="post" id="form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="contenedor-input-modal">
                    <div class="oculto" style="display: none">
                        <label for="id_cafe">id_cafe</label>
                        <input type="number" name="id_cafe" id="id_cafe" value="{{$id}}">
                    </div>
        
                    <div class="input">
                        <label for="url_imagen">Seleccione un banner</label>
                        <input type="file" name="url_imagen" id="url_imagen" accept="image/*"  value="{{old('url_imagen')}}">
                    </div>
        
                    <div class="input">
                        <label for="fecha_hora">Fecha y hora</label>
                        <input type="datetime-local" name="fecha_hora" id="fecha_hora">
                    </div>
        
                    <div class="input">
                        <label for="fecha_hora_inicio">Fecha y hora inicio</label>
                        <input type="datetime-local" name="fecha_hora_inicio" id="fecha_hora_inicio">
                    </div>
        
                    <div class="input">
                        <label for="fecha_hora_fin">Fecha y hora fin</label>
                        <input type="datetime-local" name="fecha_hora_fin" id="fecha_hora_fin">
                    </div>
        
                    <div class="input" style="display: none">
                        <input type="text" name="activo" value="1" id="activo">
                    </div>
                </div>

                <div class="btns-acciones-modal">
                    <button class="guardar" id="guardad_mec" type="submit">Guardar</button>
                    <span class="cerrar cEditar">Cerrar</span>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Fin Modal Editar --}}

{{-- Mostrar imagen --}}
<div class="img-mostrar">
    <img src="" alt="">
</div>