<div id="contenedorMantenimiento">
    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cCategoriaVehiculoBase/fCrearBase/Crear')?>" class="btn btn-primary">Nueva base de vehículos</a>
    </div>
    <table class='table table-hover'>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Localidad</th>
            <th class="colorVerLista">Vehículos</th>
            <th class="colorModificar">Modificar</th> 
            <th class="colorBorrar">Borrar</th>  
        </tr>
        <?php
        foreach ($bases as $base)
        {
            echo "<tr>";
                echo "<td class='info col-xs-2 col-sm-2 col-md-2'>".$base['CodigoBase']."</td>";
                echo "<td class='success col-xs-4 col-sm-4 col-md-4'>".$base['NombreBase']."</td>";
                echo "<td class='success col-xs-3 col-sm-3 col-md-3'>".$base['Localidad']."</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                    <a href="<?php echo site_url ('cCategoriaVehiculoBase/fVehiculoBC/Vehiculos/base/'.$base['CodigoBase'])?>"><span class="glyphicon glyphicon-align-justify"></span></a>
                <?php            // CONCATENO EL PARAMETRO A PASAR CON /. ES DECIR PASO EL ID NECESARIO PARA LA SIGUIENTE PANTALLA A VER CUANDO PINCHE EL ENLACE
                echo "</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cCategoriaVehiculoBase/fModificarBase/Modificar/'.$base['CodigoBase'])?>"><span class="glyphicon glyphicon-edit"></span></a>
                <?php               
                echo "</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cCategoriaVehiculoBase/fBorrarBase/'.$base['CodigoBase'])?>"><span class="glyphicon glyphicon-trash"></span></a>
                <?php              
                echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('rutaIndice') ?>"><span class="glyphicon glyphicon-home"> Índice</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>