<?php



include_once("../conexion/conexion.php");
include_once '../../config/parameters.php';
session_start();

$tipo = $_GET['tipo'];

if($tipo == 'contrasena'){
    $nueva_contrasena = $_POST['contrasena'];
    $id_usuario = $_SESSION['id'];
    $sql = "UPDATE `usuarios` SET `pass` = '$nueva_contrasena' WHERE `usuarios`.`id` = $id_usuario"; 

    $resDatos = mysqli_query($conn,$sql);
}else if($tipo == 'descripcion'){
    $nueva_descripcion = $_POST['descripcion'];
    $id_usuario = $_SESSION['id'];
    $sql = "UPDATE `usuarios` SET `descripcion` = '$nueva_descripcion' WHERE `usuarios`.`id` = $id_usuario";

    $resDatos = mysqli_query($conn,$sql);
}


header('location:'.base_url.'/assets/views/perfil.php');