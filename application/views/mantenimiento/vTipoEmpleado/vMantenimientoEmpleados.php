<div id="contenedorMantenimiento">
    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cTipoEmpleado/fCrearEmpleado/Crear/'.$idTipoPasado)?>" class="btn btn-danger">Nuevo empleado</a>
    </div>
    <table class='table table-hover'>
        <tr>
            <th>Apodo</th>
            <th>Nombre</th>
            <th>Contraseña</th>
            <th class="colorModificar">Modificar</th> 
            <th class="colorBorrar">Borrar</th>  
        </tr>
        <?php
        foreach ($empleados as $empleado)
        {
            echo "<tr>";
                echo "<td class='info col-xs-3 col-sm-3 col-md-3'>".$empleado['ApodoEmpleado']."</td>";
                echo "<td class='success col-xs-4 col-sm-4 col-md-4'>".$empleado['NombreEmpleado']."</td>";
                echo "<td class='info col-xs-3 col-sm-3 col-md-3'>".$empleado['Contrasena']."</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cTipoEmpleado/fModificarEmpleado/Modificar/'.$empleado['ApodoEmpleado'])?>"><span class="glyphicon glyphicon-edit"></span></a>
                <?php               
                echo "</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cTipoEmpleado/fBorrarEmpleado/'.$empleado['ApodoEmpleado'].'/'.$idTipoPasado) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                <?php              
                echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cTipoEmpleado/fTipo/Tipos')?>"><span class="glyphicon glyphicon-hand-left"> Volver</span></a>
    <br/><br/>
    <a href="<?php echo site_url ('rutaIndice') ?>"><span class="glyphicon glyphicon-home"> Índice</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>