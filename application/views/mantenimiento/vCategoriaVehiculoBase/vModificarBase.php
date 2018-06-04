<?php
$error=FALSE;
if (count($_POST)!=0)
{
    // RECOJO DATOS FORM
    $CodigoBaseV=$_POST["CodigoBase"]; 
    $NombreBaseV=$_POST["NombreBase"];
    $LocalidadV=$_POST["Localidad"];

    // VALIDACIONES
    $formatoCodigo=preg_match('/^([1-5]{2}|[0-5][1-9]|[1-5][0-9])[0-9]{3}$/', $CodigoBaseV); // EXRPRESION REGULAR PARA DNI
    if ($formatoCodigo!=1) // similar a código postal
    {
        $mensajeCodigo=" Código no válido, similar a código postal. Ej: 23004.";
        $error=TRUE;
    }
    if ( ($NombreBaseV=="" || strlen($NombreBaseV)>30) || ($LocalidadV=="" || strlen($LocalidadV)>30)  )
    {
        $mensaje30=" De 1 a 30 caracteres en nombre y localidad.";
        $error=TRUE;
    }
    if(!$error)
    {
        $this->mCategoriaVehiculoBase->fModificarBase($esaBase["CodigoBase"]); // ESENCIAL EL ID PARA MODIFICAR EN EL WHERE DEL UPDATE
        echo "<script> alert ('Entrada modificada con éxito. Redireccionando...') </script>";
        redirect ('cCategoriaVehiculoBase/fBase/Bases', 'location');    // REDIRIJO DESPUES DE HACER EL UPDATE AL LISTADO EN MANTENIMIENTO DE EMPRESAS
    }
}
?>

<center>
    <form class="form-horizontal mantenimiento" action='' method='POST'>
        <fieldset>
            <legend>Base a modificar: <?php echo $esaBase['NombreBase'] ?> </legend>

            <div class="<?php echo isset($mensajeCodigo) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="CodigoBase">Código: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensajeCodigo) ? 'inputError' : '' ?>" type="number" name="CodigoBase" id="CodigoBase" value="<?php if (count($_POST)!=0){echo $CodigoBaseV;}else{echo $esaBase["CodigoBase"];} ?>"/> 
                </div>                                                                                                                    <!--tb sirve esto ->    ($error)   -->
            </div> 

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="NombreBase">Nombre: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="NombreBase" id="NombreBase" value="<?php if ($error){echo $NombreBaseV;}else{echo $esaBase["NombreBase"];}?>" />
                </div>   
            </div>

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="Localidad">Localidad: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="Localidad" id="Localidad" value="<?php if (count($_POST)!=0){echo $LocalidadV;}else{echo $esaBase["Localidad"];}?>" />
                </div>   
            </div> 
            
            <div id="cajaErrores">
                <?php echo isset($mensajeCodigo) ? "<p class='pError'>$mensajeCodigo</p>":""; ?>
                <?php echo isset($mensaje30) ? "<p class='pError'>$mensaje30</p>":""; ?>
            </div>

            <input class="btn btn-primary" type="submit" value="Modificar"/>

        </fieldset>
    </form>
    <br/>
</center>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cCategoriaVehiculoBase/fBase/Bases')?>"><span class="glyphicon glyphicon-hand-left"> Cancelar y volver</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>