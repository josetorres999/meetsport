<?php

session_start();

include_once("../conexion/conexion.php");

$id_evento = $_POST['id_evento'];

$consulta = "SELECT * FROM mensajes WHERE id_evento=$id_evento  ORDER BY id DESC";
$resMen = $conn->query($consulta);
while($r = mysqli_fetch_array($resMen)):
    $q = mysqli_query("SELECT * FROM usuarios WHERE id=".$r['id_usuario']);
    $ru = mysqli_fetch_array($q);
    
    if($r['id_usuario'] == $_SESSION['id']){
        $usuario = "Yo";
    }else{
        $usuario = $ru['nom_us'];
    }
    
?>
    <span style="color : #1c62c4;"><?=$usuario?></span>
    <span style="color : #848484;"><?=$row['mensaje']?></span>
    <span style="float : right;"><?=formatearFechaChat($r['fecha'])?></span>
<?php
endwhile;
?>