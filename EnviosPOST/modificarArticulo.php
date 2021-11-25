<?php 
session_start();
require_once "../conections/BaseDatos.php";

$objeto=new Productos();

//Array que recoge los datos enviados por POST
$datos=array(
    $_POST['idProducto'],
    $_POST['categori'],
    $_POST['categoria'],
    $_POST['nombre'],
    $_POST['coste'],
    $_POST['precio']  
);

//Llamo a la funcion para acturlizar producto
$objeto->actualizarProducto($datos);

// Mando de vuelta con el metodo get las varibales upd con el id del usuario y la accion 'modificado'
 header("Location:../formArticulos.php?upd=$datos[0]&accion=modificado");
    
?>