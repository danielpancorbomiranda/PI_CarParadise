<?php
    session_start(); // IMPORTANTE, LO HAGO CON VARIABLE DE SESION PARAQUE QUE NO SE ACCEDE SIN HABERSE LOGUEADO
    $this->abrir_cerrar_html->Abrir("Car Paradise"); 
?>
<div id="contenedor">
    <header>
        <div id="inner-header">
            <div <?php echo ( isset($_SESSION["dniUsuarioLogueado"]) && isset($_SESSION["nombreEnteroUsuarioLogueado"]) ) ? "style='display:none'" : "" ?> class='col-xs-2 col-sm-2 col-md-2 col-lg-2 cajaLogoGif'>
                <a href="<?php echo site_url ('')?>">
                    <img src="<?php echo base_url ('application/_imagenesCSS/logoMantenimientoIzquierda.gif') ?>" alt="logoCarParadise" />
                </a>
            </div>
            <?php 
            if (!isset($_SESSION["dniUsuarioLogueado"]) && !isset($_SESSION["nombreEnteroUsuarioLogueado"]))
            {
            ?>
            <div style="display:none" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 cajaAreaPersonal">
            <center>
                <form class="form-horizontal" action='' method="POST">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-control">
                        <input maxLength='9' style="margin:0.5%" placeholder="DNI de usuario" class="form-control" type="text" name="cajaDniUsuario" value='' id="cajaDniUsuario" />
                    </div>    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-control">
                        <input style="margin:0.5%" placeholder="Clave de acceso" class="form-control" type="password" name="cajaContrasenaUsuario" value='' id="cajaContrasenaUsuario"/>
                    </div>   
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-control">
                        <input style="margin:0.5%" class="botonesIndex" name="iniciaSesionUsuario" type="button" id="iniciaSesionUsuario" value="Iniciar sesión"/>
                    </div>
                </form>
            </center>
            </div>
            <?php
            }
            else
            {
            ?>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 cajaAreaPersonal">
            <center> 
                <form action='<?php echo site_url ('cIndex/fCerrarSesionUsuario') ?>'>
                    <div style="margin:0.5%" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-control">
                        <span><?php echo $_SESSION["nombreEnteroUsuarioLogueado"]; ?></span>
                    </div>    
                    <div style="margin:0.5%" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-control">
                         <span><?php echo $_SESSION["dniUsuarioLogueado"]; ?></span>
                    </div>   
                    <div style="margin:0.5%" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-control">
                        <input class="botonesIndex" name="Desconecta" type="submit" value="Desconexión"/>
                    </div>
                </form>
            </center>
            </div>
            <?php
            }
            ?>
            <nav>
                <ul>
                    <!--Nota: Los li del menú (nav) lo comprimo en una linea porque no me gusta un huequecillo que deja sino lo hago.-->
                    <li><a href="<?php echo site_url ('')?>"><span class="glyphicon glyphicon-home"></span><span class="fueraDisplay"> Inicio</span></a></li><li><a href="<?php echo site_url ('cOtrasPaginas/fTopCarParadise')?>"><span class="glyphicon glyphicon-fire"></span><span class="fueraDisplay"> Top Car Paradise</span></a></li><li><a href="<?php echo site_url ('cOtrasPaginas/fBuscaTuVehiculo')?>"><span class="glyphicon glyphicon-search"></span><span class="fueraDisplay"> Busca tu vehículo</span></a></li><?php if (!isset($_SESSION["dniUsuarioLogueado"]) && !isset($_SESSION["nombreEnteroUsuarioLogueado"])) {?><li id="liAreaPersonal"><a href="#"><span class="glyphicon glyphicon-user"></span><span class="fueraDisplay"> Área personal</span></a></li><?php }else {?><li><a href="<?php echo site_url ('cOtrasPaginas/fMiHistorial/'.$_SESSION["dniUsuarioLogueado"])?>"><span class="glyphicon glyphicon-list"></span><span class="fueraDisplay"> Mi historial</span></a></li><?php }?><li><a href="<?php echo site_url ('rutaLoguin')?>"><span class="glyphicon glyphicon-wrench"></span><span class="fueraDisplay"> Área privada</a></li>
                </ul>
            </nav>
        </div>
        <div id="inner-header2">
            <div style="text-align: right"><span title="Cerrar este banner" class='xBanner'>[ X ]</span></div>
            <div class="owl-carousel owl-theme">
                <div class="item"> 
                    <img src="<?php echo base_url ('application/_imagenesCSS/carrusel/car1.jpg')?>" alt="publicidad">
                </div>        
                <div class="item">
                    <img src="<?php echo base_url ('application/_imagenesCSS/carrusel/car2.jpg')?>" alt="publicidad">
                </div>     
                <div class="item">
                    <img src="<?php echo base_url ('application/_imagenesCSS/carrusel/viveDisfruta.gif')?>" alt="publicidad">
                </div>   
                <div class="item">
                    <img src="<?php echo base_url ('application/_imagenesCSS/carrusel/car6.jpg')?>" alt="publicidad">
                </div>    
                <div class="item">
                    <img src="<?php echo base_url ('application/_imagenesCSS/carrusel/car3.jpg')?>" alt="publicidad">
                </div>
                <div class="item">
                    <img src="<?php echo base_url ('application/_imagenesCSS/carrusel/car7.jpg')?>" alt="publicidad">
                </div>
                <div class="item">
                    <img src="<?php echo base_url ('application/_imagenesCSS/carrusel/car4.jpg')?>" alt="publicidad">
                </div>  
                <div class="item">
                    <img src="<?php echo base_url ('application/_imagenesCSS/carrusel/car8.jpg')?>" alt="publicidad">
                </div>  
                <div class="item">
                    <img src="<?php echo base_url ('application/_imagenesCSS/carrusel/car5.jpg')?>" alt="publicidad">
                </div>
		    </div>
        </div>
    </header>