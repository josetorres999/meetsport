<?php

    include_once("../conexion/conexion.php");
    session_start();


    $deporte = $_POST['deporte'];
    $n_personas = $_POST['n_personas'];
    $fecha = $_POST['fecha'];
    $titulo = $_POST['titulo'];
    $direccion = $_POST['direccion'];
    $descripcion = $_POST['descripcion'];

    $array_result = [];
    $existe = false;

    //Buscamos el evento por título 
    $sql = "SELECT * FROM evento WHERE titulo='$titulo'";

    


    $resTitulo = mysqli_query($conn, $sql);

    if(mysqli_num_rows($resTitulo) > 0){
        //Existe el correo
        $array_devolver['error']="Este titulo de evento ya esta en uso";
        $existe = true;
    }
    
    
    if($existe==false){
        //No existe
        $sql = "INSERT INTO evento VALUES(NULL,'$deporte', '$n_personas', '$fecha', '$titulo', '$id_usuario','$direccion','$descripcion')";

        
        if($conn->query($sql) == TRUE){
            $array_devolver['ok'] = true;
            $array_devolver['redirect']= '../../index.php'; // cambiar
            
        }else{
            $array_devolver['error'] =="Ocurrió un error al insertar los datos";
        }
    }

    echo json_encode($array_devolver);

?>