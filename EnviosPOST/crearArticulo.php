<?php  
session_start();
require_once "../conections/BaseDatos.php";


 $objeto =new Productos();

 $datoCrear=array(
     $_POST['idProducto'],
    $_POST['categoria'],
    $_POST['nombre'],
    $_POST['coste'],
    $_POST['precio']  
);
$objeto->crearProducto($datoCrear);
header("Location:../formArticulos.php?upd=1&accion=creado")

    ?>