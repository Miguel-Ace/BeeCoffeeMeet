@extends('plantillas.panel')

@vite(['resources/js/panel/horarios.js'])

@section('titulo')
    Horarios
@endsection

@section('formulario')
    <form action="{{url('/panel/horarios_masivo/')}}" method="post">
        @csrf
        <div class="contenedor-inputs">
            <div class="input" style="display: none">
                <label for="id_cafe">id_cafe</label>
                <input type="number" name="id_cafe" id="id_cafe" value="{{$id}}">
            </div>

            <div class="input">
                <label for="dia">Día</label>
                <select name="dia" id="dias">
                    <option value="" selected disabled>Seleccionar día</option>
                    @foreach ($dias as $dia)
                        @if ($dia === 'Generar días automaticamente')
                            <option  {{old('dia') == $dia ? 'selected' : ''}} style="color:blue;text-align: center;" value="{{$dia}}">{{$dia}}</option>
                        @else
                            <option  {{old('dia') == $dia ? 'selected' : ''}} value="{{$dia}}">{{$dia}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="input">
                <label for="hora_inicio">Hora inicio</label>
                <input type="time" name="hora_inicio" id="hora_inicio" value="{{old('hora_inicio')}}">
            </div>

            <div class="input">
                <label for="hora_fin">Hora fin</label>
                <input type="time" name="hora_fin" id="hora_fin" value="{{old('hora_fin')}}">
            </div>
        </div>

        <div class="contenedor-btn">
            <button class="btn-guardar">Generar días</button>
        </div>
    </form>
@endsection

@section('tablas')
    <table>
        <thead>
            <tr>
                <td>Día</td>
                <td>Hora inicio</td>
                <td>Hora fin</td>
                <td>Estado</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($horarios as $h)
                <tr>
                    <td>
                        {{$h->dia}}
                    </td>
                    
                    <td>
                        {{$h->hora_inicio}}
                    </td>

                    <td>
                        {{$h->hora_fin}}
                    </td>

                    <td class="form-activo">
                        <form method="post" action="{{url('/panel/horarios_activo/'.$h->id)}}">
                            @csrf
                            @method('PATCH')
                            <button class="{{$h->estado ? 'activo' : 'inactivo'}}">{{$h->estado ? 'Activo' : 'Inactivo'}}</button>
                        </form>
                    </td>

                    <td class="acciones">
                        <button type="button" class="btn-editar" data-id="{{$h->id}}" data-dia="{{$h->dia}}" data-hi="{{$h->hora_inicio}}" data-hf="{{$h->hora_fin}}">
                            <i class="fa-solid fa-pencil"></i>
                        </button>

                        <form class="btn-borrar" method="post" action="{{route('horarios.destroy', $h->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn-borrar"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                {{-- @if ($h->id_cafe == $id)
                @endif --}}
            @endforeach
        </tbody>
    </table>
@endsection

<!-- Modal Editar -->
<div class="modal" id="meh">
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
                        <label for="dia">Día</label>
                        <select name="dia" id="dia">
                            <option value="" selected disabled>Seleccionar día</option>
                            @foreach ($dias as $dia)
                                <option value="{{$dia}}">{{$dia}}</option>
                                @if ($dia === 'Domingo')
                                    @break
                                @endif
                            @endforeach
                        </select>
                    </div>
        
                    <div class="input">
                        <label for="hora_inicio">Hora inicio</label>
                        <input type="time" name="hora_inicio" id="hora_inicio">
                    </div>
        
                    <div class="input">
                        <label for="hora_fin">Hora fin</label>
                        <input type="time" name="hora_fin" id="hora_fin">
                    </div>
                </div>

                <div class="btns-acciones-modal">
                    <button class="guardar" id="guardad_meh" type="submit">Guardar</button>
                    <span class="cerrar cEditar">Cerrar</span>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Fin Modal Editar --}}