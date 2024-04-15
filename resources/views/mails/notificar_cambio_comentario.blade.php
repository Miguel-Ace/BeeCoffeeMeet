<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación quitar comentario</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }

        h1 {
            color: #030334;
        }

        p {
            color: #333;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: #fff;
            background-color: #030334;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Quitar comentario</h1>
        <p>¡Hola!</p>
        <p>{{$dato['mensaje']}}</p>
        <p>Gracias por tu atención.</p>
    </div>

</body>
</html>
