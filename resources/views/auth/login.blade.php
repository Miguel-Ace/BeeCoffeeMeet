@extends('plantillas.auth')

@section('formulario')
    <form action="{{route('login')}}" method="post">
        @csrf
        <div class="btn-auth">
            <a href="" style="opacity: .5">Iniciar Sesión</a>
            <a href="{{route('register')}}">Regístrate</a>
        </div>

        @if(session('mensaje'))
            <p class="mensaje">{{session('mensaje')}}</p>

            <script>
                const textMensaje = document.querySelector('.mensaje')
                
                setTimeout(() => {
                    textMensaje.style.display = 'none'
                }, 3000);
            </script>
        @endif

        @error('email')
            <p class="campoEmail">{{$message}}</p>
            <script>
                const campoEmail = document.querySelector('.campoEmail')
                
                setTimeout(() => {
                    campoEmail.style.display = 'none'
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
                {{-- <label for="email">Correo</label> --}}
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" id="email" @error('email') style="border: 1px solid red" @enderror placeholder="Correo" value="{{old('email')}}">
            </div>
            <div class="input">
                {{-- <label for="password">Contraseña</label> --}}
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" @error('password') style="border: 1px solid red" @enderror placeholder="Contraseña">
            </div>
        </div>

        <button class="btn-enviar" type="submit">Login</button>
        
        <div class="ultimos-datos">
            <div class="recordar">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Mantener activa la sesión</label>
            </div>
            <a href="#">Olvidastes tu contraseña?</a>
        </div>
    </form>
@endsection