@extends('plantillas.panel')

@vite(['resources/js/panel/comentarios.js'])

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
                <td>Desactivar</td>
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
                            @role('admin')
                            <form action="{{url('/send_email_cambio_comentario'.'/'.$comentario->id_cafe.'/'.$comentario->id_usuario)}}" method="post">
                                @csrf
                                <button class="btn-abrir-modal-enviar"><i class="fa-regular fa-envelope"></i></button>
                            </form>
                            @endrole

                            @role('su_admin')
                            <button type="button" class="btn-activar" data-id="{{$comentario->id}}" idUser="{{$comentario->id_usuario}}" comen="{{$comentario->comentario}}" comen="{{$comentario->comentario}}" fe="{{$comentario->fecha_hora}}" es="{{$comentario->estrellas}}" activo="1">
                                <i class="fa-solid fa-check"></i>
                            </button>

                            <button type="button" class="btn-desactivar" data-id="{{$comentario->id}}" idUser="{{$comentario->id_usuario}}" comen="{{$comentario->comentario}}" comen="{{$comentario->comentario}}" fe="{{$comentario->fecha_hora}}" es="{{$comentario->estrellas}}" activo="0">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            @endrole
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
            <form method="post" id="form">
                @csrf
                @method('PATCH')

                <div class="contenedor-input-modal">
                    <div>
                        <label for="activo">activo</label>
                        <input type="number" name="activo" id="activo" value="1">
                    </div>
                </div>

                <button class="guardar" id="guardad_mec" type="submit">Guardar</button>
            </form>
        </div>
    </div>
</div>
{{-- Fin Modal Editar --}}