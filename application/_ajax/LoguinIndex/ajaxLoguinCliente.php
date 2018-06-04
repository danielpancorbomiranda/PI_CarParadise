<?php

session_start();
$conexion = mysqli_connect("localhost","root","","CarParadise_bd"); // conectamos a la base de datos
$conexion -> set_charset ("utf8");

if(isset($_POST["dniPasar"]) && isset($_POST["contrasenaPasar"]))
{
  $dniV = mysqli_real_escape_string($conexion, $_POST["dniPasar"]);
  $contrasenaV = mysqli_real_escape_string($conexion, $_POST["contrasenaPasar"]);
  $dniV = $_POST["dniPasar"];
  $contrasenaV = $_POST["contrasenaPasar"];
  //variable que almacena la consulta $consultaSQL, devulve el nombre de usuario
  $consultaSQL = "SELECT * FROM Cliente WHERE (Dni='$dniV') AND Contrasena='$contrasenaV'";
  // realizamos la consulta y la almacenamos en la variable resultado
  $resultado = mysqli_query($conexion, $consultaSQL);
  $numero_de_filas = mysqli_num_rows($resultado); // obtenemos el numero de filas de resultado
  if ($numero_de_filas == "1") 
  { 				// es decir q exista un cliente
						// datos almacena la consulta en forma de array
		$datos = mysqli_fetch_array($resultado);
		$_SESSION["dniUsuarioLogueado"] = $datos["Dni"];
		$_SESSION["nombreEnteroUsuarioLogueado"] = $datos["NombreCliente"]." ".$datos["Apellido1Cliente"]." ".$datos["Apellido2Cliente"];
		
		echo "<h4 style='text-align:center'><span>Bienvenido ".$datos['NombreCliente']." a</span><br/><br/><span class='letrasMagneto'>Car Paradise</span></h4>";

		// NOTA: me quedé con las ganas de de probar y regresar un return del array "$datos" al script donde hago un AJAX ya que de esta manera me ha sido más cómoda.
		/*?>
		<!--TROZO DEL LOGUIN DE USUARIO-->
		<center> 
		<form class="form-horizontal" action='' method="POST">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-control">
				<span><?php echo $_SESSION["nombreEnteroUsuarioLogueado"]; ?></span>                    
			</div>    
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-control">
				<span><?php echo $_SESSION["dniUsuarioLogueado"]; ?></span>
			</div>   
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-control">
				<input class='botonesIndex' name='Desconecta' type='submit' value='Desconexión'/>
			</div>
		</form>
	</center>
	<?php*/
	} 
	else 
	{
    echo "Usuario no encontrado.";
  }
 	} 
 	else 
 	{
   	echo "No existe POST.";
 	}
?>
