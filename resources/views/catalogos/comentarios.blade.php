@extends('plantillas.panel')

@vite(['resources/js/panel/otros_cafe.js'])

@section('titulo')
    Comentarios
@endsection

@section('tablas')
    <table>
        <thead>
            <tr>
                <td>Comentarios</td>
                <td>Fecha y hora</td>
                <td>Estrellas</td>
                <td>Activo</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($comentarios as $comentario)
                @if ($comentario->id_cafe == $id)
                    <tr>
                        <td>{{$comentario->comentario}}</td>
                        <td>{{$comentario->fecha_hora}}</td>
                        <td>{{$comentario->estrellas}}</td>
                        <td>{{$comentario->activo}}</td>
                        <td class="acciones">
                            <button type="button" class="btn-activar">
                                <i class="fa-solid fa-check"></i>
                            </button>

                            <button type="button" class="btn-desactivar">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
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
                        <label for="otros_cafe">Otros café</label>
                        {{-- <input type="text" name="otros_cafe" id="otros_cafe" value=""> --}}
                        <textarea name="otros_cafe" id="otros_cafe" style="min-width:35rem;max-width:35rem;min-height: 135;max-height: 135;"></textarea>
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