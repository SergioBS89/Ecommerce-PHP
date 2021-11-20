<?php 
	session_start();
	require_once "conections/BaseDatos.php";

	// Login del usuario
	$obj= new usuarios();

	$datos=array(
	$_POST['usuario'],
	$_POST['email']
	);
	// 

	echo $obj->loginUser($datos);
	$conectado=($obj->loginUser($datos));
	$obj->lastAcces($datos);
header("Location:index.php?usuario=$datos[0] & conectado=$conectado");

 ?>