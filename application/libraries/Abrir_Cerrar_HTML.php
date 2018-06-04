<?php
/*
*  MI METODO QUE LO CARGO, ANTES CON EL REQUIRE_ONCE, AL PONERLO EN LIBRERIAS, ME CARGA SOLO,
*  ME VIENE DE LUJO, ES PARA Abrir o Cerrar el HTML (PASANDOLE 1 TITULO COMO PARAMETRO)
*/
    class Abrir_Cerrar_HTML
    {
        public function Abrir ($titulo)
        {     
            ?>     
                <!DOCTYPE html> <!-- CARGO TODAS MIS LIBRERIAS -->
                <html>
                <head>
                    <title><?php echo $titulo ?></title>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <!--Lo de BS-->
                        <link href="<?php echo base_url ('application/_libBS/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
                        <link href="<?php echo base_url ('application/_libBS/css/bootstrap-theme.min.css')?>" rel="stylesheet" type="text/css" />
							<link href="<?php echo base_url ('application/_libOC/OwlCarousel/dist/assets/owl.carousel.min.css')?>" rel="stylesheet" type="text/css" />
							<link href="<?php echo base_url ('application/_libOC/OwlCarousel/dist/assets/owl.theme.default.min.css')?>" rel="stylesheet" type="text/css" />
                        <script type="text/javascript" src="<?php echo base_url ('application/_libJQ/jquery-3.1.1.min.js') ?>"></script>
                        <script language="javascript" src="<?php echo base_url ('application/_libBS/js/bootstrap.min.js') ?>"></script>
							<script type="text/javascript" src="<?php echo base_url ('application/_libOC/OwlCarousel/dist/owl.carousel.min.js') ?>"> </script>
                    <link href="<?php echo base_url ('application/_miCSS/miCSS.css') ?>" rel='stylesheet' type='text/css' />
                    <script type="text/javascript" src="<?php echo base_url ('application/_miJS/miJS.js') ?>"> </script>
                    <link rel="shortcut icon" href="<?php echo base_url ('application/_imagenesCSS/favicon.png')?>" type="image/png" />
                </head>
                <body>
            <?php
        }   
        public function Cerrar ()
        {
            echo "</body></html>"; 
        }
    }
?>