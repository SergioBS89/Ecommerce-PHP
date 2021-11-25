<?php  
session_start();
require_once "../conections/BaseDatos.php";

$obj=new usuarios();

//Array que recoge los datos enviados por POST
$dato=array(
    $_POST['idUsuario']
);

//Llamo a la funcion para eliminar el producto
$obj->eliminarUsuario($dato);

// Mando de vuelta con el metodo get las varibales upd con el id del usuario y la accion 'eliminado'
header("Location:../formUsuarios.php?upd=$dato[0]&accion=eliminado");
?>