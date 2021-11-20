<?php  
session_start();
require_once "../conections/BaseDatos.php";
$objeto =new Productos();


// ARRAY DEL FORMULARIO CREAR USUARIOS
 $obj=new usuarios();
 $dato=array(
     $_POST['idUsuario'],
     $_POST['nombre'],
     $_POST['email'],
     $_POST['fecha'],
     $_POST['enabled']
 );
  $obj->crearUsuario($dato);
  header("Location:../formUsuarios.php?upd=1&accion=creado")

    ?>