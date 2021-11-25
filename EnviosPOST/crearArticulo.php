<?php  
session_start();
require_once "../conections/BaseDatos.php";


 $objeto =new Productos();

 //Array que recoge los datos enviados por POST
 $datoCrear=array(
     $_POST['idProducto'],
    $_POST['categoria'],
    $_POST['nombre'],
    $_POST['coste'],
    $_POST['precio']  
);
//Llamo a la funcion para crear el producto
$objeto->crearProducto($datoCrear);

// Mando de vuelta con el metodo get las varibales upd con el id del producto y la accion 'creado'
header("Location:../formArticulos.php?upd=1&accion=creado");

    ?>