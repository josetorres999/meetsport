<?php

include_once("../conexion/conexion.php");


$id_usuario = $_SESSION['id'];
$sql = "SELECT * FROM usuarios WHERE id = $id_usuario";

$resDatos = mysqli_query($conn,$sql);
$datos = $resDatos->fetch_array(MYSQLI_ASSOC);



function mostrarDatos($datos){
    require_once '../views/perfil.php';
}

mostrarDatos($datos);
?>