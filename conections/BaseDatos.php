<?php 

// Clase para crear la conexion a la base de datos
class conectar{
	private $servidor="localhost";
	private $usuario="root";
	private $password="";
	private $bd="pac3_daw";
	public function conexion(){
		$conexion=mysqli_connect($this->servidor,
								 $this->usuario,
								 $this->password,
								 $this->bd);
		return $conexion;
	}
}
 ?>



<!-- Clase usuarios para todos las funciones con la base de datos -->
 <?php
class usuarios{
	
	// Funcion para el login de usuario
	public function loginUser($datos){
		$c=new conectar();
		$conexion=$c->conexion();
        
		//datos para usar las varibles de session
		$_SESSION['rol']=self::rol($datos);			
		$_SESSION['username']=$datos[0];
		$_SESSION['email']=$datos[1];	

		$sql="SELECT * from user where FullName='$datos[0]'	and Email='$datos[1]'";
		$result=mysqli_query($conexion,$sql);
		if(mysqli_num_rows($result) > 0){			
			return 1;
		}else{
			return 0;
		}
	}
	
	// Funcion para obtener el valor enabled de los registros
	public function rol($datos){
		$c=new conectar();
		$conexion=$c->conexion();
		$sql="SELECT Enabled from user where FullName='$datos[0]'and Email='$datos[1]'"; 
		$result=mysqli_query($conexion,$sql);
		return mysqli_fetch_row($result)[0];
		}	

    // Funcion que devuelve los usuarios superadmin
	public function superAdmin(){
		$c= new conectar();
        $conexion=$c->conexion();
        $sqlAdmin="SELECT FullName FROM user INNER JOIN setup ON user.UserID = setup.SuperAdmin";
         return mysqli_query($conexion,$sqlAdmin);
		}
    
	// Funcion que actualiza la fecha de los usuarios
	public function lastAcces($datos){
		$con=new conectar();
		$conexion=$con->conexion();
		$fecha="UPDATE user SET LastAccess = now() WHERE Email='$datos[1]'";
	    return mysqli_query($conexion,$fecha);			
		}
	
	// Funcion que obtiene el numero de usuarios en la base de datos
	public function obtenerRegistrosTotalesUsuarios(){
		$c=new conectar();
		$conexion=$c->conexion();
		$sqlTotalRegistros="SELECT * FROM user";
		$result=mysqli_query($conexion,$sqlTotalRegistros);
		$numFilas=mysqli_num_rows($result);
		return $numFilas;
		}
	
	// Funcion que devuelve la lista usuarios ordenada por id 
	public function ordenarListaUsuariosPorID($dato1,$dato2){
		$c=new conectar();
		$conexion=$c->conexion();
		$sqlLIMIT="SELECT UserID,Email,FullName, DATE_FORMAT(LastAccess, '%d-%m-%y'),Enabled FROM user LIMIT $dato1,$dato2";		
		return mysqli_query($conexion,$sqlLIMIT);		
		}
	
	// Funcion que devuelve la lista usuarios ordenada por nombre
	public function ordenarListaUsuariosPorNombre($dato1,$dato2){
		$c=new conectar();
		$conexion=$c->conexion();
		$sqlLIMIT="SELECT UserID,Email,FullName, DATE_FORMAT(LastAccess, '%d-%m-%y'),Enabled FROM user ORDER BY FullName LIMIT $dato1,$dato2";		
		return mysqli_query($conexion,$sqlLIMIT);		
		}
	
	// Funcion que devuelve la lista usuarios ordenada por email
	public function ordenarListaUsuariosPorEmail($dato1,$dato2){
		$c=new conectar();
		$conexion=$c->conexion();
		$sqlLIMIT="SELECT UserID,Email,FullName, DATE_FORMAT(LastAccess, '%d-%m-%y'),Enabled FROM user  ORDER BY Email LIMIT $dato1,$dato2";		
		return mysqli_query($conexion,$sqlLIMIT);		
		}

	// Funcion que devuelve la lista usuarios ordenada por fecha
	public function ordenarListaUsuariosPorFecha($dato1,$dato2){
		$c=new conectar();
		$conexion=$c->conexion();
		$sqlLIMIT="SELECT UserID,Email,FullName, DATE_FORMAT(LastAccess, '%d-%m-%y'),Enabled FROM user  ORDER BY LastAccess LIMIT $dato1,$dato2";		
		return mysqli_query($conexion,$sqlLIMIT);		
		}

	// Funcion que devuelve la lista usuarios ordenada por valor enabled
	public function ordenarListaUsuariosPorEnabled($dato1,$dato2){
		$c=new conectar();
		$conexion=$c->conexion();
		$sqlLIMIT="SELECT UserID,Email,FullName, DATE_FORMAT(LastAccess, '%d-%m-%y'),Enabled FROM user  ORDER BY Enabled LIMIT $dato1,$dato2";		
		return mysqli_query($conexion,$sqlLIMIT);		
		}

    //Funcion que imprime los datos de un usuario con su id
	public function mostrarUsuarioModificarEliminar($idUsuario){
		$c= new conectar();
		$conexion=$c->conexion();
		$usuario="SELECT UserID,Email,FullName,DATE_FORMAT(LastAccess,'%d-%m-%y'),Enabled  FROM user where UserID =$idUsuario";
		$result=mysqli_query($conexion,$usuario);
		return $result;
	}			
		
	// Funcion que actualiza los datos de un usuario
	public function actualizarUsuario($datos){
		$c=new conectar();
		$conexion=$c->conexion();
		$sql="UPDATE user set FullName='$datos[1]', Email='$datos[2]', LastAccess='$datos[3]', Enabled='$datos[4]'							
		where UserID='$datos[0]'";
		return mysqli_query($conexion,$sql);	
	}
    
	//Funcion que elimina un usuario 
	public function eliminarUsuario($idusuario){
		$c=new conectar();
		$conexion=$c->conexion();
		$sql="DELETE from user where UserID='$idusuario[0]'";
		return mysqli_query($conexion,$sql);
	}
    
	// Funcion para crear un usuario
	public function crearUsuario($datos){
		$co=new conectar();
		$conexion=$co->conexion();
		$sql="INSERT into user (
			                UserID,
							FullName,
							Email,
							LastAccess,
							Enabled)
					values ('$datos[0]',
							'$datos[1]',
							'$datos[2]',
							'$datos[3]',
							'$datos[4]')";
		return mysqli_query($conexion,$sql);
	}   
}
?>

<!-- Clase Productos para todos las funciones con la base de datos -->
 <?php 
 class Productos{

    // Funcion que retorna los datos de un producto
    public function mostrarProductoModificarEliminar($idArticulo){
    	$c= new conectar();
        $conexion=$c->conexion();
        $producto="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID where product.ProductID=$idArticulo";
        $result=mysqli_query($conexion,$producto);
    	return $result;
        }
    
    // Funcion que imprime los options del select con las categorias 
    public function mostrarOptionsSelect(){
    	$c= new conectar();
    	$conexion=$c->conexion();
    	$option="SELECT Name, CategoryID FROM category";
    	$result=mysqli_query($conexion,$option);
    	return $result;
        }
    
	//Funcion que actualiza los datos de un producto
	public function actualizarProducto($datos){
		$c=new conectar();
		$conexion=$c->conexion();
		$sql="UPDATE product set CategoryID='$datos[2]', Name='$datos[3]', Cost='$datos[4]', Price='$datos[5]'							
		where ProductID='$datos[0]'";
		return mysqli_query($conexion,$sql);	
	}

	// Funcion para crear un producto
	public function crearProducto($datos){
		$co=new conectar();
		$conexion=$co->conexion();
		$sql="INSERT into product (ProductID,
		                    CategoryID,
							Name,
							Cost,
							Price)
					values ('$datos[0]',
							'$datos[1]',
							'$datos[2]',
							'$datos[3]',
							'$datos[4]')";
		return mysqli_query($conexion,$sql);
	}

	// Funcion para eliminar un producto
	public function eliminarProducto($datos){
		$c=new conectar();
		$conexion=$c->conexion();
		$sql="DELETE from product where ProductID ='$datos[0]'";
		return mysqli_query($conexion,$sql);
		}

    // Funcion para obtener el numero total de productos en la base de datos
	public function obtenerRegistrosTotalesProductos(){
		$c=new conectar();
		$conexion=$c->conexion();
		$sqlTotalRegistros="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID";
		$result=mysqli_query($conexion,$sqlTotalRegistros);
		$numFilas=mysqli_num_rows($result);
		return $numFilas;
	}

	// Funcion oara ordenar la lista de productos por id   
	public function ordenarListaProductosPorID($dato1,$dato2){
        $c=new conectar();
	    $conexion=$c->conexion();
	    $sqlLIMIT="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID ORDER BY ProductID LIMIT $dato1,$dato2";
	    return mysqli_query($conexion,$sqlLIMIT);	    
	    }

	// Funcion oara ordenar la lista de productos por categoria   
	public function ordenarListaProductosPorCategoria($dato1,$dato2){
		$c=new conectar();
		$conexion=$c->conexion();
		$sqlLIMIT="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID order by category.Name LIMIT $dato1,$dato2";
		return mysqli_query($conexion,$sqlLIMIT);		
		}

	// Funcion oara ordenar la lista de productos por nombre
	public function ordenarListaProductosPorNombre($dato1,$dato2){
		$c=new conectar();
		$conexion=$c->conexion();
		$sqlLIMIT="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID order by product.Name LIMIT $dato1,$dato2";
		return mysqli_query($conexion,$sqlLIMIT);		
		}

	// Funcion oara ordenar la lista de productos por coste
	public function ordenarListaProductosPorCoste($dato1,$dato2){
		$c=new conectar();
		$conexion=$c->conexion();
		$sqlLIMIT="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID order by product.Cost LIMIT $dato1,$dato2";
		return mysqli_query($conexion,$sqlLIMIT);		
		}

	// Funcion oara ordenar la lista de productos por precio
	public function ordenarListaProductosPorPrecio($dato1,$dato2){
		$c=new conectar();
		$conexion=$c->conexion();		
		$sqlLIMIT="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID order by product.Price LIMIT $dato1,$dato2";
		return mysqli_query($conexion,$sqlLIMIT);		
		}
}

 ?>