<?php

    include_once("../conexion/conexion.php");

    $consulta = "SELECT * FROM deporte";
    $resDep = $conn->query($consulta);

    
    ?>


<!DOCTYPE html>
<html lang="en">
<head>   
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOWzafxQET0zutuevXzmbtgE4_amragNs&libraries=places"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/index.css" type="text/css"></link>
    <link rel="stylesheet" href="../styles/form.css">
    <title>Crear Evento</title>
</head>
    
    <div class="form">
        <form method="post" class="form" id="formEvento">
            <?php
            $fecha_actual = date('Y-m-d');
            $fecha_maxima = date("Y-m-d",strtotime($fecha_actual."+ 1 Year"));
            ?>
            <input type="text" name="titulo" id="titulo" placeholder="Título" maxlength="20">
            <input type="number" name="n_personas" id="n_personas" min="1" max="21" placeholder="Nº de personas">
            <select name="deporte" id="deporte">
                <option value=0>Selecciona un deporte</option>
                <?php while($row = mysqli_fetch_array($resDep)): ?>
                <option value=<?= $row['id'] ?>><?=$row['nombre']?></option>
                <?php endwhile; ?>
            </select>
            <input type="date" name="fecha" id="fecha" min=<?php echo $fecha_actual?> max="<?php echo $fecha_maxima?>">
            <input type="text" name="direccion" id="direccion">
            <textarea name="descripcion" id="descripcion" cols="30" rows="7" maxlength="300" placeholder="Descripcion dedl evento"></textarea>
            <input type="submit" value="Crear">
            <div class="msg_error" class="alert alert-danger" role="alert" style="display: none">
                <ul class = "erroresForm">
                    <!-- Aqui se mostraran los errores -->
                </ul>
            </div>
        </form>
    </div>


    <script>
        $(document).ready(function(){
            $("#formEvento").submit(function(event){
                event.preventDefault();

                var valido = true;
                var errores = [];
                var cList = $(".erroresForm");
                cList.html("");
                $(".msg_error").hide("slow");


                var autocomplete = new google.maps.places.Autocomplete((document.getElementById("direccion")),{
                    types:['geocode']
                })

                var deporte = $( "#deporte option:selected" ).val();
                var personas = $("#n_personas").val();
                var fecha = $.trim($("#fecha").val());
                var titulo = $.trim($("#titulo").val());
                var direccion = $.trim($("#direccion").val());
                var descripcion = $.trim($("#descripcion").val());

                if(deporte=="0" || fecha=="" || titulo=="" || direccion=="" || descripcion == "" || n_personas == ""){
                    errores.push("Debes rellenar todos los campos, son obligatorios");

                    valido = false;
                }

                if(valido == true){
                    var parametros  = {
                        "deporte" : deporte,
                        "personas" : personas,
                        "fecha" : fecha,
                        "titulo" : titulo,
                        "direccion" : direccion,
                        "descripcion" : descripcion
                    }
                    $.ajax({
                        data: parametros,
                        url: '../ajax/crearEvento.php',
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
                                var li = $('<li/>')
                                    .addClass('li-error')
                                    .text(result.error)
                                    .appendTo(cList);
                            }
                        }
                    })
                }else{
                    $.each(errores, function(i){
                        var li = $('<li/>').
                                    addClass('li-error')
                                    .text(errores[i])
                                    .appendTo(cList);
                    })
                }
                $(".msg_error").show("slow");

            })
        });
    </script>

</body>
</html>