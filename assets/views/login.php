<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/form.css" type="text/css"/>
    <link rel="stylesheet" href="../styles/index.css" type="text/css"/>
    <title>Login</title>
    <?php

    session_start();

    if(isset($_SESSION['id'])){
            header("Location: ../../index.php");
    }
    
    ?>

    
</head>
<body>
    <div class="form" action>
        
        <form action="" method="post" class="form">
            <img src="../img/logo-placeholder-image.png" alt="logo" style="height:15vh; width:15vh;">
            <p class = "texto">Bienvenido a MeetSport</p>
            <input type="text" id="logUs" placeholder="Nombre de usuario...">
            <input type="password" id="logPass" placeholder="Contraseña...">
            <button type="button" id="botLog" class="submit">Iniciar sesión</button>
            <a href="registro.php" >¿No tienes cuenta?Pulsa aqui para registrarte</a>
            <div class="msg_error" class="alert alert-danger" role="alert" style="display: none">
                <ul class = "erroresForm">
                    <!-- Aqui se mostraran los errores -->
                </ul>
            </div>
        </form>
    </div>

    <script type="text/javascript">

        $(document).ready(function(){
            $("#botLog").click(function(){
                var valido = true;
                var errores = [];

                var usuario = $("#logUs").val();
                var pass = $("#logPass").val();
                
                var cList = $('.erroresForm');
                cList.html("");
                cList.hide("slow");

                //Para validar el formulario antes de enviarlo
                if(usuario == ""){
                    errores.push("Debes rellenar el nombre de usuario");
                    valido = false;
                }

                if(pass == ""){
                    errores.push("Debes rellenar la contraseña");
                    valido = false;
                }

                if(valido == true){
                    var parametros  = {
                        "correo" : usuario,
                        "pass" : pass,
                    }
                    $.ajax({
                        data: parametros,
                        url: '../ajax/loginUsuario.php',
                        type: 'post',
                        success: function(result){
                            console.log(result);
                            result = JSON.parse(result);
                            if(result.ok){
                                $(".msg_error").show("slow");
                                var li = $('<li/>').
                                    addClass('li-error')
                                    .text("Iniciando sesión")
                                    .appendTo(cList);
                                    window.location.href = result.redirect;
                            }else if(result.error != ""){
                                $(".msg_error").show("slow");
                                var li = $('<li/>').
                                    addClass('li-error')
                                    .text(result.error)
                                    .appendTo(cList);
                             
                            }
                        }
                    })
                }else{
                    $(".msg_error").show("slow");
                    $.each(errores, function(i){
                        var li = $('<li/>').
                                    addClass('li-error')
                                    .text(errores[i])
                                    .appendTo(cList);
                    })
                }
            });
        });



    </script>


</body>
</html>