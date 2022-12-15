<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initianl-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script>
        var from = null, start = 0;
        $(document).ready(function(){
            from = "Nombre";

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