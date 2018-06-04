<?php 
$DniV="";
$FechaFinV="";
$FechaInicioV="";
$IdBonoV="";

$error=FALSE;
if (count($_POST)!=0)
{
    // RECOJO DATOS FORM
    $DniV=$_POST["Dni"]; 
    $FechaFinV=$_POST["FechaFin"];
    $FechaInicioV=$_POST["FechaInicio"];
    $IdBonoV=$_POST["IdBono"];

    // VALIDACIONES
    $formatoDni=preg_match('/^\d{8}[a-zA-Z]$/', $DniV); // EXRPRESION REGULAR PARA DNI
    if ($formatoDni!=1)
    {
        $mensajeDni=" DNI no válido, ej: 77345252R.";
        $error=TRUE;
    }
    if ( empty( $FechaInicioV ) || empty( $FechaFinV ) || ( $FechaInicioV > $FechaFinV || date('Y-m-d') > $FechaInicioV ) ) 
    {
        $mensajeFechas=" Fecha fin debe superar a fecha inicio y esta no debe ser inferior a hoy.";
        $error=TRUE;
    }
    if(!$error)
    {
        $this->mAlquilerBono->fCrearAlquiler($matriculaPasada);
        $this->mCategoriaVehiculoBase->fModificarVehiculoEstado($matriculaPasada, "Reservado");     
        // redirect ('', 'location');    // REDIRIJO DESPUES DE HACER EL UPDATE AL LISTADO EN MANTENIMIENTO DE EMPRESAS  
        ?>
        <script>
            $(document).ready(function() {
                quitaBotonReservarPorInfo(); 
            });
        </script>
        <?php
    }
}
?>
<div id="principal" class="row">
    <h3>Ficha de reserva <span class="matricula" >[ <?php echo $eseVehiculoReservable['Matricula'] ?> ]</spn></h3>
    <div class="col-xs-12 col-sm-12 col-md-12 datosVehiculo">
        <div class="col-xs-6 col-sm-6 col-md-6 alert alert-info">
            <fieldset>
                <legend><h4>Datos del vehículo a reservar.</h4></legend>
                <ul>
                    <li>Matrícula: <span id="matriculaEnLi"><?php echo $eseVehiculoReservable['Matricula'] ?></span>.</li>
                    <li>Marca: <span><?php echo $eseVehiculoReservable['Marca'] ?></span>.</li>
                    <li>Modelo: <span><?php echo $eseVehiculoReservable['Modelo'] ?></span>.</li>
                    <li>Kilómetros: <span id="KmsEnLi"><?php echo $eseVehiculoReservable['Km'] ?></span>.</li>
                    <li>Combustible: <span><?php echo $eseVehiculoReservable['Combustible'] ?></span>.</li>
                    <li>Potencia: <span><?php echo $eseVehiculoReservable['Potencia'] ?> CV</span>.</li>
                    <li>Código base: <span><?php echo $eseVehiculoReservable['CodigoBase'] ?></span>.</li>
                    <li>Ubicación: <span><?php echo $eseVehiculoReservable['Localidad'] ?></span>.</li>
                    <li>Grupo de categoria: <span><?php echo $eseVehiculoReservable['GrupoCategoria'] ?></span>.</li>
                    <li>Estado actual: <span><?php echo $eseVehiculoReservable['Estado'] ?></span>.</li>
                    <?php 
                    if (!empty($eseVehiculoReservable['Color']))
                    {
                        ?>
                        <li>Color: <span style="background-color:<?php echo $eseVehiculoReservable['Color'] ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>.</li>
                        <?php
                    }
                    else
                    {
                        ?>
                        <li>Color: <span>Sin determinar</span>.</li>
                        <?php
                    }
                    ?>
                    <li>Observaciones: <span>Reservable hasta el <?php echo date('d/m/y', strtotime($eseVehiculoReservable['FechaExpiracion'])) ?></span>.</li>
                </ul>
            </fieldset>
        </div>
        <div style="text-align:center" class="col-xs-6 col-sm-6 col-md-6">     
            <!--<fieldset>
                <legend>Imágen del vehículo.</legend>-->
                <?php 
                if ($eseVehiculoReservable['Marca'] == "Renault" || $eseVehiculoReservable['Marca'] == "Lamborghini" || $eseVehiculoReservable['Marca'] == "Ferrari")
                {
                ?>
                    <button class="botonesIndex botonVerVideo">Ver video</button><br/>
                    <video autoplay style="display:none" controls width='480' height='300'><source src="<?php echo base_url ('application/_videos/'.$eseVehiculoReservable['Marca'].'.mp4') ?>"  type='video/mp4'></video> 
                <?php
                } 
                ?>
                <?php echo "<img title='Vehículo CarParadise' width='480' height='300' src='data:image/jpeg;base64,".base64_encode($eseVehiculoReservable["Imagen"])."' alt='vehiculo reservable' />"; ?>
            <!--</fieldset>-->
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 datosReserva alert alert-warning">

        <fieldset>

            <legend><h4>Datos necesarios para la reserva.</h4></legend>
            
            <form class="form-horizontal" action='' method='POST'>

                 <div class="col-xs-4 col-sm-4 col-md-4 <?php echo isset($mensajeFechas) ? 'has-error' : 'has-success' ?>" >
                    <label class="control-label" for="FechaInicio">Fecha inicio: </label> <!--for busca el primer id--> 
                    <input class="form-control" type="date" name="FechaInicio" id="FechaInicio" value="<?php if ($error){echo $FechaInicioV;}else{echo date('Y-m-d');} ?>"/>
                </div>

               <div class="col-xs-4 col-sm-4 col-md-4 <?php echo isset($mensajeFechas) ? 'has-error' : 'has-success' ?>" >
                    <label class="control-label" for="FechaFin">Fecha fin: </label> <!--for busca el primer id-->
                    <input class="form-control" type="date" name="FechaFin" id="FechaFin" value="<?php if ($error){echo $FechaFinV;}else{echo date('Y-m-d');} ?>"/>
                </div> 

                <div class="col-xs-4 col-sm-4 col-md-4 <?php echo isset($mensajeDni) ? 'has-error' : 'has-success' ?>" >
                    <label class="control-label" for="Dni">Referencia online: </label> <!--for busca el primer id-->
                    <input <?php echo (isset($_SESSION["dniUsuarioLogueado"]) && isset($_SESSION["nombreEnteroUsuarioLogueado"])) ? 'readonly' : '' ?> placeholder="DNI del cliente" class="form-control" class="<?php echo isset($mensajeDni) ? 'inputError' : '' ?>" type="text" name="Dni" id="Dni" value="<?php echo (isset($_SESSION['dniUsuarioLogueado']) && isset($_SESSION['nombreEnteroUsuarioLogueado'])) ? $_SESSION['dniUsuarioLogueado'] : $DniV ?>" />
                </div> 

                <div class="col-xs-4 col-sm-4 col-md-4">
                    <label class="control-label" for="IdBono">Precio base (€): </label>
                    <input readonly class="form-control" type="number" name="PrecioBase" id="PrecioBase" value=""/>
                </div>

                <div class="col-xs-4 col-sm-4 col-md-4">
                    <label class="control-label" for="Dto">Descuento online (%): </label> 
                    <input readonly class="form-control" type="number" name="IdBono" id="IdBono" value="15"/>
                </div>

                <div class="col-xs-4 col-sm-4 col-md-4">
                    <label class="control-label" for="PrecioAlquiler">Precio final (€): </label>
                    <input style="font-weight:bolder;text-align:right" readonly class="form-control" type="number" name="PrecioAlquiler" id="PrecioAlquiler" value=""/>
                </div>

                <!--<div class="col-xs-3 col-sm-3 col-md-3">
                    <label class="control-label" for="IdBono">Descuento: </label>
                    <select class='form-control' name="IdBono">
                        <option <?php //echo (($error) && $IdBonoV==0) ? "selected":"" ; ?> value="0"></option>
                        <option <?php //echo (($error) && $IdBonoV==15) ? "selected":"" ; ?> value="15">15 % - Online</option>
                    </select>
                </div>-->

                <div class="col-xs-12 col-sm-12 col-md-12" id="cajaErrores">
                    <?php echo isset($mensajeDni) ? "<p class='pError'>$mensajeDni</p>":""; ?>
                    <?php echo isset($mensajePrecio) ? "<p class='pError'>$mensajePrecio</p>":""; ?>
                    <?php echo isset($mensajeFechas) ? "<p class='pError'>$mensajeFechas</p>":""; ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center">
                    <input class="botonesIndex" type="submit" value="Reservar" id="botonReservar"/>
                </div>

            </form>

        </fieldset>

    </div>

</div>