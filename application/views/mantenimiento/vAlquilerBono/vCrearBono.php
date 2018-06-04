<?php
$DescuentoV=""; 
$DescripcionV="";

$error=FALSE;
if (count($_POST)!=0)
{
    // RECOJO DATOS FORM
    $DescuentoV=$_POST["Descuento"]; 
    $DescripcionV=$_POST["Descripcion"];

    // VALIDACIONES
    if ( ( $DescuentoV != "" ) && ( $DescuentoV<1 || $DescuentoV>100 ) ) 
    {
        $mensajeDescuento=" El descuento debe ser entre el 0 % - 100 % o dejarlo en blanco.";
        $error=TRUE;
    }
    if ( ($DescripcionV=="" || strlen($DescripcionV)>50) )
    {
        $mensaje50=" De 1 a 50 caracteres para la descripción.";
        $error=TRUE;
    }
    if(!$error)
    {
        $this->mAlquilerBono->fCrearBono();
        echo "<div id='cajaCabecera' class='entradaAnadida alert alert-success'>Entrada añadida con éxito. Siga añadiendo si lo desea o vuelva.<span class='x'>X</span></div>";
        // echo "<script> alert ('Entrada añadida con éxito. Siga introduciendo si lo desea.') </script>";
        $DescuentoV="";     $DescripcionV="";
    }
}
?>
<center>
    <form class="form-horizontal mantenimiento" action='' method='POST'>
        <fieldset>
            <legend>Nuevo bono de oferta</legend>

            <div class="<?php echo isset($mensajeDescuento) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="Descuento">Descuento: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensajeDescuento) ? 'inputError' : '' ?>" type="number" name="Descuento" id="Descuento" value='<?php echo $DescuentoV ?>' />
                </div>                                                                                                                    <!--tb sirve esto ->    ($error)   -->
            </div> 

            <div class="<?php echo isset($mensaje50) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="Descripcion">Descripción: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensaje50) ? 'inputError' : '' ?>" type="text" name="Descripcion" id="Descripcion" value='<?php echo $DescripcionV ?>' />
                </div>   
            </div>
            
            <div id="cajaErrores">
                <?php echo isset($mensajeDescuento) ? "<p class='pError'>$mensajeDescuento</p>":""; ?>
                <?php echo isset($mensaje50) ? "<p class='pError'>$mensaje50</p>":""; ?>
            </div>

            <input class="btn btn-success" type="submit" value="Añadir"/>

        </fieldset>
    </form>
    <br/>
</center>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cAlquilerBono/fBono/Bonos')?>"><span class="glyphicon glyphicon-hand-left"> Volver</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>