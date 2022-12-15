<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/index.js"></script>
    <link rel="stylesheet" href="assets/styles/cabecera.css" type="text/css">
    <link rel="stylesheet" href="assets/styles/evento.css" type="text/css">
    <link rel="stylesheet" href="assets/styles/index.css" type="text/css">

    <?php
        
        include_once('./assets/conexion/conexion.php');
        session_start();

        if(!$_SESSION['id']){
            header("Location: assets/views/login.php");
        }
    ?>

</head>
<body>
    <?php
    require_once('./config/parameters.php');
    require_once('./assets/views/cabecera.php');
    ?>

    <!-----------------Cabecera-------------------->

    

    <?php
            
            $sql = "SELECT * FROM evento ";
            $resultado = $conn->query($sql);


                echo '<div id="padreEventos">';
                while($fila = $resultado->fetch_assoc()){
                    $sql2 = "SELECT * FROM deporte WHERE id=".$fila['deporte'];
                    $imagen = $conn->query($sql2)->fetch_assoc()['imagen'];
                    echo '<div class="evento">';
                    echo '<img src="assets/img/'.$imagen.'">';
                    echo '<div class="infoEvento">';
                    echo '<a href="./assets/views/mostrar-evento.php?id='.$fila['id'].'"><p class="nomEv">'.$fila['titulo'].'</p></a>';
                    echo '<p>'.$fila['fecha'].'</p>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
    ?>

</body>
</html>