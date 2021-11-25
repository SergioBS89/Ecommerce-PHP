<!-- LOGIN DE INICIO DE SESIÓN -->
<?php 
	session_start();
	require_once "../conections/BaseDatos.php";

	// creo un nuevo objeto de la clase usuario para el login
	$obj= new usuarios();
    
	// Array que recoge los datos del formulario de index.php
	$datos=array(
	$_POST['usuario'],
	$_POST['email']
	);

	// Confirmacion de que el usuario es correcto
	echo $obj->loginUser($datos);
	$conectado=($obj->loginUser($datos));//Si conectado == 1 , el usuario es correcto

    //Actualizamos la fecha del usuario conectado
	$obj->lastAcces($datos);

// Mando de vuelta con el metodo get las varibales usuario (con su nombre) y el valor de conectado
header("Location:../index.php?usuario=$datos[0] & conectado=$conectado");

 ?>