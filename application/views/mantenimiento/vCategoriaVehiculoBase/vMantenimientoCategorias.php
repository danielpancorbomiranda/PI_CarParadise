<div id="contenedorMantenimiento">
    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cCategoriaVehiculoBase/fCrearCategoria/Crear')?>" class="btn btn-primary">Nueva categoria de vehículo</a>
    </div>
    <table class='table table-hover'>
        <tr>
            <th>Grupo</th>
            <th>Nombre</th>
            <th class="colorVerLista">Vehículos</th>
            <th class="colorModificar">Modificar</th> 
            <th class="colorBorrar">Borrar</th>  
        </tr>
        <?php
        foreach ($categorias as $categoria)
        {
            echo "<tr>";
                echo "<td class='info col-xs-3 col-sm-3 col-md-3'>".$categoria['GrupoCategoria']."</td>";
                echo "<td class='success col-xs-7 col-sm-7 col-md-7'>".$categoria['NombreCategoria']."</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                    <a href="<?php echo site_url ('cCategoriaVehiculoBase/fVehiculoBC/Vehiculos/categoria/'.$categoria['GrupoCategoria'])?>"><span class="glyphicon glyphicon-align-justify"></span></a>
                <?php            // CONCATENO EL PARAMETRO A PASAR CON /. ES DECIR PASO EL ID NECESARIO PARA LA SIGUIENTE PANTALLA A VER CUANDO PINCHE EL ENLACE
                echo "</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cCategoriaVehiculoBase/fModificarCategoria/Modificar/'.$categoria['GrupoCategoria'])?>"><span class="glyphicon glyphicon-edit"></span></a>
                <?php               
                echo "</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cCategoriaVehiculoBase/fBorrarCategoria/'.$categoria['GrupoCategoria'])?>"><span class="glyphicon glyphicon-trash"></span></a>
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