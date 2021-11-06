<?php 
	session_start();
	require_once "conections/BaseDatos.php";
	require_once "conections/User.php";

	$obj= new usuarios();

	$datos=array(
	$_POST['usuario'],
	$_POST['email']
	);

	

	echo $obj->loginUser($datos);

 ?>