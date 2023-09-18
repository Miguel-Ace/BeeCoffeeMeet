@extends('plantillas.panel')

@vite(['resources/js/panel/imagen_video.js'])

@section('titulo')
    Imagen/Video
@endsection

@section('formulario')
    <form action="{{route('multimedias.store')}}" method="post">
        @csrf
        <div class="contenedor-inputs">
            <div class="input" style="display: none">
                <label for="id_cafe">id_cafe</label>
                <input type="number" name="id_cafe" id="id_cafe" value="{{$id}}">
            </div>

            <div class="input">
                <label for="url_imagen_video1">Url imagen/video</label>
                <input type="text" name="url_imagen_video" id="url_imagen_video1">
            </div>
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
                <td>Url imagen/video</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($otrosImagenesVideo as $iv)
                @if ($iv->id_cafe == $id)
                    <tr>
                        <td class="meter-info">
                            {{$iv->url_imagen_video}}
                            {{-- <video width="640" height="360" controls src="{{$iv->url_imagen_video}}"></video> --}}
                            {{-- <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$iv->url_imagen_video}}"></iframe> --}}
                        </td>

                        <td class="acciones">
                            <button type="button" class="btn-editar" data-id="{{$iv->id}}" data-iv="{{$iv->url_imagen_video}}">
                                <i class="fa-solid fa-pencil"></i>
                            </button>

                            <form class="btn-borrar" onclick="return confirm('¿Estás Seguro de borrarlo?')"  method="post" action="{{route('multimedias.destroy', $iv->id)}}">
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
<div class="modal oculto" id="mec">
    <div class="container-modal">
        <div class="header-modal">
            <p class="titulo-modal">Editar Campos</p>
            <button class="btn-salir-modal xEditar">x</button>
        </div>

        <div class="contenido-modal">
            {{-- action="{{url('/'.auth()->user()->name.'/'.$cafe->id)}}" --}}
            <form method="post" id="form">
                @csrf
                @method('PATCH')

                <div class="contenedor-input-modal">
                    <div class="oculto" style="display: none">
                        <label for="id_cafe">id_cafe</label>
                        <input type="number" name="id_cafe" id="id_cafe" value="{{$id}}">
                    </div>
        
                    <div class="input">
                        <label for="url_imagen_video">Url imagen/video</label>
                        <input type="text" name="url_imagen_video" id="url_imagen_video">
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