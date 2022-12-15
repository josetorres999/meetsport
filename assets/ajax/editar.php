<?php

    include_once("../conexion/conexion.php");

    $id_evento = $_POST['id_evento'];
    $titulo = $_POST['titulo'];
    $direccion = $_POST['direccion'];
    $descripcion = $_POST['descripcion'];

    $sql = "UPDATE `evento` SET `titulo` = '$titulo', `direccion` = '$direccion', `descripcion` = '$descripcion' WHERE `evento`.`id` = $id_evento;";
    $res = $conn->query($sql);

    $array_result = [];

    if($res){
        $array_result['ok'] = "Ha ido bien";
    }else{
        $array_result['error'] = "Error al introducir los datos";
    }

    echo json_encode($array_result);
?>