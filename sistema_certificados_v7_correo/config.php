<?php
$conexion = new mysqli("localhost", "root", "", "certificados");
if ($conexion->connect_error) die("Error MySQL: ".$conexion->connect_error);
$conexion->set_charset("utf8mb4");
?>
