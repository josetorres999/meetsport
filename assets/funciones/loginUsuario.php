<?php

    include_once("../conexion/conexion.php");
    session_start();

    $correo = strtolower($_POST['correo']);
    $pass = $_POST['pass'];
    $array_devolver = [];

    //Buscamos el usuario
    $sql = "SELECT * FROM usuarios WHERE correo='$correo'";
    $sql2 = "SELECT * FROM usuarios WHERE nom_us='$correo'";

    $resCorreo = mysqli_query($conn, $sql);
    $resUsuario = mysqli_query($conn, $sql2);

    if(mysqli_num_rows($resUsuario) == 0 && mysqli_num_rows($resCorreo) == 0){
        //No existe
        $array_devolver['error']="El usuario no existe.";
    }else{
        //Existe
        $usuario = $resUsuario->fetch_array();

        if($usuario['pass'] == $_POST['pass']){
            $_SESSION['id'] = $usuario['id'];
            $array_devolver['redirect']= '../../index.php';  
            $array_devolver['ok']= true;
        }else{
            $array_devolver['error']="El usuario y la contraseña no coinciden.";
        }

    }

    echo json_encode($array_devolver);

?>