@extends('plantillas.panel')

@vite(['resources/js/panel/horarios.js','resources/js/panel/modal_imagenes.js','resources/sass/modal_imagenes.scss'])

@section('titulo')
    Imagenes
@endsection

@section('formulario')
    <form action="{{url('/panel/imagenes/')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="contenedor-inputs">
            <div class="input" style="display: none">
                <label for="id_cafe">id_cafe</label>
                <input type="number" name="id_cafe" id="id_cafe" value="{{$id}}">
            </div>

            <div class="input">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="file" id="imagen" accept="image/*" value="{{old('imagen')}}">
                @error('imagen')
                    <p>{{$message}}</p>
                @enderror
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
                <td>Imagen</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($imagenes as $img)
                @if ($img->id_cafe == $id)
                    <tr>
                        <td class="imagen img">
                            <img src="{{ asset('storage/imagenes/'.$img->imagen) }}" alt="">
                        </td>

                        <td class="acciones imagen">
                            {{-- <button type="button" class="btn-editar" data-id="{{$h->id}}" data-dia="{{$h->dia}}" data-hi="{{$h->hora_inicio}}" data-hf="{{$h->hora_fin}}">
                                <i class="fa-solid fa-pencil"></i>
                            </button> --}}

                            <form class="btn-borrar"  method="post" action="{{url('/panel/imagenes/'.$img->id.'/'.$img->imagen)}}">
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
{{-- <div class="modal" id="meh">
    <div class="container-modal">
        <div class="header-modal">
            <p class="titulo-modal">Editar Campos</p>
            <button class="btn-salir-modal xEditar">x</button>
        </div>

        <div class="contenido-modal">
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
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miércoles">Miércoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sábado">Sábado</option>
                            <option value="Domingo">Domingo</option>
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
</div> --}}
{{-- Fin Modal Editar --}}

{{-- Mostrar imagen --}}
<div class="img-mostrar">
    <img src="" alt="">
</div>