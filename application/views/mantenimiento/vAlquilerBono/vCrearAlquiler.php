<?php

$DniV=""; 
$FechaFinV="";
$FechaInicioV="";
$PrecioAlquilerV="";
$IdBonoV="";

$error=FALSE;
if (count($_POST)!=0)
{
    // RECOJO DATOS FORM
    $DniV=$_POST["Dni"]; 
    $FechaFinV=$_POST["FechaFin"];
    $FechaInicioV=$_POST["FechaInicio"];
    $PrecioAlquilerV=$_POST["PrecioAlquiler"];
    $IdBonoV=$_POST["IdBono"];

    // VALIDACIONES
    $formatoExpresionReg=preg_match("/^[0-9]+(\\.[0-9]{1,2})?$/",$PrecioAlquilerV); // EXPRESION REGULAR PARA EL PRECIO, ENTEROS DECIMALES ETC
    if ($formatoExpresionReg!=1 || ($PrecioAlquilerV >= 1000 || $PrecioAlquilerV < 0))
    {
        $mensajePrecio=" Formato incorrecto, máximo 5 dígitos. Ejemplo: 923.99";
        $error=TRUE;
    }
    if ((empty($FechaInicioV) || (empty($FechaFinV )) || ($FechaInicioV>$FechaFinV))) 
    {
        $mensajeFechas=" La fecha de final de alquiler debe ser superior a fecha de inicio de alquiler";
        $error=TRUE;
    }
    if(!$error)
    {
        $this->mAlquilerBono->fCrearAlquiler($matriculaPasada);
        $this->mCategoriaVehiculoBase->fModificarVehiculoEstado($matriculaPasada, "Alquilado");     
        redirect ('cAlquilerBono/fAlquilerCompacto', 'location');    // REDIRIJO DESPUES DE HACER EL UPDATE AL LISTADO EN MANTENIMIENTO DE EMPRESAS  
    }
}
?>
<center>
    <form class="form-horizontal mantenimiento" action='' method='POST'>
        <fieldset>
            <legend>Nuevo alquiler para la matrícula: <strong><?php echo $matriculaPasada; ?></strong></legend>

            <div class="<?php echo isset($mensajeFechas) ? 'has-error' : 'has-success' ?>" >
                <label class="col-lg-3 control-label" for="FechaFin">Fecha fin: </label> <!--for busca el primer id-->
                <div class="col-lg-3">
                    <input class="form-control" type="date" name="FechaFin" id="FechaFin" value="<?php if ($error){echo $FechaFinV;}else{echo date('Y-m-d');} ?>"/>
                </div>    
            </div> 

            <div class="<?php echo isset($mensajePrecio) ? 'has-error' : 'has-success' ?>" >
                <label class="col-lg-2 control-label" for="PrecioAlquiler">Precio: </label> <!--for busca el primer id-->
                <div class="col-lg-4">
                    <input class="form-control" type="number" step="any" name="PrecioAlquiler" id="PrecioAlquiler" value='<?php echo $PrecioAlquilerV ?>' />
                </div>    
            </div> 

            <div class="<?php echo isset($mensajeFechas) ? 'has-error' : 'has-success' ?>" >
                <label class="col-lg-3 control-label" for="FechaInicio">Fecha inicio: </label> <!--for busca el primer id--> 
                <div class="col-lg-3">
                    <input class="form-control" type="date" name="FechaInicio" id="FechaInicio" value="<?php if ($error){echo $FechaInicioV;}else{echo date('Y-m-d');} ?>"/>
                </div>    
            </div>

            <div>
                <label class="col-xs-12 col-sm-12 col-lg-2 control-label" for="IdBono">Bono: </label>
                <div class="col-xs-12 col-sm-12 col-lg-4">
                    <select class='form-control' name="IdBono">
                        <?php 
                        foreach ($bonos as $bono)
                        {
                            ?>
                                <option <?php if ($error){echo ($IdBonoV==$bono['IdBono'])? "selected":"" ;} ?> value="<?php echo $bono['IdBono'] ?>"><?php echo $bono['Descuento']." % - ".$bono['Descripcion'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div>
                <label class="col-xs-12 col-sm-12 col-lg-5 control-label" for="Dni">DNI y nombre completo del cliente: </label>
                <div class="col-xs-12 col-sm-12 col-lg-7">
                    <select class='form-control' name="Dni">
                        <?php 
                        foreach ($clientes as $cliente)
                        {
                            ?>
                                <option <?php if ($error){echo ($DniV==$cliente['Dni'])? "selected":"" ;} ?> value="<?php echo $cliente['Dni'] ?>"><?php echo $cliente['Dni'].": ".$cliente['NombreCliente']." ".$cliente['Apellido1Cliente']." ".$cliente['Apellido2Cliente'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div id="cajaErrores">
                <?php echo isset($mensajePrecio) ? "<p class='pError'>$mensajePrecio</p>":""; ?>
                <?php echo isset($mensajeFechas) ? "<p class='pError'>$mensajeFechas</p>":""; ?>
            </div>

            <input class="btn btn-success" type="submit" value="Alquilar"/>

        </fieldset>
    </form>
    <br/>
</center>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cCategoriaVehiculoBase/fVehiculoCompacto')?>"><span class="glyphicon glyphicon-hand-left"> Cancelar y volver</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>