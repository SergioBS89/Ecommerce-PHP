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
	$obj->lastAcces($datos);


 ?>