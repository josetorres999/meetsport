<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/form.css" type="text/css"/>
    <link rel="stylesheet" href="../styles/index.css" type="text/css"/>
    <title>Registrarse</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <?php

    session_start();

    if(isset($_SESSION['id'])){
            header("Location: ../../index.php");
    }

    ?>
</head>
<body>
    <div class="form">
        
        <form action="" method="post" class="form">
            <img src="../img/logo-placeholder-image.png" alt="logo" style="height:15vh; width:15vh;">
            <input type="file" id="regImg">
            <input type="text" id="regUs"  placeholder="Nombre de usuario...">
            <input type="text" id="regNom" placeholder="Nombre...">
            <input type="text" id="regAp" placeholder="Apellidos...">
            <input type="text" id="regCor" placeholder="Correo electrónico...">
            <input type="password" id="regPass" placeholder="Contraseña...">
            <input type="password" id="regRepPass" placeholder="Repetir la contraseña...">
            <textarea id="regDesc" placeholder="Preséntate tu mismo..."></textarea>
            <button type="button" id="botReg" class="submit">Crear cuenta</button>
            <a href="login.php">¿Ya tienes cuenta?Pulsa aqui para iniciar sesion</a>
            <div class="msg_error" class="alert alert-danger" role="alert" style="display: none">
                <ul class = "erroresForm">
                    <!-- Aqui se mostraran los errores -->
                </ul>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#botReg").click(function(){
                var valido = true;
                var errores = [];
                var cList = $('.erroresForm');
                cList.html("");


                //Recoger datos
                var usuario = $.trim($("#regUs").val());
                var pass = $.trim($("#regPass").val());
                var repPass = $.trim($("#regRepPass").val());
                var nombre = $.trim($("#regNom").val());
                var apell = $.trim($("#regAp").val());
                var correo = $.trim($("#regCor").val());
                var descripcion = $.trim($("#regDesc").val());


                //Validar formulario
                if(usuario=="" || pass=="" || repPass=="" || nombre=="" || apell=="" || correo==""){
                    errores.push("Debes rellenar todos los campos obligatorios *");

                    valido = false;
                }else{
                    let regexLetra = /^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/; //Comprueba que tenga solo letras o espacios
                    let regexPas = /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/; //Comprueba que la contraseña tenga numero, letra minusucla y mayuscula
                    let regexUs = /^[a-z0-9_-]{3,16}$/;//Coprueba que tenga tenga numeros o letras 
                    let regexCor = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/; //Compurbea que este bien escrito el correo

                    if(usuario.length > 20){
                        errores.push("El nombre de usuario debe contener como máximo 20 caracteres");
                        valido = false;
                    }else if(!regexUs.test(usuario)){
                        errores.push("El nombre de usuario solo puede contener numeros,letras, _ o -");
                        valido = false;
                    }

                    if(pass.length < 8 || pass.length > 15){
                        errores.push("La contraseña debe contener como mínimo 8 caracteres y 15 como máximo");
                        valido = false;
                    }else if(!regexPas.test(pass)){
                        errores.push("La contraseña debe tener 1 minúscula, 1 mayúscula y un número");
                        valido = false;
                    }
                    
                    if(pass != repPass){
                        errores.push("Las contraseñas no coinciden");
                        valido = false;
                    }

                    if(nombre.length > 25){
                        errores.push("El nombre no puede contener más de 25 caracteres");
                        valido = false;
                    }else if(!regexLetra.test(nombre)){
                        errores.push("El nombre solo puede contener letras");
                        valido = false;
                    }

                    if(apell.length > 25){
                        errores.push("Lo apellidos no pueden contener más de 25 caracteres");
                        valido = false;
                    }else if(!regexLetra.test(apell)){
                        errores.push("Los apellidos solo pueden contener letras");
                        valido = false;
                    }

                    if(correo.length > 50){
                        errores.push("El correo no puede contener mas de 50 caracteres");
                        valido = false;
                    }else if(!regexCor.test(correo)){
                        errores.push("El correo no es válido");
                        valido = false;
                    }


                }

                if(!valido){
                    $(".msg_error").show("slow");
                    $(".msg_error").css("background-color","red");
                    $.each(errores, function(i){
                        var li = $('<li/>').
                                    addClass('li-error')
                                    .text(errores[i])
                                    .appendTo(cList);
                    })
                }else{
                    var parametros  = {
                        "correo" : correo,
                        "pass" : pass,
                        "usuario" : usuario,
                        "nombre" : nombre,
                        "apellido" : apell,
                        "desc" : descripcion,
                    }
                    $.ajax({
                        data: parametros,
                        url: '../funciones/registroUsuario.php',
                        type: 'post',
                        success: function(result){
                            console.log(result);
                            result = JSON.parse(result);
                            if(result.ok){
                                $(".msg_error").show("slow");
                                $(".msg_error").css("background-color","green");
                                var li = $('<li/>').
                                    addClass('li-error')
                                    .text("Usuario creado")
                                    .appendTo(cList);
                                window.location.href = result.redirect;
                            }
                            else if(result.error != ""){
                                
                                $(".msg_error").show("slow");
                                $(".msg_error").css("background-color","red");
                                var li = $('<li/>').
                                    addClass('li-error')
                                    .text(result.error)
                                    .appendTo(cList);
                            }
                        }
                    })
                }
            })
        });
    </script>
</body>
</html>