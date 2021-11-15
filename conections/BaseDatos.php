<?php 

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
// $obj=new conectar();
// if($obj->conexion()){
//     echo "conectado";
// };

 ?>
 <?php




class usuarios{
		
		public function loginUser($datos){
			$c=new conectar();
			$conexion=$c->conexion();
            
			//datos de inicio de sesion
			$_SESSION['rol']=self::rol($datos);			
			$_SESSION['username']=$datos[0];
			$_SESSION['email']=$datos[1];

			
			$sql="SELECT * 
					from user 
				where FullName='$datos[0]'
				and Email='$datos[1]'";
			$result=mysqli_query($conexion,$sql);
			

			if(mysqli_num_rows($result) > 0){		
			
				return 1;
			}else{
				return 0;
			}
		}
		public function rol($datos){
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="SELECT Enabled
					from user 
					where FullName='$datos[0]'
					and Email='$datos[1]'"; 
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}	
		public function superAdmin(){
		$c= new conectar();
        $conexion=$c->conexion();
        $sqlAdmin="SELECT FullName FROM user INNER JOIN setup ON user.UserID = setup.SuperAdmin";
         return mysqli_query($conexion,$sqlAdmin);
		}

		public function lastAcces($datos){
			$con=new conectar();
			$conexion=$con->conexion();
			$fecha="UPDATE user SET LastAccess = now() WHERE Email='$datos[1]'";
	       return mysqli_query($conexion,$fecha);
			
		}

		public function obtenDatosUsuario($idusuario){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_usuario,
							nombre,
							apellido,
							email
					from usuarios 
					where id_usuario='$idusuario'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_usuario' => $ver[0],
							'nombre' => $ver[1],
							'apellido' => $ver[2],
							'email' => $ver[3]
						);

			return $datos;
		}
		

		public function actualizaUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE usuarios set nombre='$datos[1]',
									apellido='$datos[2]',
									email='$datos[3]'
						where id_usuario='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}

		public function eliminaUsuario($idusuario){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from usuarios 
					where id_usuario='$idusuario'";
			return mysqli_query($conexion,$sql);
		}
	}

 ?>

 <?php 
 class Productos{

	public function obtenerRegistrosTotalesProductos(){

		$c=new conectar();
		$conexion=$c->conexion();
		$sqlTotalRegistros="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID";
		$result=mysqli_query($conexion,$sqlTotalRegistros);

		$numFilas=mysqli_num_rows($result);

		return $numFilas;
	}
    public function mostrarProductosLimit(){
		
		$c=new conectar();
		$conexion=$c->conexion();
		$pagina =1;
		$mostrar=10;
		$numFilas =self::obtenerRegistrosTotalesProductos();
		$totPaginas=$numFilas/$mostrar;
		$inicioPaginas=($pagina - 1) * $totPaginas;
		$sqlLIMIT="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID LIMIT $inicioPaginas,$mostrar";
		$result=mysqli_query($conexion,$sqlLIMIT);
	
		return $result;
			
	}
	public function mostrarProductoModificarEliminar($idArticulo){
		$c= new conectar();
        $conexion=$c->conexion();
        $producto="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID where product.ProductID=$idArticulo";
        $result=mysqli_query($conexion,$producto);
		return $result;
	}
	public function mostrarOptionsSelect(){
		$c= new conectar();
		$conexion=$c->conexion();
		$option="SELECT name, CategoryID FROM category";
		$result=mysqli_query($conexion,$option);
		return $result;
	}
	public function actualizarProducto($datos){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="UPDATE product set 	CategoryID='$datos[2]',
		                         Name='$datos[3]',
								Cost='$datos[4]',
								Price='$datos[5]'
							
					where ProductID='$datos[0]'";
		return mysqli_query($conexion,$sql);	
	}
	public function crearProducto($datos){
		$co=new conectar();
		$conexion=$co->conexion();
		$sql="INSERT into product (CategoryID,
							Name,
							Cost,
							Price)
					values ('$datos[0]',
							'$datos[1]',
							'$datos[2]',
							'$datos[3]')";
		return mysqli_query($conexion,$sql);
	}
	public function eliminarProducto($datos){
		$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from product
					where ProductID ='$datos[0]'";
			return mysqli_query($conexion,$sql);
		}
		public function ordenarListaProductosPorID(){
        $c=new conectar();
		$conexion=$c->conexion();
		$pagina =1;
		$mostrar=10;
		$numFilas =self::obtenerRegistrosTotalesProductos();
		$totPaginas=$numFilas/$mostrar;
		$inicioPaginas=($pagina - 1) * $totPaginas;
		$sqlLIMIT="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID LIMIT $inicioPaginas,$mostrar";
		return mysqli_query($conexion,$sqlLIMIT);
		
		}
		public function ordenarListaProductosPorCategoria(){

			$c=new conectar();
			$conexion=$c->conexion();
			$pagina =1;
			$mostrar=10;
			$numFilas =self::obtenerRegistrosTotalesProductos();
			$totPaginas=$numFilas/$mostrar;
			$inicioPaginas=($pagina - 1) * $totPaginas;
			$sqlLIMIT="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID order by category.Name LIMIT $inicioPaginas,$mostrar";
			return mysqli_query($conexion,$sqlLIMIT);
			
			}
			public function ordenarListaProductosPorNombre(){

				$c=new conectar();
				$conexion=$c->conexion();
				$pagina =1;
				$mostrar=10;
				$numFilas =self::obtenerRegistrosTotalesProductos();
				$totPaginas=$numFilas/$mostrar;
				$inicioPaginas=($pagina - 1) * $totPaginas;
				$sqlLIMIT="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID order by product.Name LIMIT $inicioPaginas,$mostrar";
				return mysqli_query($conexion,$sqlLIMIT);
				
				}
			public function ordenarListaProductosPorCoste(){

				$c=new conectar();
				$conexion=$c->conexion();
				$pagina =1;
				$mostrar=10;
				$numFilas =self::obtenerRegistrosTotalesProductos();
				$totPaginas=$numFilas/$mostrar;
				$inicioPaginas=($pagina - 1) * $totPaginas;
				$sqlLIMIT="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID order by product.Cost LIMIT $inicioPaginas,$mostrar";
				return mysqli_query($conexion,$sqlLIMIT);
				
				}
				public function ordenarListaProductosPorPrecio(){

					$c=new conectar();
					$conexion=$c->conexion();
					$pagina =1;
					$mostrar=10;
					$numFilas =self::obtenerRegistrosTotalesProductos();
					$totPaginas=$numFilas/$mostrar;
					$inicioPaginas=($pagina - 1) * $totPaginas;
					$sqlLIMIT="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID order by product.Price LIMIT $inicioPaginas,$mostrar";
					return mysqli_query($conexion,$sqlLIMIT);
					
					}
}

 ?>