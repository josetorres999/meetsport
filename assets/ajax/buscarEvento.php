<?php

    $texto = isset($_POST['texto']) ? $_POST['texto'] ? "";

    $deporte = isset($_POST['deporte']) ? $_POST['deporte'] ? 0;

    $cadena = "SELECT * FROM evento";

    if(!empty($texto) && $deporte == 0){
        $cadena = $cadena." WHERE titulo LIKE %$texto%";
    }else if(empty($texto) && $deporte != 0){
        $cadena = $cadena." WHERE deporte=$deporte";
    }else if(!empty($texto) && $deporte!=0){
        $cadena = $cadena." WHERE deporte=$deporte AND titulo LIKE %$texto%";
    }
?>