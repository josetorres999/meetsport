<?php
require_once '../../config/parameters.php';

session_start();

unset($_SESSION['id']);

header('location:'.base_url.'/index.php');

?>