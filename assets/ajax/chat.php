<?php
    include_once("../conexion/conexion.php");


    //Escribir mensaje
    $result = array();
    $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : null;
    $nombre =isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $id_evento = isset($_POST['id_evento']) ? $_POST['id_evento'] : null;

    if(!empty($mensaje) && !empty($nombre) && !empty($id_evento)){
        $sql = "INSERT INTO mensajes (id_evento, nombre,mensaje) VALUES($id_evento,'$nombre','$mensaje')";
        $result['send_status'] = $conn->query($sql);
    }

    //Mostrar mensajes
    $id_evento = isset($_GET['id']) ? $_GET['id'] : 0;
    $start = isset($_GET['start']) ? $_GET['start'] : 0;

    $todos = $conn->query("SELECT * FROM mensajes WHERE id_evento=".$id_evento." AND id > ".$start);
    while($row = $todos->fetch_assoc()){
        $result['todos'][] = $row;
    }

    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    

    echo json_encode($result);

?>