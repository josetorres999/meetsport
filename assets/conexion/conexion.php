<?php

  // producción

/*   $host_name = 'sql109.epizy.com';
  $database = 'epiz_33185148_meetsport';
  $user_name = 'epiz_33185148';
  $password = 'VnBFUcaP3BEwSE'; */

  // local


  $host_name = 'localhost';
  $database = 'application';
  $user_name = 'root';
  $password = '';

  $conn = mysqli_connect($host_name, $user_name, $password, $database);

  if (mysqli_connect_errno()) {
    die('<p>Error al conectar con servidor MySQL: '. $conn->connect_error .'</p>');
  }

  function formatearFechaChat($fecha){
    return date('g:i a', strtotime($fecha));
  }
?>