<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de registro</title>
    <script type="text/javascript" src="js/code.jquery.com_jquery-3.7.1.min.js"></script>
    <link href="css/estilos3.css" rel="stylesheet">
</head>

<body>
<div>
<form action="http://localhost/infinity/indexP.php" method="post">
    <label for="usuario">Correo:</label>
    <input type="text" id="correo" name="correo" required>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>

    <button type="submit">Iniciar sesión</button>
    <a href="http://localhost/Infinity/">Regresar</a>
</form>
</div>


</body>


</html>