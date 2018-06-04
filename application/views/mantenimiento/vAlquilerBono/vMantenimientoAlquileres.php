<div id="contenedorMantenimiento">
    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cCategoriaVehiculoBase/fVehiculoCompacto')?>" class="btn btn-success">Nuevo alquiler</a>
    </div>
    <table class='table table-hover'>
        <tr>
            <th>Vehículo</th>
            <th>Cliente</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th style="text-align:center">Precio</th>
            <?php //if (isset($alquileres[0]['Descuento'])) { echo "<th>Descuento</th>";} ?>
            <th style="text-align:center">Descuento</th>
            <th class="colorBorrar">Borrar</th>  
        </tr>
        <?php 
        foreach ($alquileres as $alquiler)
        {
            echo "<tr>";
                echo "<td class='info col-xs-1 col-sm-1 col-md-1'>".$alquiler['Matricula']."</td>";
                if ($alquiler['IdBono']==15)
                {
                    echo "<td style='color: orangered' class='info col-xs-3 col-sm-3 col-md-3'>".$alquiler['Dni']." (online)</td>";
                }
                else
                {
                    foreach ($clientes as $cliente) {
                        if ($cliente['Dni']==$alquiler['Dni']){
                            echo "<td class='info col-xs-3 col-sm-3 col-md-3'>".$cliente['NombreCliente']." ".$cliente['Apellido1Cliente']." ".$cliente['Apellido2Cliente']."</td>";
                        }
                    }
                }
                echo "<td class='success col-xs-2 col-sm-2 col-md-2'><span class='FechaInicio'>".date('d/m/y M', strtotime($alquiler['FechaInicio']))."</span></td>";
                echo "<td class='success col-xs-2 col-sm-2 col-md-2'>".date('d/m/y M', strtotime($alquiler['FechaFin']))."</td>";
                // echo (!empty($alquiler['PrecioAlquiler'])) ? "<td class='PrecioAlquiler success col-xs-2 col-sm-2 col-md-2'>".$alquiler['PrecioAlquiler']." €" : "<td style='color:orangered' class='PrecioAlquiler success col-xs-2 col-sm-2 col-md-2'>- Pendiente -"."</td>";
                // echo ($alquiler['IdBono']!=15) ? "<td class='PrecioAlquiler success col-xs-2 col-sm-2 col-md-2'>".$alquiler['PrecioAlquiler']." €" : "<td style='color:orangered' class='PrecioAlquiler success col-xs-2 col-sm-2 col-md-2'>- Pendiente -"."</td>";
                echo "<td class='PrecioAlquiler success col-xs-2 col-sm-2 col-md-2'>".$alquiler['PrecioAlquiler']." €</td>";
                // if (isset($alquiler['Descuento']))
                // {
                //     echo "<td class='success col-xs-1 col-sm-1 col-md-1'>".$alquiler['Descuento']." %</td>";
                // }
                if ($alquiler['IdBono']==15)
                {
                    echo "<td class='success col-xs-1 col-sm-1 col-md-1'>15 %</td>";
                }
                else 
                {
                    foreach ($bonos as $bono) {
                        if ($bono['IdBono']==$alquiler['IdBono']){
                            echo "<td class='success col-xs-1 col-sm-1 col-md-1'>".$bono['Descuento']." %</td>";
                        }
                    }
                }
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cAlquilerBono/fBorrarAlquiler/'.$alquiler['Matricula'].'/'.$alquiler['Dni'].'/'.$alquiler['FechaInicio'].'/'.$alquiler['FechaFin'])?>"><span class="glyphicon glyphicon-trash"></span></a>
                <?php              
                echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<?php if (isset ($bloquepaginacion)) {echo $bloquepaginacion."<br/>"; } ?>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('rutaIndice') ?>"><span class="glyphicon glyphicon-home"> Índice</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>