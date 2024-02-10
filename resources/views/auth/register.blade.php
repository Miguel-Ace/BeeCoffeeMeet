@extends('plantillas.auth')

@section('formulario')
    <form action="{{route('register')}}" method="post">
        @csrf
        <div class="btn-auth">
            <a href="{{route('login')}}">Iniciar Sesión</a>
            <a href="" style="opacity: .5">Regístrate</a>
        </div>

        @if(session('mensaje'))
            <p class="mensaje">{{session('mensaje')}}</p>

            <script>
                const textMensaje = document.querySelector('.mensaje')
                
                setTimeout(() => {
                    textMensaje.style.display = 'none'
                }, 7000);
            </script>
        @endif

        @error('name')
            <p class="campoName">{{$message}}</p>
            <script>
                const campoName = document.querySelector('.campoName')
                
                setTimeout(() => {
                    campoName.style.display = 'none'
                }, 4000);
            </script>
        @enderror

        @error('email')
            <p class="campoEmail">{{$message}}</p>
            <script>
                const campoEmail = document.querySelector('.campoEmail')
                
                setTimeout(() => {
                    campoEmail.style.display = 'none'
                }, 4000);
            </script>
        @enderror

        @error('telefono')
            <p class="campoTelefono">{{$message}}</p>
            <script>
                const campoTelefono = document.querySelector('.campoTelefono')
                
                setTimeout(() => {
                    campoTelefono.style.display = 'none'
                }, 4000);
            </script>
        @enderror

        @error('direccion')
            <p class="campoDireccion">{{$message}}</p>
            <script>
                const campoDireccion = document.querySelector('.campoDireccion')
                
                setTimeout(() => {
                    campoDireccion.style.display = 'none'
                }, 4000);
            </script>
        @enderror

        @error('password')
            <p class="campoPassword">{{$message}}</p>
            <script>
                const campoPassword = document.querySelector('.campoPassword')
                
                setTimeout(() => {
                    campoPassword.style.display = 'none'
                }, 4000);
            </script>
        @enderror

        <div class="contenedor-inputs">
            <div class="input">
                {{-- <label for="name">Nombre</label> --}}
                <i class="fa-solid fa-user-tie"></i>
                <input type="text" name="name" id="name" @error('name') style="border: 1px solid red" @enderror placeholder="Nombre" value="{{old('name')}}">
            </div>
            <div class="input">
                {{-- <label for="email">Correo</label> --}}
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" id="email" @error('email') style="border: 1px solid red" @enderror placeholder="Correo" value="{{old('email')}}">
            </div>
            <div class="input">
                {{-- <label for="telefono">Teléfono</label> --}}
                <i class="fa-solid fa-phone"></i>
                <input type="text" name="telefono" id="telefono" @error('telefono') style="border: 1px solid red" @enderror placeholder="Teléfono" value="{{old('telefono')}}">
            </div>
            <div class="input textarea">
                {{-- <label for="direccion">Dirección</label> --}}
                <textarea name="direccion" id="direccion" @error('direccion') style="border: 1px solid red" @enderror placeholder="Dirección">{{old('direccion')}}</textarea>
            </div>
            <div class="input">
                {{-- <label for="password">Contraseña</label> --}}
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" @error('password') style="border: 1px solid red" @enderror placeholder="Contraseña">
            </div>
            <div class="input">
                {{-- <label for="password">Contraseña</label> --}}
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar Contraseña">
            </div>
        </div>

        <button class="btn-enviar" type="submit">Regístrar</button>
        
        <div class="ultimos-datos">
            {{-- <div class="recordar">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Mantener activa la sesión</label>
            </div> --}}
            <a href="#">Olvidastes tu contraseña?</a>
        </div>
    </form>
@endsection