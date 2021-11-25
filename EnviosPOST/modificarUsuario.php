<?php  
session_start();
require_once "../conections/BaseDatos.php";

$obj=new usuarios();

//Array que recoge los datos enviados por POST
$dato=array(
    $_POST['idUsuario'],
    $_POST['nombre'],
    $_POST['email'],
    $_POST['fecha'],
    $_POST['enabled']
);

//Llamo a la funcion para acturlizar usuario
$obj->actualizarUsuario($dato);

// Mando de vuelta con el metodo get las varibales upd con el id del usuario y la accion 'modificado'
header("Location:../formUsuarios.php?upd=$dato[0]&accion=modificado");

?>