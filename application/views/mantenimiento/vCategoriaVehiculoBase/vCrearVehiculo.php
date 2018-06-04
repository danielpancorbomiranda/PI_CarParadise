<?php
$MatriculaV=""; 
$MarcaV="";
$ModeloV="";
$KmV="";
$CombustibleV="";
$PotenciaV="";
$ImagenV="";
$ColorV="#ffffff"; // color inical, el blanco
// $FechaExpiracionV=""; // ya no me hace falto porque he decidio que en el modelo que sea:
// $EstadoV="";            // su fecha -> now() + 2años y su estado -> Disponible
$CodigoBaseV="";
$GrupoCategoriaV="";

$error=FALSE;
if (count($_POST)!=0)
{      
    $MatriculaV=$_POST["Matricula"];
    $MarcaV=$_POST["Marca"];
    $ModeloV=$_POST["Modelo"];
    $KmV=$_POST["Km"];
    $CombustibleV=$_POST["Combustible"];
    $PotenciaV=$_POST["Potencia"];
    $ColorV=$_POST['Color'];
    // $FechaExpiracionV=$_POST["FechaExpiracion"];
    // $EstadoV=$_POST["Estado"];
    $CodigoBaseV=$_POST["CodigoBase"];
    $GrupoCategoriaV=$_POST["GrupoCategoria"];          
    // Upload el fichero-----------------------------
    if (count($_FILES)!=0) //if (isset($_FILES['fichero']['name']))
    {
        $config['upload_path'] =APPPATH.'_imagenesBD/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->upload->initialize($config);
        $this->upload->do_upload('fichero');//hay q poner siempre algo -> name
        $ImagenV=$this->upload->data();
    }
    else 
    {
        $ImagenV="";
    }
    //-----------------------------------------------
    // VALIDACIONES
    if ( ($MarcaV=="" || strlen($MarcaV)>30) || ($ModeloV=="" || strlen($ModeloV)>30) )
    {
        $mensaje30=" De 1 a 30 caracteres en marca y modelo.";
        $error=TRUE;
    }
    if ($KmV<0 || $KmV>20000)
    {
        $mensajeKm=" El vehículo no puede superar los 10.000 Km.";
        $error=TRUE;
    }
    if ($PotenciaV<0 || $PotenciaV>999)
    {
        $mensajeCV=" El vehículo no puede superar los 500 CV.";
        $error=TRUE;
    }
    $formatoMatriculaExpReg=preg_match("/^((\d{4})([^aeiouAEIOU]{3}))$/",$MatriculaV); // EXPRESION REGULAR PARA EL PRECIO, ENTEROS DECIMALES ETC
    if ($formatoMatriculaExpReg!=1)
    {
        $mensajeMatricula=" Ejemplo de matrícula: 2399JLK";
        $error=TRUE;
    }
    if(!$error) // ESENCIAL, SINO HAY ERROR, ES DECIR, TODO VALIDO, ES AHORA CUANDO LLAMO EL MODELO PARA ACCEDER AL INSERT DE LA BD
    {
        $this->mCategoriaVehiculoBase->fCrearVehiculo($ImagenV);
        // echo "<div id='cajaCabecera' class='entradaAnadida alert alert-success'>Entrada añadida con éxito. Siga añadiendo si lo desea o vuelva.<span class='x'>X</span></div>";
        // echo "<script> alert ('Entrada añadida con éxito. Siga introduciendo si lo desea.') </script>";
        // LIMPIO PARA VOLVER A METER PRODUCTOS
        $MatriculaV=""; 
        $MarcaV="";
        $ModeloV="";
        $KmV="";
        $CombustibleV="";
        $PotenciaV="";
        $ColorV="#ffffff"; // color inical, el blanco
        $ImagenV="";
        // $FechaExpiracionV="";
        // $EstadoV="";
        $CodigoBaseV="";
        $GrupoCategoriaV="";        
    }
}
?>
<center>
    <form class="form-horizontal mantenimiento" action='' method='POST' enctype='multipart/form-data'>
        <fieldset>
            <legend>Nuevo vehículo</legend>

            <div class="<?php echo isset($mensajeMatricula) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-12 col-sm-4 col-md-2 control-label" for="Matricula">Matrícula: </label> <!--for busca el primer id-->
                <div class="col-xs-12 col-sm-8 col-md-2">
                    <input class="form-control" class="<?php echo isset($mensajeMatricula) ? 'inputError' : '' ?>" type="text" name="Matricula" id="Matricula" value='<?php echo $MatriculaV ?>' />
                </div>    
            </div> 

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-12 col-sm-4 col-md-1 control-label" for="Marca">Marca: </label> <!--for busca el primer id-->
                <div class="col-xs-12 col-sm-8 col-md-3">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="Marca" id="Marca" value='<?php echo $MarcaV ?>' />
                </div>   
            </div>

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-12 col-sm-4 col-md-1 control-label" for="Modelo">Modelo: </label> <!--for busca el primer id-->
                <div class="col-xs-12 col-sm-8 col-md-3">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="Modelo" id="Modelo" value='<?php echo $ModeloV ?>' />
                </div>   
            </div>

            <div class="<?php echo isset($mensajeKm) ? 'has-error' : 'has-success' ?>">
                <label class="col-xs-12 col-sm-4 col-md-2 control-label" for="Km">Kilómetros: </label> <!--for busca el primer id-->
                <div class="col-xs-12 col-sm-8 col-md-4">
                    <input class="form-control" class="<?php echo isset($mensajeKm) ? 'inputError' : '' ?>" type="number" name="Km" id="Km" value='<?php echo $KmV ?>' />
                </div>   
            </div>

            <div class="<?php echo isset($mensajeCV) ? 'has-error' : 'has-success' ?>">
                <label class="col-xs-12 col-sm-4 col-md-2 control-label" for="Potencia">Potencia (CV): </label> <!--for busca el primer id-->
                <div class="col-xs-12 col-sm-8 col-md-4">
                    <input class="form-control" class="<?php echo isset($mensajeCV) ? 'inputError' : '' ?>" type="number" name="Potencia" id="Potencia" value='<?php echo $PotenciaV ?>' />
                </div>   
            </div>

            <div>
                <label class="col-xs-12 col-sm-4 col-md-2 control-label" for="Combustible">Combustible: </label>
                <div class="col-xs-12 col-sm-8 col-md-10">
                    <label class="col-xs-12 col-sm-2 col-md-3 control-label" for="Diesel">  
                        <input <?php if ($error){echo ($CombustibleV=='Diésel')? "checked":"" ;} else {echo 'checked';} ?> type="radio" id="Diesel" name="Combustible" value="Diésel" /> Diésel
                    </label>
                    <label class="col-xs-12 col-sm-3 col-md-3 control-label" for="Gasolina">
                        <input <?php if ($error){echo ($CombustibleV=='Gasolina')? "checked":"" ;} ?> type="radio" id="Gasolina" name="Combustible" value="Gasolina" /> Gasolina
                    </label>
                    <label class="col-xs-12 col-sm-3 col-md-3 control-label" for="Hibrido">  
                        <input <?php if ($error){echo ($CombustibleV=='Híbrido')? "checked":"" ;} ?> type="radio" id="Hibrido" name="Combustible" value="Híbrido" /> Híbrido
                    </label>
                    <label class="col-xs-12 col-sm-3 col-md-3 control-label" for="Electrico"> 
                        <input <?php if ($error){echo ($CombustibleV=='Eléctrico')? "checked":"" ;} ?> type="radio" id="Electrico" name="Combustible" value="Eléctrico" /> Eléctrico
                    </label>
                </div>    
            </div>
            
            <div>&nbsp<br/></div> <!-- para separarlo un poco y no se pegue demasiado -->
            <div>
				<label class="col-lg-2 control-label" for="CodigoBase">Base: </label>
				<div class="col-lg-4">
					<select class='form-control' name="CodigoBase">
						<?php 
						foreach ($bases as $base)
						{
							?>
								<option <?php if ($error){echo ($CodigoBaseV==$base['CodigoBase'])? "selected":"" ;} ?> value="<?php echo $base['CodigoBase'] ?>"><?php echo $base['CodigoBase']." - ".$base['NombreBase'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
			</div>

            <div>
				<label class="col-lg-2 control-label" for="GrupoCategoria">Categoria: </label>
				<div class="col-lg-4">
					<select class='form-control' name="GrupoCategoria">
						<?php 
						foreach ($categorias as $categoria)
						{
							?>
								<option <?php if ($error){echo ($GrupoCategoriaV==$categoria['GrupoCategoria'])? "selected":"" ;} ?> value="<?php echo $categoria['GrupoCategoria'] ?>"><?php echo $categoria['GrupoCategoria']." - ".$categoria['NombreCategoria'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
			</div>
            
            <div class="col-xs-12 col-sm-4 col-md-4">
                <label class="control-label" for="Color">Color: </label> <!--for busca el primer id--> 
                <input class="form-control" type="color" name="Color" id="Color" value="<?php echo $ColorV ?>"/>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-8">
                <label class="control-label" for="Imagen">Imagen: </label> <!--for busca el primer id-->
                    <input type="file" name="fichero" value="seleccione un fichero" />
                    <input type="hidden" name="MAX_SIZE_FILE" value="50000" />                
            </div> 

            <div id="cajaErrores">
                <?php echo isset($mensajeMatricula) ? "<p class='pError'>$mensajeMatricula</p>":""; ?>
                <?php echo isset($mensaje30) ? "<p class='pError'>$mensaje30</p>":""; ?>
                <?php echo isset($mensajeKm) ? "<p class='pError'>$mensajeKm</p>":""; ?>
                <?php echo isset($mensajeCV) ? "<p class='pError'>$mensajeCV</p>":""; ?>
            </div>
            
            <input class="btn btn-primary" type="submit" value="Añadir"/>

        </fieldset>
    </form>
    <br/>
</center>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cCategoriaVehiculoBase/fVehiculoCompacto')?>"><span class="glyphicon glyphicon-hand-left"> Volver</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>