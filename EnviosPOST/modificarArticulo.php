<?php 
	require_once "../conections/BaseDatos.php";

    // ARRAY DEL FORMULARIO MODIFICAR ARTICULOS
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
     header("Location:../formArticulos.php?upd=$datos[0]&accion=modificado")
    
?>