<?php
//  PARA QUE VUELVA AL LOGIN SI NO HAS INICIADO SESION
session_start();
if (!isset($titulo))
{
    $titulo="Listado compacto";
}
if (isset($queesdeBBC) && isset($identificador))
{
    $concateno=", $queesdeBBC $identificador.";
}
else
{
    $concateno=".";
}
if (!isset($_SESSION["empleadoLogueado"]))
{
    echo "<script> alert ('Car Paradise informa: Por favor, inicie sesión para acceder.') </script>";
    redirect ('rutaLoguin', 'location');
}   

// MI METODO CARGADO PARA ABRIR EL HTML Y AL FINAL CERRARLO, LO CARGA DE LA LIBRERIA
    // PARA LA CAJA DE SESIÓN
else
{
    $this->abrir_cerrar_html->Abrir("Mant. Car Paradise"); //OJO, esto es solo para ponerle la caja que desaparece, ya que esolo en esto cargo js y jquery
    if ($titulo=="Indice") {$titulo="Índice";} else if ($titulo=="Vehiculos"){$titulo="Vehículos";} // para el acento
    echo "<div class='alert alert-info' id='cajaCabecera'>" ?>
            <div class='cajaLogo'><img src="<?php echo base_url ('application/_imagenesCSS/logoMantenimientoIzquierda.png') ?>" alt="logoCarParadise" /></div>
            <?php echo "<div class='cajaCarParadise'><span class='cabecera'>Mantenimiento: </span> $titulo$concateno</div>" ?>
            <div class='cajaSesion'><h4> <?php echo $_SESSION['empleadoLogueado']; ?></h4> 
            <h2><a href="<?php echo site_url ('rutaLoguin')?>"><span class="glyphicon glyphicon-off"></span></a></h2>
            <h4><?php echo date('l d F'); ?></h4> 
            </div>
            <?php
    echo "</div>";
}
?>

