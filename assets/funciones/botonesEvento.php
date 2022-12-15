<?php
include_once("../conexion/conexion.php");
include_once '../../config/parameters.php';

session_start();


$boton = $_GET['boton'];
$id_usuario = $_SESSION['id'];

function eliminarse_de_evento(){
    $sql = "DELETE FROM `usuario_apuntado` WHERE `usuario_apuntado`.`id` = $id_usuario";
    $res = $conn->query($sql);
    header("location:".base_ulr."/assets/views/mostrarEvento.php?id=$id_evento");
}







if($boton == 'editar'){

}else if($boton == "borrarU"){
    eliminarse_de_evento();
}else if($boton == "borrar"){

}else if($boton == "apuntar"){

}



