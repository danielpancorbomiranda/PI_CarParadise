<div id="principal">
    <div id="inner-principal">
        <div id="menuCategorias"><p>Categorias</p>
            <ul>
            <?php
            foreach ($categoriasMenu as $categoria)
            {
            ?>
                <li><a href="<?php echo site_url ('cOtrasPaginas/fPinchaCategoria/'.$categoria['GrupoCategoria'])?>"> &nbsp;<?php echo $categoria['NombreCategoria'] ?></a></li>
            <?php
            }
            ?>
            </ul>
        </div>
        <div id="novedades">
            <h3><?php echo (!empty($vehiculos2NovedadesDeCategoria)) ? $vehiculos2NovedadesDeCategoria[0]['NombreCategoria'].": Últimas novedades" : "Sin novedades" ?></h3>
            <?php
            foreach ($vehiculos2NovedadesDeCategoria as $v2NDC)
            {
            ?>
            <div class="vehiculos2Novedades">
                <div class="relativo">
                    <?php echo "<div class='estado'><h4>".$v2NDC["Estado"]."</h4></div>" ?>
                    <?php echo "<img width='100%' height='auto' src='data:image/jpeg;base64,".base64_encode($v2NDC["Imagen"])."' alt='vehiculo disponible' />"; ?>
                </div>
                <div>
                    <p><?php echo "<span class='colorMarcaModelo'>".$v2NDC["Marca"]." ".$v2NDC["Modelo"]."</span><br/>".$v2NDC["Potencia"]." CV. Ubicación: ".$v2NDC["NombreBase"]." (".$v2NDC["Localidad"].")." ?></p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div id="resto">
        <h3><?php echo (!empty($vehiculos12DisponiblesDeCategoria)) ? $vehiculos12DisponiblesDeCategoria[0]['NombreCategoria'].": Recomendaciones disponibles" : "Sin recomendaciones disponibles" ?></h3>
        <?php
        foreach ($vehiculos12DisponiblesDeCategoria as $v12NDC)
        {
        ?>
        <div class="vehiculos12Disponibles">
            <div class="relativo">
                <div class='reservar'><h4><a href="<?php echo site_url ('cOtrasPaginas/fReserva/'.$v12NDC['Matricula'])?>">¡ Resérvalo aquí !</a></h4></div>
                <?php echo "<img width='100%' height='auto' src='data:image/jpeg;base64,".base64_encode($v12NDC["Imagen"])."' alt='vehiculo disponible' />"; ?>
            </div>
            <div>
                <p><?php echo "<span class='colorMarcaModelo'>".$v12NDC["Marca"]." ".$v12NDC["Modelo"]."</span><br/>".$v12NDC["Potencia"]." CV con ".$v12NDC["Km"]." Kms (".$v12NDC['Combustible'].").<br/>Ubicación: ".$v12NDC["NombreBase"]." (".$v12NDC["Localidad"].")."?></p>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <br/ style="clear:both">
</div>