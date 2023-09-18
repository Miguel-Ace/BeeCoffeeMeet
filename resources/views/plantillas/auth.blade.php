<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Café</title>
    <script src="https://kit.fontawesome.com/cd197f289d.js" crossorigin="anonymous"></script>
    @vite(['resources/sass/auth.scss'])
</head>
<body>
    <div class="container">
        <div class="right">
            @yield('formulario')
        </div>
    </div>
</body>
</html>