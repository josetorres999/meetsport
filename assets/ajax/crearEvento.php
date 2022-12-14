<?php

    include_once("../conexion/conexion.php");
    session_start();
    $array_devolver = [];


    $deporte = $_POST['deporte'];
    $n_personas = $_POST['personas'];
    $fecha = $_POST['fecha'];
    $titulo = $_POST['titulo'];
    $direccion = $_POST['direccion'];
    $descripcion = $_POST['descripcion'];
    $id_usuario = $_SESSION['id'];


    //Buscamos el evento por título 
    $sql = "SELECT * FROM evento WHERE titulo='$titulo'";
    $res = $conn->query($sql);

    if(mysqli_num_rows($res) > 0){
        $array_devolver['error'] = "Ya hay un evento con este título";
    }else{
        //No existe
        $sql = "INSERT INTO evento VALUES(NULL,'$deporte', '$n_personas', '$fecha', '$titulo', '$id_usuario','$direccion','$descripcion')";

        if($conn->query($sql) == TRUE){
            $array_devolver['ok'] = true;
            $array_devolver['redirect']= '../../index.php'; // cambiar
                
        }else{
            $array_devolver['error'] ="Ocurrió un error al insertar los datos";
        }
    }

    
        

    echo json_encode($array_devolver);

?>