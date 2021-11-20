<?php
session_start();
$rol=null;
$roles =null;
//Validacion de usuario
if($_SESSION['username']){}
else{
	header("location:index.php");
}

//CONEXION A LA BASE DE DATOS PARA CONOCER LOS USUARIOS SUPERADMIN

require_once "conections/BaseDatos.php";
			$c= new conectar();
			$conexion=$c->conexion();
			$sqlAdmin="SELECT FullName FROM user INNER JOIN setup ON user.UserID = setup.SuperAdmin";
			$super=mysqli_query($conexion,$sqlAdmin);
            while ($superAdmin=mysqli_fetch_row($super)){
                if($superAdmin[0] == $_SESSION['username']){
                $roles=2;
                }
            }
//CONDICIONAL PARA CREAR LA VARIABLE CON EL VALOR DE ROL


    if(isset($_SESSION['rol'])){

        if(($_SESSION['rol']==0) && ($roles==2)){
            $rol=2;//USUARIO SUPERADMIN
        }else{
            if($_SESSION['rol']==0){
                $rol =0;//USUARIO REGISTRADO
            }else{
                $rol=1;//USUARIOS AUTORIZADO
            }
        }
    }

?>

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

<?php
if(($rol!=1) && ($rol!=0)): ?>
    <?php echo "<button type='button' class=' btn btn-primary bot-acces' id='locationUsuarios'>Usuarios</button>" ?>
<?php endif ?>
<button type="button" class="btn btn-danger botBack" onclick="location.href='exit.php'">Volver</button>


</div>
<!-- ACCEDER A LA SECCION USUARIOS  -->
<script>
   var locationUsuariosPhp= document.getElementById('locationUsuarios')
   locationUsuariosPhp.addEventListener('click',()=>{
       location.href='views/usuarios.php'
   })
</script>
</body>
</html>
