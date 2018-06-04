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
        $this->mTipoEmpleado->fCrearTipo();
        echo "<div id='cajaCabecera' class='entradaAnadida alert alert-success'>Entrada añadida con éxito. Siga añadiendo si lo desea o vuelva.<span class='x'>X</span></div>";
        // echo "<script> alert ('Entrada añadida con éxito. Siga introduciendo si lo desea.') </script>";
        $NombreTipoV=""; // LAS PONGO A "" PARA INTRODUCIR MÁS
    }
}
?>
<center>
    <form class="form-horizontal mantenimiento" action='' method='POST'>
        <fieldset>
            <legend>Nuevo tipo de empleado</legend>

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-3 col-sm-3 col-md-3 control-label" for="NombreTipo">Nombre: </label> <!--for busca el primer id-->
                <div class="col-xs-9 col-sm-9 col-md-9">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="NombreTipo" id="NombreTipo" value='<?php echo $NombreTipoV ?>' />
                </div>   
            </div>
            
            <div id="cajaErrores">
                <?php echo isset($mensaje30) ? "<p class='pError'>$mensaje30</p>":""; ?>
            </div>
            
            <input class="btn btn-danger" type="submit" value="Añadir"/>

        </fieldset>
    </form>
    <br/>
</center>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cTipoEmpleado/fTipo/Tipos')?>"><span class="glyphicon glyphicon-hand-left"> Volver</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>