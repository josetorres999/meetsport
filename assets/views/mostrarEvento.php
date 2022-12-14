<?php

    include_once("../conexion/conexion.php");
    session_start();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        header('Location: ../../index.php');
    }

    //Coge la info del evento
    $sql = "SELECT * FROM evento WHERE id=$id";
    $res = $conn->query($sql);
    $evento = mysqli_fetch_assoc($res);

    //Comprueba que el usuario no esté apuntado a más de 3 eventos
    $sql2 = "SELECT count(*) as total FROM usuario_apuntado WHERE id_usuario=".$_SESSION['id'];
    $res2 = $conn->query($sql2);
    $total = mysqli_fetch_assoc($res2)['total'];

    //Comprueba si el usuario ya esta apuntado a este evento
    $sql3 = "SELECT * FROM usuario_apuntado WHERE id_usuario=".$_SESSION['id'];
    $res3 = $conn->query($sql2);
    $apuntado = mysqli_num_rows($res3);

?>
<!--  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    HOLA SOY <?php echo $evento['id'];?>
    <?php
        if($_SESSION['id'] != $evento['id_usuario'] && $apuntado == 0){
    ?>
    <button id="apuntarse" <?php if($total == 3){echo 'disabled';} ?>>¡Apuntate a este evento!</button>
    <?php
        }else if($_SESSION['id'] != $evento['id_usuario'] && $apuntado == 1){
    ?>
    <button id="quitarse">Borrarse de este evento</button>
    <?php
        }else{
    ?>
    <button id="editar">Editar este evento</button>
    <button id="borrar">Borrar este evento</button>
    
    <?php

        }
    ?>

<a href="./chat.php?id="<?=$_GET['id']?>>Enlace al chat</a>

</body>
</html>

<script>

        $(document).ready(function(){
            $("#apuntarse").click(function(){
                var parametros = {
                    "id_usuario" : <?php echo $_SESSION['id'];?>,
                    "id_evento" : <?php echo $_GET['id'];?>
                }
                $.ajax({
                        data: parametros,
                        url: '../ajax/apuntarse.php',
                        type: 'post',
                        success: function(result){
                            console.log(result);
                            alert("Te has apuntado a este evento");
                        }
                    })
            })

            $("#borrarse").click(function(){
                var parametros = {
                    "id_usuario" : <?php echo $_SESSION['id'];?>,
                    "id_evento" : <?php echo $_GET['id'];?>
                }
                $.ajax({
                        data: parametros,
                        url: '../ajax/borrarse.php',
                        type: 'post',
                        success: function(result){
                            console.log(result);
                            alert("Te has apuntado a este evento");
                        }
                    })
            })
        })

</script>