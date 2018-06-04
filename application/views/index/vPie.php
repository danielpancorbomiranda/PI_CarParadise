    <footer>
        <div id="inner-footer">
            <h3 title="Marcas de vehículos">Nuestras marcas pioneras de vehículos</h3>
            <div id="marcasDeVehiculos" class="row">
                <!--class="row"-->
                    <!--EN UN FUTURO PODRIA HACERLO AÑADIENDO UNA FOTO PARA EMRESAS O CREANDO TABLA PARA MARCAS O ALLGO ASÍ -->
                <!--<div class="logoCitroen col-xs-4 col-sm-4 col-md-2"></div>
                <div class="logoAudi col-xs-4 col-sm-4 col-md-2"></div>
                <div class="logoFerrari col-xs-4 col-sm-4 col-md-2"></div>
                <div class="logoLamb col-xs-4 col-sm-4 col-md-2"></div>
                <div class="logoRenault col-xs-4 col-sm-4 col-md-2"></div>
                <div class="logoSuzuki col-xs-4 col-sm-4 col-md-2"></div>-->

                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    <img class="logoHonda" src="<?php echo base_url ('application/_imagenesCSS/logos_marcas/logo_honda.jpg')?>" width="100%" height="auto">                
                </div>
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    <img class="logoSeat" src="<?php echo base_url ('application/_imagenesCSS/logos_marcas/logo_seat.jpg')?>" width="100%" height="auto">                
                </div>
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    <img class="logoPeugeot" src="<?php echo base_url ('application/_imagenesCSS/logos_marcas/logo_peugeot.jpg')?>" width="100%" height="auto">                
                </div>   
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    <img class="logoW" src="<?php echo base_url ('application/_imagenesCSS/logos_marcas/logo_w.jpg')?>" width="100%" height="auto">                
                </div>
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    <img class="logoAudi" src="<?php echo base_url ('application/_imagenesCSS/logos_marcas/logo_audi.jpg')?>" width="100%" height="auto">                
                </div>  
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    <img class="logoFerrari" src="<?php echo base_url ('application/_imagenesCSS/logos_marcas/logo_ferrari.jpg')?>" width="100%" height="auto">                
                </div> 
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    <img class="logoLamb" src="<?php echo base_url ('application/_imagenesCSS/logos_marcas/logo_lamb.jpg')?>" width="100%" height="auto">                
                </div> 
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    <img class="logoBmw" src="<?php echo base_url ('application/_imagenesCSS/logos_marcas/logo_bmw.jpg')?>" width="100%" height="auto">                
                </div>
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    <img class="logoRenault" src="<?php echo base_url ('application/_imagenesCSS/logos_marcas/logo_renault.jpg')?>" width="100%" height="auto">                
                </div>
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    <img class="logoFord" src="<?php echo base_url ('application/_imagenesCSS/logos_marcas/logo_ford.jpg')?>" width="100%" height="auto">                
                </div>
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    <img class="logoCitroen" src="<?php echo base_url ('application/_imagenesCSS/logos_marcas/logo_citroen.jpg')?>" width="100%" height="auto">                
                </div>                                                                   
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    <img class="logoSuzuki" src="<?php echo base_url ('application/_imagenesCSS/logos_marcas/logo_suzuki.jpg')?>" width="100%" height="auto">                
                </div>
            </div>
            <!--<br/ style="clear:both">-->
        </div>
        <div id="inner-footer2">
            <span class="verTelefonoEmail">Ver email / teléfono: <span><span class="glyphicon glyphicon-envelope"></span> info@carparadise.dpm</span><span style="display:none"><span class="glyphicon glyphicon-earphone"></span> (+34) 650 801 568</span></span>&nbsp;&nbsp;
            <a href="<?php echo site_url ('')?>">Inicio</a>&nbsp; | &nbsp;
            <a href="<?php echo site_url ('cOtrasPaginas/fTopCarParadise')?>">Top Car Paradise</a>&nbsp; | &nbsp;
            <a href="<?php echo site_url ('rutaLoguin')?>">Área Privada</a>&nbsp;&nbsp;
            <span>© Copyright <?php echo date('Y'); ?></span> 
        </div>
    </footer>
</div> <!-- este div es del CONTENEDOR GLOBAL -->
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>
