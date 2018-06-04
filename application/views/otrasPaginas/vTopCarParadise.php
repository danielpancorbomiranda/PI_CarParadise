<div id="principal" class="row">
    <h3><span style="cursor:pointer" title="Pincha los iconos de descarga para obtener los detalles TOP de nuestro último mes." class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp; Top 10 de alquileres + reservas &nbsp;&nbsp;<a title="Top 10 Car Paradise Mayo" href="<?php echo base_url ('application/_imagenesCSS/topMayo/topCarParadiseMayo.RAR') ?>" download="Listados top 10 Car Paradise Mayo.rar"><span class="glyphicon glyphicon-download-alt"></span></a></h3>
    <div class="col-xs-6 col-sm-6 col-md-6 top">
        <h4>Top <span>marcas</span> de vehículos <a title="Top 10 marcas Mayo" href="<?php echo base_url ('application/_imagenesCSS/topMayo/topMarcasMayo.PNG') ?>" download="Top 10 marcas Car Paradise Mayo"><span class="glyphicon glyphicon-download-alt"></span></a></h4>
        <table class='table table-hover tablaTop'>
            <tr>
                <th style="text-align: center" class="col-xs-2 col-sm-2 col-md-2">Posición</th>
                <th style="text-align: center" class="col-xs-8 col-sm-8 col-md-8">Marca</th>
                <th style="text-align: center" class="col-xs-2 col-sm-2 col-md-2">Cantidad</th>
            </tr>
            <?php
            $posiciones="";
            foreach ($topMarcas as $topMarca)
            {
                $posiciones++;
                echo "<tr>";
                echo "<td class='info'>".$posiciones."º.</td>";
                echo "<td class='success'>".$topMarca['Marca']."</td>";
                echo "<td class='danger'>".$topMarca['COUNT(Vehiculo.Marca)']."</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 top">
        <h4>Top <span>modelos</span> de vehículos <a title="Top 10 modelos Mayo" href="<?php echo base_url ('application/_imagenesCSS/topMayo/topModelosMayo.PNG') ?>" download="Top 10 modelos Car Paradise Mayo"><span class="glyphicon glyphicon-download-alt"></span></a></h4>
        <table class='table table-hover tablaTop'>
            <tr>
                <th style="text-align: center" class="col-xs-2 col-sm-2 col-md-2">Posición</th>
                <th style="text-align: center" class="col-xs-8 col-sm-8 col-md-8">Modelo</th>
                <th style="text-align: center" class="col-xs-2 col-sm-2 col-md-2">Cantidad</th>
            </tr>
            <?php
            $posiciones="";
            foreach ($topModelos as $topModelo)
            {
                $posiciones++;
                echo "<tr>";
                echo "<td class='info'>".$posiciones."º.</td>";
                echo "<td class='success'>".$topModelo['Modelo']."</td>";
                echo "<td class='danger'>".$topModelo['COUNT(Vehiculo.Modelo)']."</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 top">
        <h4>Top <span>bases</span> en localidades <a title="Top 10 bases Mayo" href="<?php echo base_url ('application/_imagenesCSS/topMayo/topBasesMayo.PNG') ?>" download="Top 10 bases Car Paradise Mayo"><span class="glyphicon glyphicon-download-alt"></span></a></h4>
        <table class='table table-hover tablaTop'>
            <tr>
                <th style="text-align: center" class="col-xs-2 col-sm-2 col-md-2">Posición</th>
                <th style="text-align: center" class="col-xs-4 col-sm-4 col-md-4">Base</th>
                <th style="text-align: center" class="col-xs-4 col-sm-4 col-md-4">Localidad</th>
                <th style="text-align: center" class="col-xs-2 col-sm-2 col-md-2">Cantidad</th>
            </tr>
            <?php
            $posiciones="";
            foreach ($topBases as $topBase)
            {
                $posiciones++;
                echo "<tr>";
                echo "<td class='info'>".$posiciones."º.</td>";
                echo "<td class='success'>".$topBase['NombreBase']."</td>";
                echo "<td class='success'>".$topBase['Localidad']."</td>";
                echo "<td class='danger'>".$topBase['COUNT(Base.Localidad)']."</td>";
                echo "</tr>";                
            }
            ?>
        </table>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 top">
        <h4>Top <span>bonos</span> de ofertas <a title="Top 10 bonos de ofertas Mayo" href="<?php echo base_url ('application/_imagenesCSS/topMayo/topBonosMayo.PNG') ?>" download="Top 10 bonos de ofertas Car Paradise Mayo"><span class="glyphicon glyphicon-download-alt"></span></a></h4>
        <table class='table table-hover tablaTop'>
            <tr>
                <th style="text-align: center" class="col-xs-2 col-sm-2 col-md-2">Posición</th>
                <th style="text-align: center" class="col-xs-8 col-sm-8 col-md-8">Descripción</th>
                <th style="text-align: center" class="col-xs-2 col-sm-2 col-md-2">Cantidad</th>
            </tr>
            <?php
            $posiciones="";
            foreach ($topBonos as $topBono)
            {
                $posiciones++;
                echo "<tr>";
                echo "<td class='info'>".$posiciones."º.</td>";
                echo "<td class='success'>".$topBono['Descripcion']."</td>";
                echo "<td class='danger'>".$topBono['COUNT(Bono.Descripcion)']."</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 top">
        <h4>Top <span>clientes</span> VIPS <a title="Top 10 clientes Mayo" href="<?php echo base_url ('application/_imagenesCSS/topMayo/topClientesMayo.PNG') ?>" download="Top 10 clientes Car Paradise Mayo"><span class="glyphicon glyphicon-download-alt"></span></a></h4>
        <table class='table table-hover tablaTop'>
            <tr>
                <th style="text-align: center" class="col-xs-2 col-sm-2 col-md-2">Posición</th>
                <th style="text-align: center" class="col-xs-8 col-sm-8 col-md-8">Nombre completo</th>
                <th style="text-align: center" class="col-xs-2 col-sm-2 col-md-2">Cantidad</th>
            </tr>
            <?php
            $posiciones="";
            foreach ($topClientes as $topCliente)
            {
                $posiciones++;
                echo "<tr>";
                echo "<td class='info'>".$posiciones."º.</td>";
                echo "<td class='success'>".$topCliente['NombreCliente']." ".$topCliente['Apellido1Cliente']." ".$topCliente['Apellido2Cliente']."</td>";
                echo "<td class='danger'>".$topCliente['COUNT(Cliente.Dni)']."</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>