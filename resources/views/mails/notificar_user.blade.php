<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esperando Aprobación de Cuenta</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        <h1>Bienvenido a CupSpot</h1>
        <p>Estimado {{$dato}}, Gracias por registrarte. Actualmente estamos revisando tu cuenta. Por favor, espera pacientemente a que el administrador apruebe tu solicitud.</p>
        <p>Mientras tanto, si tienes alguna pregunta, no dudes en ponerte en contacto con nosotros.</p>
    </div>

</body>
</html>

