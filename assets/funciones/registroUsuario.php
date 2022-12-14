<?php

    include_once("../conexion/conexion.php");
    session_start();


    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $descripcion = $_POST['desc'];

    $array_result = [];
    $existe = false;

    //Buscamos el usuario tanto por correo 
    $sql = "SELECT * FROM usuarios WHERE correo='$correo'";

    $sql2 = "SELECT * FROM usuarios WHERE nom_us='$usuario'";

    


    $resCor = mysqli_query($conn, $sql);
    $resUsuario = mysqli_query($conn, $sql2);

    if(mysqli_num_rows($resUsuario) > 0){
        //Existe el correo
        $array_devolver['error']="Este nombre de usuario ya esta en uso";
        $existe = true;
    }else if(mysqli_num_rows($resCor) > 0){
            $array_devolver['error'] = "Este correo ya está en uso";
            $existe = true;
    }
    
    
    if($existe==false){
        //No existe
        $sql = "INSERT INTO usuarios VALUES(NULL,'$correo', '$pass', '$usuario', '$nombre', '$apellido','$descripcion')";

        
        if($conn->query($sql) == TRUE){
            $array_devolver['ok'] = true;
            $array_devolver['redirect']= './login.php'; 
            
            $sql = "SELECT id FROM usuarios WHERE correo='$correo'";
            $res = mysqli_query($conn, $sql);
        }else{
            $array_devolver['error'] =="Ocurrió un error al insertar los datos";
        }
    }

    echo json_encode($array_devolver);

?>