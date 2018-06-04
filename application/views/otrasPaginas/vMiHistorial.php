<?php 
function restaFechas($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_f)-strtotime($fecha_i))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias+1; // le sumo 1, porque considero que si lo entrega el mismo día, es 1 día, no 0 dias.
}
?>
<div id="principal" class="row">
    <h3>Mi historial</h3>
    <div class="col-xs-12 col-sm-12 col-md-12 top"> <!--top-->
        <h4 style="margin-bottom: 1%"><span>Vehículos</span> alquilados <span style="cursor:pointer" title="Pincha en la fecha o en la matrícula para desplegar y ver los detalles de tu vehículo." class="glyphicon glyphicon-info-sign"></span></h4>
        <?php 
        foreach ($misVehiculos as $miVehiculo)
        {
        ?>
            <div class="col-xs-12 col-sm-12 col-md-12 historial">
                <div class="col-xs-12 col-sm-12 col-md-12 cabeceraHistorial">
                    <p class="col-xs-5 col-sm-5 col-md-5"><?php echo date('d / m / Y', strtotime($miVehiculo['FechaInicio'])) ?></p>
                    <p class="col-xs-5 col-sm-5 col-md-5"><?php echo $miVehiculo['Matricula'] ?></p>
                    <span style="text-align:right" class="col-xs-2 col-sm-2 col-md-2 glyphicon glyphicon-chevron-right"></span>
                </div>
                <div style="display:none" class="col-xs-12 col-sm-12 col-md-12 cuerpoHistorial">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <p class="col-xs-6 col-sm-6 col-md-6"><span><?php echo $miVehiculo['Marca']?></span></p>
                        <p class="col-xs-6 col-sm-6 col-md-6"><span><?php echo $miVehiculo['Modelo']?></span></p>
                        <p class="col-xs-6 col-sm-6 col-md-6">Duración: <span><?php echo restaFechas($miVehiculo['FechaInicio'], $miVehiculo['FechaFin']) ?></span> día(s)</p>
                        <p class="col-xs-6 col-sm-6 col-md-6">Precio: <span><?php echo $miVehiculo['PrecioAlquiler']?></span> €</p>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                         <?php echo "<img style='border-radius:10%' title='mi vehículo Car Paradise' width='100%' height='auto' src='data:image/jpeg;base64,".base64_encode($miVehiculo["Imagen"])."' alt='historia vehículo' />"; ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>