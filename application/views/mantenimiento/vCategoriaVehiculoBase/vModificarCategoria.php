<?php

$error=FALSE;
if (count($_POST)!=0)
{
    // RECOJO DATOS FORM
    $GrupoCategoriaV=$_POST["GrupoCategoria"]; 
    $NombreCategoriaV=$_POST["NombreCategoria"];

    // VALIDACIONES
    $formatoGrupoCategoria=preg_match('/^[A-Z]\d{0,1}$/', $GrupoCategoriaV); // EXRPRESION REGULAR PARA DNI
    if ($formatoGrupoCategoria!=1) 
    {
        $mensajeGrupoCategoria=" Grupo no válido, una letra mayúscula obligatoria + 1 dígito opcional. Ej: B2.";
        $error=TRUE;
    }
    if ( ($NombreCategoriaV=="" || strlen($NombreCategoriaV)>30) )
    {
        $mensaje30=" De 1 a 30 caracteres en nombre.";
        $error=TRUE;
    }
    if(!$error)
    {
        $this->mCategoriaVehiculoBase->fModificarCategoria($esaCategoria['GrupoCategoria']); // ESENCIAL EL ID PARA MODIFICAR EN EL WHERE DEL UPDATE
        echo "<script> alert ('Entrada modificada con éxito. Redireccionando...') </script>";
        redirect ('cCategoriaVehiculoBase/fCategoria/Categorias', 'location');    // REDIRIJO DESPUES DE HACER EL UPDATE AL LISTADO EN MANTENIMIENTO DE EMPRESAS
    }
}
?>
<center>
    <form class="form-horizontal mantenimiento" action='' method='POST'>
        <fieldset>
            <legend>Categoria a modificar: <?php echo $esaCategoria['NombreCategoria'] ?> </legend>

            <div class="<?php echo isset($mensajeGrupoCategoria) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="GrupoCategoria">Grupo: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensajeGrupoCategoria) ? 'inputError' : '' ?>" type="text" name="GrupoCategoria" id="GrupoCategoria" value="<?php if ($error){echo $GrupoCategoriaV;}else{echo $esaCategoria["GrupoCategoria"];} ?>"/> 
                </div>                                                                                                                    <!--tb sirve esto ->    ($error)   -->
            </div> 

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="NombreCategoria">Nombre: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="NombreCategoria" id="NombreCategoria" value="<?php if ($error){echo $NombreCategoriaV;}else{echo $esaCategoria["NombreCategoria"];} ?>"/> 
                </div>   
            </div>
            
            <div id="cajaErrores">
                <?php echo isset($mensajeGrupoCategoria) ? "<p class='pError'>$mensajeGrupoCategoria</p>":""; ?>
                <?php echo isset($mensaje30) ? "<p class='pError'>$mensaje30</p>":""; ?>
            </div>

            <input class="btn btn-primary" type="submit" value="Modificar"/>

        </fieldset>
    </form>
    <br/>
</center>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cCategoriaVehiculoBase/fCategoria/Categorias')?>"><span class="glyphicon glyphicon-hand-left"> Cancelar y volver</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>