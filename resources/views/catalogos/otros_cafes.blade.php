@extends('plantillas.panel')

@vite(['resources/js/panel/otros_cafe.js'])

@section('titulo')
    Otros cafés
@endsection

@section('formulario')
    <form action="{{route('otros_cafes.store')}}" method="post">
        @csrf
        <div class="contenedor-inputs">
            <div class="input" style="display: none">
                <label for="id_cafe">id_cafe</label>
                <input type="number" name="id_cafe" id="id_cafe" value="{{$id}}">
            </div>

            <div class="input">
                <label for="otros_cafe">Otros café</label>
                <textarea name="otros_cafe" id="otros_cafe" style="min-width:35rem;max-width:35rem;min-height: 135;max-height: 135;"></textarea>
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
                <td>Otros cafés</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($otrosCafes as $otrosCafe)
                @if ($otrosCafe->id_cafe == $id)
                    <tr>
                        <td>{{$otrosCafe->otros_cafe}}</td>
                        <td class="acciones">
                            <button type="button" class="btn-editar" data-otroCafe="{{$otrosCafe->otros_cafe}}" data-id="{{$otrosCafe->id}}">
                                <i class="fa-solid fa-pencil"></i>
                            </button>

                            <form class="btn-borrar" onclick="return confirm('¿Estás Seguro de borrarlo?')"  method="post" action="{{route('otros_cafes.destroy', $otrosCafe->id)}}">
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