<?php 
	require_once "conections/BaseDatos.php";

    // ARRAY DEL FORMULARIO MODIFICAR
    $objeto=new Productos();
    $datos=array(
        $_POST['idProducto'],
        $_POST['categori'],
        $_POST['categoria'],
        $_POST['nombre'],
        $_POST['coste'],
        $_POST['precio']  
    );
     $objeto->actualizarProducto($datos);
    
 

?>