<div id="contenedorMantenimiento">
    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cTipoEmpleado/fCrearTipo/Crear')?>" class="btn btn-danger">Nuevo tipo de empleado</a>
    </div>
    <table class='table table-hover'>
        <tr>
            <th>ID del tipo de empleado</th>
            <th>Nombre del tipo de empleado</th>
            <th class="colorVerLista">Empleados</th>
            <th class="colorModificar">Modificar</th> 
            <th class="colorBorrar">Borrar</th>  
        </tr>
        <?php
        foreach ($tipos as $tipo)
        {
            echo "<tr>";
                echo "<td class='info col-xs-3 col-sm-3 col-md-3'>".$tipo['IdTipo']."</td>";
                echo "<td class='success col-xs-5 col-sm-5 col-md-5'>".$tipo['NombreTipo']."</td>";
                echo "<td class='danger'>";
                ?>
                    <a href="<?php echo site_url ('cTipoEmpleado/fEmpleado/Empleados/'.$tipo['IdTipo'])?>"><span class="glyphicon glyphicon-align-justify"></span></a>
                <?php            // CONCATENO EL PARAMETRO A PASAR CON /. ES DECIR PASO EL ID NECESARIO PARA LA SIGUIENTE PANTALLA A VER CUANDO PINCHE EL ENLACE
                echo "</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cTipoEmpleado/fModificarTipo/Modificar/'.$tipo['IdTipo'])?>"><span class="glyphicon glyphicon-edit"></span></a>
                <?php               
                echo "</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cTipoEmpleado/fBorrarTipo/'.$tipo['IdTipo'])?>"><span class="glyphicon glyphicon-trash"></span></a>
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