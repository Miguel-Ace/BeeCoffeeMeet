<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Expediente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Un cliente solicita información</h1>
        
        <ul>
            <li>Usuario: {{$dato['usuario']}}</li>
            <li>Trabajo / remodelacion: {{$dato['asunto']}}</li>
            <li>Descripción: {{$dato['descripcion']}}</li>
            <li>Correo: {{$dato['correo']}}</li>
            <!-- Agrega más detalles según tus necesidades -->
        </ul>
        
    </div>
</body>
</html>
