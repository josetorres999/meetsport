<?php

include_once("../conexion/conexion.php");


$id_usuario = $_SESSION['id'];
$mensaje = $_POST['mensaje'];
$id_evento = $_POST['id_evento'];

$sql = "INSERT INTO chat(id_evento, id_usuario, mensaje) VALUES ('$id_evento','$id_usuario','$mensaje')";
$ejecutar = $conexion->query($sql);

?>