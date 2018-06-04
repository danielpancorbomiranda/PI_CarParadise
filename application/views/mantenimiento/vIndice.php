<div id="contenedorMantenimiento">
    <h3>Menú principal <span class="letrasMagneto">Car Paradise</span></h3>
    
    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cCategoriaVehiculoBase/fVehiculoCompacto') ?>" class="btn btn-primary">Vehículos</a>
    </div>

    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cAlquilerBono/fAlquilerCompacto') ?>" class="btn btn-success">Alquileres</a>
    </div>

    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cCliente/fCliente/Clientes') ?>" class="btn btn-danger">Clientes</a>
    </div>

    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cCategoriaVehiculoBase/fBase/Bases') ?>" class="btn btn-primary">Bases</a>
        <a href="<?php echo site_url ('cAlquilerBono/fBono/Bonos') ?>" class="btn btn-success">Bonos</a>
        <a href="<?php echo site_url ('cCategoriaVehiculoBase/fCategoria/Categorias') ?>" class="btn btn-primary">Categorias</a>
    </div>

    <div class="btn-group btn-group-justified">
        <a href="<?php echo site_url ('cTipoEmpleado/fTipo/Tipos') ?>" class="btn btn-danger">Tipos / Empleados</a>
    </div>

</div>

<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>