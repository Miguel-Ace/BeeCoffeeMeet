@extends('plantillas.panel')

@vite(['resources/js/panel/notificaciones.js'])

@section('titulo')
    Notificaciones
@endsection

@section('formulario')
    <form action="{{route('notificaciones.store')}}" method="post">
        @csrf
        <div class="contenedor-inputs">
            <div class="input" style="display: none">
                <label for="id_cafe">id_cafe</label>
                <input type="number" name="id_cafe" id="id_cafe" value="{{$id}}">
            </div>

            <div class="input">
                <label for="notificacion">Notificaciones</label>
                <input type="text" name="notificacion" id="notificacion">
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
                {{-- <label for="">Activo</label>
                <div>
                    <label>
                        <input type="radio" name="activo" value="true" id="opcion-si">
                        Si
                    </label>
                    <label>
                        <input type="radio" name="activo" value="false" id="opcion-no">
                        No
                    </label>
                </div> --}}
                <input type="text" name="activo" value="true" id="activo">
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
                <td>Notificaciones</td>
                <td>Fecha y hora</td>
                <td>Fecha y hora inicio</td>
                <td>Fecha y hora fin</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($notificaciones as $notificacion)
                @if ($notificacion->id_cafe == $id)
                    <tr>
                        <td>{{$notificacion->notificacion}}</td>
                        <td>{{$notificacion->fecha_hora}}</td>
                        <td>{{$notificacion->fecha_hora_inicio}}</td>
                        <td>{{$notificacion->fecha_hora_fin}}</td>
                        <td class="acciones">
                            <button type="button" class="btn-editar" data-id="{{$notificacion->id}}" data-notificacion="{{$notificacion->notificacion}}" data-fh="{{$notificacion->fecha_hora}}" data-fhi="{{$notificacion->fecha_hora_inicio}}" data-fhf="{{$notificacion->fecha_hora_fin}}">
                                <i class="fa-solid fa-pencil"></i>
                            </button>

                            <form class="btn-borrar" onclick="return confirm('¿Estás Seguro de borrarlo?')"  method="post" action="{{route('notificaciones.destroy', $notificacion->id)}}">
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
                        <label for="notificacion">Notificaciones</label>
                        <input type="text" name="notificacion" id="notificacion">
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
                        <input type="text" name="activo" value="true" id="activo">
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