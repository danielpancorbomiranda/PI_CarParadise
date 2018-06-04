<?php 
$NombreTipoV="";
$error=FALSE;
if (count($_POST)!=0)
{
    // RECOJO DATOS FORM
    $NombreTipoV=$_POST["NombreTipo"];

    // VALIDACIONES
    if ( ($NombreTipoV=="" || strlen($NombreTipoV)>30) )
    {
        $mensaje30=" De 1 a 30 caracteres en el nombre del tipo de empleado.";
        $error=TRUE;
    }
    if(!$error)
    {
        $this->mTipoEmpleado->fModificarTipo($eseTipo['IdTipo']); // ESENCIAL EL ID PARA MODIFICAR EN EL WHERE DEL UPDATE
        echo "<script> alert ('Entrada modificada con éxito. Redireccionando...') </script>";
        redirect ('cTipoEmpleado/fTipo/Tipos', 'location');    // REDIRIJO DESPUES DE HACER EL UPDATE AL LISTADO EN MANTENIMIENTO DE EMPRESAS
        $NombreTipoV=""; // LAS PONGO A "" PARA INTRODUCIR MÁS
    }
}
?>
<center>
    <form class="form-horizontal mantenimiento" action='' method='POST'>
        <fieldset>
            <legend>Tipo de empleado</legend>

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-2 col-sm-2 col-md-2 control-label" for="NombreTipo">Nombre: </label> <!--for busca el primer id-->
                <div class="col-xs-9 col-sm-9 col-md-9">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="NombreTipo" id="NombreTipo" value="<?php if ($error){echo $NombreTipoV;}else{echo $eseTipo["NombreTipo"];}?>" />
                </div>   
            </div>
            
            <div id="cajaErrores">
                <?php echo isset($mensaje30) ? "<p class='pError'>$mensaje30</p>":""; ?>
            </div>
            
            <input class="btn btn-danger" type="submit" value="Modificar"/>

        </fieldset>
    </form>
    <br/>
</center>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cTipoEmpleado/fTipo/Tipos')?>"><span class="glyphicon glyphicon-hand-left"> Cancelar y volver</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>