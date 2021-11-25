<!-- CODIGO PHP -->
<?php
session_start();
//inicio de las varibales para definir el rol del usuario
$rol=null;
$roles =null;

//Validacion de usuario
if(($_SESSION['username'])&&($_SESSION['email'])){}
else{
	header("location:index.php");
}

// Conexion a la base de datos para conocer los usuarios superadmin
require_once "conections/BaseDatos.php";
$objet=new usuarios();
$super=($objet->superAdmin());
while ($superAdmin=mysqli_fetch_row($super)){
	  if($superAdmin[0] == $_SESSION['username']){
	  $roles=2;
	  }
}

// Condicion para crear la variable con el valor del rol del usuario
    if(isset($_SESSION['rol'])){
        if(($_SESSION['rol']==0) && ($roles==2)){
            $rol=2;//usuario superadmin
        }else{
            if($_SESSION['rol']==0){
                $rol =0;//usuario registrado
            }else{
                $rol=1;//usuario autorizado
            }
        }
    }
?>

<!-- CODIGO HTML -->

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/estilos.css">
        <title>Acesso gestion comercio</title>
    </head>
    <body>
        <div class="container container-acceso">
            <div class="header-name">Acceso de la gestión</div>    
            <button type="button" class="btn btn-primary bot-acces" onclick="location.href='views/articulos.php'">Articulos</button>
            <!--Muestro el boton usuarios dependiendo del rol-->
            <?php
            if(($rol!=1) && ($rol!=0)): ?>
                <button type="button" onclick="location.href='views/usuarios.php'" class="btn btn-primary bot-acces botonOculto <?php echo "botonVisto";?>">Usuarios</button>
            <?php endif ?>
            <!-- si volvemos a index.php, se destruye la sesion mediante el archivo exit.php -->
            <button type="button" class="btn btn-danger botBack" onclick="location.href='validation/exit.php'">Volver</button>   
        </div>
    </body>
</html>
