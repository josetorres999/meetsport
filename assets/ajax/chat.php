<?php

    $result = array();
    $mensaje = $_POST['mensaje'];
    $id_usuario = $_POST['id_usuario'];
    $id_evento = $_POST['id_evento'];

    if(!empty($mensaje) && !empty($nombre)){
        $sql = "INSERT INTO mensajes ('id_evento','id_usuario','mensaje') VALUES($id_evento,$id_usuario,$mensaje)";
    }

?>