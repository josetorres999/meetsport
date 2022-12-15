<head>
<link rel="stylesheet" href="../styles/index.css" type="text/css">
<link rel="stylesheet" href="../styles/cabecera.css" type="text/css">
<link rel="stylesheet" href="../styles/evento.css" type="text/css">
</head>

<?php

require_once '../../config/parameters.php';
session_start();
include_once("../conexion/conexion.php");
include_once '../views/cabecera.php';
$deporte = $_POST['deporte'];

if($deporte == '0' ){
    header("location:".base_url."/index.php");
}else{

    $sql = "SELECT * FROM evento WHERE deporte = $deporte";
    $resultado = $conn->query($sql);
    if(mysqli_num_rows($resultado) == 0){
        echo "<h1>Lo sentimos pero en estos momentos no hay eventos disponibles</h1>";
    }else{
        echo '    <h1>Eventos disponibles</h1>

        <div id="padreEventos">';
        while($fila = $resultado->fetch_assoc()){
            $sql2 = "SELECT * FROM deporte WHERE id=".$fila['deporte'];
            $imagen = $conn->query($sql2)->fetch_assoc()['imagen'];
               echo '<div class="evento">';
               echo '<img src="../img/'.$imagen.'">';
               echo '<div class="infoEvento">';
               echo '<a href="../views/mostrar-evento.php?id='.$fila['id'].'"><p class="nomEv">'.$fila['titulo'].'</p></a>';
               echo '<p>'.$fila['fecha'].'</p>';
               echo '</div>';
               echo '</div>';
        }
        echo '</div>';
    }

}


?>