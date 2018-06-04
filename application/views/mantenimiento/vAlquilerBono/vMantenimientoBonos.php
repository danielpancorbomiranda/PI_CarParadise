<div id="contenedorMantenimiento">
    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cAlquilerBono/fCrearBono/Crear')?>" class="btn btn-success">Nuevo bono de oferta</a>
    </div>
    <table class='table table-hover'>
        <tr>
            <th>Descuento</th>
            <th>Descripción</th>
            <th class="colorVerLista">Alquileres</th>
            <th class="colorModificar">Modificar</th> 
            <th class="colorBorrar">Borrar</th>  
        </tr>
        <?php
        foreach ($bonos as $bono)
        {
            echo "<tr>";
                echo "<td class='info col-xs-1 col-sm-1 col-md-1'>".$bono['Descuento']." %</td>";
                echo "<td class='success col-xs-8 col-sm-8 col-md-8'>".$bono['Descripcion']."</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                    <a href="<?php echo site_url ('cAlquilerBono/fAlquilerB/Alquileres/bono/'.$bono['IdBono'])?>"><span class="glyphicon glyphicon-align-justify"></span></a>
                <?php            // CONCATENO EL PARAMETRO A PASAR CON /. ES DECIR PASO EL ID NECESARIO PARA LA SIGUIENTE PANTALLA A VER CUANDO PINCHE EL ENLACE
                echo "</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cAlquilerBono/fModificarBono/Modificar/'.$bono['IdBono'])?>"><span class="glyphicon glyphicon-edit"></span></a>
                <?php               
                echo "</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cAlquilerBono/fBorrarBono/'.$bono['IdBono'])?>"><span class="glyphicon glyphicon-trash"></span></a>
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