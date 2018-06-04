<div style="width:auto" id="contenedorMantenimiento">
    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cCategoriaVehiculoBase/fCrearVehiculo/Crear')?>" class="btn btn-primary">Nuevo vehículo</a>
    </div>
    <table class='table table-hover'>
        <tr>
            <th>Matrícula</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Kilómetros</th>
            <th>Combustible</th>
            <th>Potencia</th>      <!-- he quitado imagen y grupo categoria ya que está muy cargado -->
            <!--<th>Imagen</th>-->
            <th>Fch. Exp.</th>
            <th>Base</th>
            <th>Estado</th>
            <!--<th>Grupo Categoria</th>-->
            <th class="colorVerLista">Alquilar</th>
            <th class="colorModificar">Modificar</th> 
            <th class="colorBorrar">Borrar</th>  
        </tr>
        <?php
        foreach ($vehiculos as $vehiculo)
        {
            if ($vehiculo['Estado']=="Expirado"){$expirado="style='color:darkred;text-decoration: line-through;'";} else {$expirado="";}
            echo "<tr>";
                echo "<td class='info col-xs-1 col-sm-1 col-md-1'>".$vehiculo['Matricula']."</td>";
                echo "<td $expirado style='background-color:".$vehiculo['Color']."' class='success col-xs-1 col-sm-1 col-md-1'>".$vehiculo['Marca']."</td>";
                echo "<td $expirado class='success col-xs-1 col-sm-1 col-md-1'>".$vehiculo['Modelo']."</td>";
                echo "<td $expirado class='success col-xs-1 col-sm-1 col-md-1'>".$vehiculo['Km']."</td>";
                echo "<td $expirado class='success col-xs-1 col-sm-1 col-md-1'>".$vehiculo['Combustible']."</td>";
                echo "<td $expirado class='success col-xs-1 col-sm-1 col-md-1'>".$vehiculo['Potencia']." CV</td>";
                // echo "<td class='success col-xs-1 col-sm-1 col-md-1'><img alt='Imagen de vehículo' width='50' height='50' src='data:image/jpeg;base64,".base64_encode($vehiculo['Imagen'])."'/></td>";
                echo "<td $expirado class='success col-xs-1 col-sm-1 col-md-1'>".date('d/m/y', strtotime($vehiculo['FechaExpiracion']))."</td>";
                echo "<td $expirado class='success col-xs-1 col-sm-1 col-md-1'>".$vehiculo['CodigoBase']."</td>";
                if ($vehiculo['Estado']=='Disponible')
                {
                    echo "<td style='color:green' class='success col-xs-1 col-sm-1 col-md-1'>".$vehiculo['Estado']."</td>";
                }
                else
                {
                    echo "<td style='color:darkred' class='success col-xs-1 col-sm-1 col-md-1'>".$vehiculo['Estado']."</td>";
                }
                // echo "<td class='success col-xs-1 col-sm-1 col-md-1'>".$vehiculo['GrupoCategoria']."</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                if ($vehiculo['Estado']=='Disponible')
                {
                    ?>
                        <a href="<?php echo site_url ('cAlquilerBono/fCrearAlquiler/Crear/'.$vehiculo['Matricula'])?>"><span class="glyphicon glyphicon-road"></span></a>
                    <?php            // CONCATENO EL PARAMETRO A PASAR CON /. ES DECIR PASO EL ID NECESARIO PARA LA SIGUIENTE PANTALLA A VER CUANDO PINCHE EL ENLACE
                }
                else 
                {
                    ?>
                        <span class="glyphicon glyphicon-minus-sign"></span>
                    <?php        
                }
                echo "</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cCategoriaVehiculoBase/fModificarVehiculo/Modificar/'.$vehiculo['Matricula'])?>"><span class="glyphicon glyphicon-edit"></span></a>
                <?php               
                echo "</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                if ($vehiculo['Estado']!='Alquilado')
                {
                    ?>
                        <a href="<?php echo site_url ('cCategoriaVehiculoBase/fBorrarVehiculo/'.$vehiculo['Matricula'])?>"><span class="glyphicon glyphicon-trash"></span></a>
                    <?php           // CONCATENO EL PARAMETRO A PASAR CON /. ES DECIR PASO EL ID NECESARIO PARA LA SIGUIENTE PANTALLA A VER CUANDO PINCHE EL ENLACE
                }
                else 
                {
                    ?>
                        <span style='color:darkred' class="glyphicon glyphicon-time"></span>
                    <?php        
                }         
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