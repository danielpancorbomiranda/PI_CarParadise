<div id="contenedorMantenimiento">
    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cCliente/fCrearCliente/Crear')?>" class="btn btn-danger">Nuevo cliente</a>
    </div>
    <table class='table table-hover'>
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            <th>1er Apellido</th>
            <th>2do Apellido</th>
            <th>Contraseña</th>
            <th>Teléfono</th>
            <!--<th class="colorVerLista">Alquilar</th>-->
            <th class="colorModificar">Modificar</th> 
            <th class="colorBorrar">Borrar</th>  
        </tr>
        
        <?php
        foreach ($clientes as $cliente)
        {
            echo "<tr>";
                echo "<td class='info col-xs-1 col-sm-1 col-md-1'>".$cliente['Dni']."</td>";
                echo "<td class='success col-xs-2 col-sm-2 col-md-2'>".$cliente['NombreCliente']."</td>";
                echo "<td class='success col-xs-2 col-sm-2 col-md-2'>".$cliente['Apellido1Cliente']."</td>";
                echo "<td class='success col-xs-2 col-sm-2 col-md-2'>".$cliente['Apellido2Cliente']."</td>";
                echo "<td class='success col-xs-1 col-sm-1 col-md-1'>".$cliente['Contrasena']."</td>";
                echo "<td class='success col-xs-2 col-sm-2 col-md-2'>".$cliente['Telefono']."</td>";
                /*echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                    <a href="<?php echo site_url ('cAlquilerBono/fCrearAlquiler/Crear/'.$cliente['Dni'])?>"><span class="glyphicon glyphicon-road"></span></a>
                <?php            // CONCATENO EL PARAMETRO A PASAR CON /. ES DECIR PASO EL ID NECESARIO PARA LA SIGUIENTE PANTALLA A VER CUANDO PINCHE EL ENLACE
                echo "</td>";*/
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cCliente/fModificarCliente/Modificar/'.$cliente['Dni'])?>"><span class="glyphicon glyphicon-edit"></span></a>
                <?php               
                echo "</td>";
                echo "<td class='danger col-xs-1 col-sm-1 col-md-1'>";
                ?>
                <a href="<?php echo site_url ('cCliente/fBorrarCliente/'.$cliente['Dni'])?>"><span class="glyphicon glyphicon-trash"></span></a>
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