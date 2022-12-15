<?php

    include_once("../conexion/conexion.php");

    $id_evento = $_POST['id_evento'];

    $sql = "DELETE FROM `evento` WHERE `evento`.`id` = $id_evento";
    $res = $conn->query($sql);

    $array_result = [];

    if($res){
        $array_result['ok'] = "Ha ido bien";
    }else{
        $array_result['error'] = "Error al borrar los datos";
    }

    echo json_encode($array_result);
?>