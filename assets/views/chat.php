<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        include_once("../conexion/conexion.php");

        if(!$_SESSION['id']){
            header("Location: assets/views/login.php");
        }

        $consulta = "SELECT nom_us FROM usuarios WHERE id=".$_SESSION['id'];
        $resnombre = $conn->query($consulta);
        $nombre = $resnombre->fetch_assoc()['nom_us'];
        


    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initianl-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script>
        var from = null, start = 0, url="../ajax/chat.php";
        $(document).ready(function(){

            cargarMensajes();

            $('form').submit(function(e){
                e.preventDefault();
                parametros = {
                    "mensaje" : $('#mensaje').val(),
                    "nombre" : '<?=$nombre?>',
                    "id_evento" : <?=$_GET['id']?>
                }
                $.post(url,parametros);
                $('#mensaje').val("");
                return false;
            })

            function cargarMensajes(){
                $.get(url+"?id="+<?=$_GET['id']?>+"&start="+start, function(result){
                    if(result.todos){
                        result.todos.forEach(item =>{
                            start = item.id;
                            $('#mensajes').append(renderMensaje(item));
                        })
                        $('#mensajes').animate({scrollTop: $('#mensajes')[0].scrollHeight});
                    }
                    cargarMensajes();
                })
            }



            function renderMensaje(item){
                let time = new Date(item.fecha)
                time = `${time.getHours()}:${time.getMinutes()}`
                return '<div class = "msg"><p>'+item.nombre+'</p>'+item.mensaje+'<span>'+time+'</span></div>';
            }
            

        })
    </script>
    <title>Chat</title>
    <style>
        body{
            margin:0;
            overflow: hidden;
            
        }
        #mensajes{
            height : 88vh;
            overflow-x:hidden;
            padding: 10px;
        }
        form{
            display: flex;
        }
        input{
            font-size:1.2rem;
            padding: 10px;
            margin: 10px 5px;
            appearance: none;
            -webkit-appearance: none;
            border: 1px solid #ccc;
            border-radius:5px;
        }
        #mensaje{
            flex:2;
        }
        .msg{
            background-color: #dcf8dc;
            padding: 5px 10px;
            border-radius: 5px;
            margin-bottom: 8px;
            width: fit-content;
        }
        .msg p{
            margin: 0;
            font-weight: bold;
        }
        .msg span{
            font-size: 0.7rem;
            margin-left: 15px;
        }
    </style>
</head>
<body>
    <div id="mensajes"></div>
        <form>
            <input type="text" name="" id="mensaje" autocomplete="off" autofocus placeholder="Escribe algo...">
            <input type="submit">
        </form>
</body>
</html>