<?php

    include_once("../conexion/conexion.php");

    $id_usuario = $_POST['id_usuario'];
    $id_evento = $_POST['id_evento'];

    $sql = "INSERT INTO usuario_apuntado VALUES(NULL,$id_usuario,$id_evento)";
    $res = $conn->query($sql);

    $array_result = [];

    if($res){
        $array_result['ok'] = "Ha ido bien";
    }else{
        $array_result['error'] = "Error al introducir los datos";
    }

    echo json_encode($array_result);
?>