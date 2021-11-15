<?php  
session_start();
require_once "conections/BaseDatos.php";


 $objeto =new Productos();

 $datoCrear=array(
    $_POST['categoriaCrear'],
    $_POST['nombreCrear'],
    $_POST['costeCrear'],
    $_POST['precioCrear']  
);
$objeto->crearProducto($datoCrear);


    ?>