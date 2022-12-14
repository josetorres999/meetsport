<?php
    include_once "../conexion.php";

    session_start();

    if(isset($_GET['id_evento'])){
        $id = $_GET['evento'];
    }else{
        echo "<alert>Se ha producido un error</alert>";
        header('Location: ../../index.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHAT</title>
    <link rel="stylesheet" href="../styles/chat.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="contenedor">
        <div id="caja-chat">
            <div id="chat">
                <div id="datos-chat">
                </div>
            </div>
        </div>
        <form method="POST" action="chat.php">
            <input type="text" name="nombre" id="" placeholder="Ingresa tu nombre">
            <textarea name="mensaje" id="mensaje" placeholder="ingresa tu nombre" onkeyup="comprobarEnviar(event)"></textarea>
        </form>
    </div>
</body>
</html>

<script>


    function comprobarEnviar(e){
        let mensaje = $("#mensaje").val();
        if(mensaje.length != 0 && e.which==13){
            enviarMensaje(mensaje);
        }
    }

    function enviar_mensaje(mensaje){
        var parametros = {
            "mensaje" : mensaje,
            "id_evento" : <?= $_GET['id_evento'] ?>,
        };

        $.ajax({
            type : "post",
            url : "../ajax/enviar.php",
            data : parametros,
            succes:function(response){
                $("#mensaje").val("");
                recargarMensajes();
            }
        })
    }


    function recargarMensajes(){
        $.ajax({
            url : "../ajax/recargarMensajes.php",
            type: "post",
            data: {"id_evento" : <?= $_GET['id_evento'] ?>},
            succes:function(response){
                $("#datos-chat").html(response);
            }
        });
    }

    setInterval("recargarMensajes()",200);

</script>