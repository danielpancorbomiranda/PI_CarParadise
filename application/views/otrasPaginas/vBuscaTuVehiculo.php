<center>
    
    <section id="seccion">

        <h3 title="Busca tu vehículo">Busca tu vehículo</h3>

        <br/>
        
        <form class="form-horizontal" action='#' method="POST" id="formBuscar">

            <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">

                <select class='form-control' name="Categoria" id="Categoria">
                    <option selected value="">Categoria</option>
                    <?php 
                        foreach ($categorias as $categoria)
                        {
                            ?>
                                <option value="<?php echo $categoria['GrupoCategoria'] ?>"><?php echo $categoria['NombreCategoria'] ?></option>
                            <?php
                        }
                    ?>
                </select>

            </div>

            <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">

                <input class="form-control" placeholder="Marca" type="text" name="Marca" value="<?php //echo $dorsalPasado ?>" id="Marca"/>

            </div>

            <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
                
                <input class="form-control" placeholder="Modelo" type="text" name="Modelo" value="<?php //echo $dorsalPasado ?>" id="Modelo"/>
            
            </div>

            <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">

                <select class='form-control' name="Combustible" id="Combustible">
                    <option selected value="">Combustible</option>
                    <option value="Diésel">Diésel</option>
                    <option value="Gasolina">Gasolina</option>
                    <option value="Híbrido">Híbrido</option>
                    <option value="Eléctrico">Eléctrico</option>
                </select>

            </div>

            <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">

                <select class='form-control' name="Km" id="Km">
                    <option selected value="">Kilometraje</option>
                    <option value="5000">Hasta 5.000 Km</option>
                    <option value="10000">Hasta 10.000 Km</option>
                    <option value="15000">Hasta 15.000 Km</option>
                </select>

            </div>

            <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">

                <select class="form-control" name="Base" id="Base">
                    <option selected value="">Base (Localidad)</option>
                        <?php 
                        foreach ($bases as $base)
                        {
                            ?>
                                <option value="<?php echo $base['CodigoBase'] ?>"><?php echo $base['NombreBase']." (".$base['Localidad'].")" ?></option>
                            <?php
                        }
                        ?>
                </select>

            </div>

            <input class="botonesIndex" type="submit" value="Filtrar" id="botonFiltrar">

        </form>		

        <div style="padding:1%" id='ContenidoResultados'>
            <table class='table table-hover'>
                <thead id="Thead">
                    <tr>
                        <th class='col-xs-1 col-sm-1 col-md-1'>Color</th>
                        <th class='col-xs-1 col-sm-1 col-md-1'>Categoria</th>
                        <th class='col-xs-1 col-sm-1 col-md-1'>Matrícula</th>
                        <th class='col-xs-1 col-sm-1 col-md-1'>Marca</th>
                        <th class='col-xs-1 col-sm-1 col-md-1'>Modelo</th>
                        <th class='col-xs-1 col-sm-1 col-md-1'>Km</th>
                        <th class='col-xs-1 col-sm-1 col-md-1'>Combustible</th>
                        <th class='col-xs-2 col-sm-2 col-md-2'>Base</th>
                        <th class='col-xs-1 col-sm-1 col-md-1'>Ubicación</th>
                        <th class='col-xs-1 col-sm-1 col-md-1'>Estado</th>
                        <th style="text-align:center" class='col-xs-1 col-sm-1 col-md-1'>Reservar</th>
                    </tr>	
                </thead>
                <tbody id='Tbody'>
                </tbody>
            </table>
        </div>	
        
        <div style="display:none" id='noEncontrado' class='alert alert-dismissible alert-danger' >
            <b>Ningún vehículo encontrado:</b> Vuelva a buscar con otros criterios.<span title="Cerrar" class='x'>X</span>
        </div>

    </section>

</center>