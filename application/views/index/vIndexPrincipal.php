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
            <h3>Últimas novedades</h3>
            <?php
                foreach ($vehiculos2Novedades as $v2N)
                {
                ?>
                <div class="vehiculos2Novedades">
                    <div class="relativo">
                        <?php echo "<div class='estado'><h4>".$v2N["Estado"]."</h4></div>" ?>
                        <?php echo "<img width='100%' height='auto' src='data:image/jpeg;base64,".base64_encode($v2N["Imagen"])."' alt='vehiculo disponible' />"; ?>
                    </div>
                    <div>
                        <p><?php echo "<span class='colorMarcaModelo'>".$v2N["Marca"]." ".$v2N["Modelo"]."</span><br/>".$v2N["Potencia"]." CV. Ubicación: ".$v2N["NombreBase"]." (".$v2N["Localidad"].")." ?></p>
                    </div>
                </div>
                <?php
                }
            ?>
        </div>
    </div>
    <div id="resto">
        <h3>Vehículos disponibles recomendados</h3>
        <?php
        foreach ($vehiculos12Disponibles as $v12D)
        {
        ?>
        <div class="vehiculos12Disponibles">
            <div class="relativo">
                <div class='reservar'><h4><a href="<?php echo site_url ('cOtrasPaginas/fReserva/'.$v12D['Matricula'])?>">¡ Resérvalo aquí !</a></h4></div>
                <?php echo "<img width='100%' height='auto' src='data:image/jpeg;base64,".base64_encode($v12D["Imagen"])."' alt='vehiculo disponible' />"; ?>
            </div>
            <div>
                <p><?php echo "<span class='colorMarcaModelo'>".$v12D["Marca"]." ".$v12D["Modelo"]."</span><br/>".$v12D["Potencia"]." CV con ".$v12D["Km"]." Kms (".$v12D['Combustible'].").<br/>Ubicación: ".$v12D["NombreBase"]." (".$v12D["Localidad"].")."?></p>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <br/ style="clear:both">
</div>