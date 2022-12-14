<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/index.css" type="text/css">
    <link rel="stylesheet" href="../styles/form.css">
    <link rel="stylesheet" href="../styles/cabecera.css" type="text/css">
    <link rel="stylesheet" href="../styles/perfil.css" type="text/css">
    <title>Perfil</title>
</head>
<body>
    <?php
    require_once '../../config/parameters.php';
    require_once './cabecera.php';
    ?>
    <div class="perfil">
        <h1>Perfil</h1>
        <div class="contenido">
            <?php 
            require_once '../funciones/datos.php';
            $nom_us = $datos['nom_us'];
            $nombre = $datos['nombre'];
            $apellidos = $datos['apellidos'];
            $descripcion = $datos['descripcion'];
            $contrasena = $datos['pass'];
            echo "      <div class='lista'>
                        <li class='datosUs'>
                        <h4>Usuario</h4>
                        <ul>$nom_us</ul>
                        <h4>Nombre</h4>
                        <ul>$nombre</ul>
                        <h4>Apellidos</h4>
                        <ul>$apellidos</ul>
                        </li>
                        </div>
                        <div class='cajas'>
                        <h4>Contraseña</h4>
                        <input type='password' name='contrasena' id='contrasena' placeholder='hola' value='$contrasena'><button id='editarDes'>Editar</button>                     
                        <h4 class='descripcion'>Descripción</h4>                      
                        <textarea name='descripcion' id='descripcion' cols='30' rows='7' maxlength='300' placeholder='Máximo 300 caracteres'>$descripcion</textarea>
                        <button id='editarDes'>Editar</button>
                        </div>"
            ?>
            <div class="accion">
                <form action="../funciones/cerrarSesion.php">
                    <button class="cerrarSesion" id="cerrarS">Cerrar sesión</button>
                </form>
                <button class="borrarCuenta" id="eliminarC">Eliminar cuenta</button>
                <script type="text/javascript">
                    $('#cerrarS').click(function(){
                        console.log('hola')
                    })
                </script>
            </div>
        </div>

    </div>
 
</body>
</html>

