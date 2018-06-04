<?php
$GrupoCategoriaV=""; 
$NombreCategoriaV="";

$error=FALSE;
if (count($_POST)!=0)
{
    // RECOJO DATOS FORM
    $GrupoCategoriaV=$_POST["GrupoCategoria"]; 
    $NombreCategoriaV=$_POST["NombreCategoria"];

    // VALIDACIONES
    $formatoGrupoCategoria=preg_match('/^[A-Z]\d{0,1}$/', $GrupoCategoriaV); // EXRPRESION REGULAR PARA DNI
    if ($formatoGrupoCategoria!=1) // similar a código postal
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
        $this->mCategoriaVehiculoBase->fCrearCategoria();
        // echo "<div id='cajaCabecera' class='entradaAnadida alert alert-success'>Entrada añadida con éxito. Siga añadiendo si lo desea o vuelva.<span class='x'>X</span></div>";
        // echo "<script> alert ('Entrada añadida con éxito. Siga introduciendo si lo desea.') </script>";
        $GrupoCategoriaV="";    $NombreCategoriaV="";    
    }
}
?>
<center>
    <form class="form-horizontal mantenimiento" action='' method='POST'>
        <fieldset>
            <legend>Nueva categoria de vehículo</legend>

            <div class="<?php echo isset($mensajeGrupoCategoria) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="GrupoCategoria">Grupo: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensajeGrupoCategoria) ? 'inputError' : '' ?>" type="text" name="GrupoCategoria" id="GrupoCategoria" value='<?php echo $GrupoCategoriaV ?>' />
                </div>                                                                                                                    <!--tb sirve esto ->    ($error)   -->
            </div> 

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="NombreCategoria">Nombre: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="NombreCategoria" id="NombreCategoria" value='<?php echo $NombreCategoriaV ?>' />
                </div>   
            </div>
            
            <div id="cajaErrores">
                <?php echo isset($mensajeGrupoCategoria) ? "<p class='pError'>$mensajeGrupoCategoria</p>":""; ?>
                <?php echo isset($mensaje30) ? "<p class='pError'>$mensaje30</p>":""; ?>
            </div>

            <input class="btn btn-primary" type="submit" value="Añadir"/>

        </fieldset>
    </form>
    <br/>
</center>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cCategoriaVehiculoBase/fCategoria/Categorias')?>"><span class="glyphicon glyphicon-hand-left"> Volver</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>