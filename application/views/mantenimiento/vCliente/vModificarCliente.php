<?php
$error=FALSE;
if (count($_POST)!=0)
{
    // RECOJO DATOS FORM
    $DniV=$_POST["Dni"]; 
    $NombreClienteV=$_POST["NombreCliente"];
    $Apellido1ClienteV=$_POST["Apellido1Cliente"];
    $Apellido2ClienteV=$_POST["Apellido2Cliente"];
    $TelefonoV=$_POST["Telefono"];
    $ContrasenaV=$_POST["Contrasena"];

    // VALIDACIONES
    $formatoDni=preg_match('/^\d{8}[a-zA-Z]$/', $DniV); // EXRPRESION REGULAR PARA DNI
    if ($formatoDni!=1)
    {
        $mensajeDni=" DNI no válido, ej: 77345252R.";
        $error=TRUE;
    }
    if ( ($NombreClienteV=="" || strlen($NombreClienteV)>30) || ($Apellido1ClienteV=="" || strlen($Apellido1ClienteV)>30) || ($Apellido2ClienteV=="" || strlen($Apellido2ClienteV)>30) || ($ContrasenaV=="" || strlen($ContrasenaV)>30)  )
    {
        $mensaje30=" De 1 a 30 caracteres en nombre, primer apellido y segundo apellido.";
        $error=TRUE;
    }
    $formatoTelefono=preg_match('/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/', $TelefonoV); // EXRPRESION REGULAR PARA NIF
    if ($formatoTelefono!=1)
    {
        $mensajeTelefono=" Teléfono no válido, ej: 650801568.";
        $error=TRUE;
    }
    if(!$error)
    {
        $this->mCliente->fModificarCliente($eseCliente["Dni"]); // ESENCIAL EL ID PARA MODIFICAR EN EL WHERE DEL UPDATE
        echo "<script> alert ('Entrada modificada con éxito. Redireccionando...') </script>";
        redirect ('cCliente/fCliente/Clientes', 'location');    // REDIRIJO DESPUES DE HACER EL UPDATE AL LISTADO EN MANTENIMIENTO DE EMPRESAS
    }
}
?>
<center>
    <form class="form-horizontal mantenimiento" action='' method='POST'>
        <fieldset>
            <legend>Cliente a modificar: <?php echo $eseCliente['NombreCliente']." ".$eseCliente['Apellido1Cliente']." ".$eseCliente['Apellido2Cliente'] ?> </legend>

            <div class="<?php echo isset($mensajeDni) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-1 control-label" for="Dni">DNI: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-5">
                    <input maxLength=9 class="form-control" class="<?php echo isset($mensajeDni) ? 'inputError' : '' ?>" type="text" name="Dni" id="Dni" value="<?php if (count($_POST)!=0){echo $DniV;}else{echo $eseCliente["Dni"];} ?>"/> 
                </div>                                                                                                                    <!--tb sirve esto ->    ($error)   -->
            </div> 

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-1 control-label" for="NombreCliente">Nombre: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-5">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="NombreCliente" id="NombreCliente" value="<?php if ($error){echo $NombreClienteV;}else{echo $eseCliente["NombreCliente"];}?>" />
                </div>   
            </div>

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-3 control-label" for="Apellido1Cliente">Primer Apellido: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-3">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="Apellido1Cliente" id="Apellido1Cliente" value="<?php if (count($_POST)!=0){echo $Apellido1ClienteV;}else{echo $eseCliente["Apellido1Cliente"];}?>" />
                </div>   
            </div> 

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-3 control-label" for="Apellido2Cliente">Segundo Apellido: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-3">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="Apellido2Cliente" id="Apellido2Cliente" value="<?php if (count($_POST)!=0){echo $Apellido2ClienteV;}else{echo $eseCliente["Apellido2Cliente"];}?>" />
                </div>   
            </div> 

            <div class="<?php echo isset($mensajeTelefono) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-3 control-label" for="Telefono">Teléfono de contacto: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-3">
                    <input class="form-control" class="<?php echo isset($mensajeTelefono) ? 'inputError' : '' ?>" type="tel" name="Telefono" id="Telefono" value="<?php if (count($_POST)!=0){echo $TelefonoV;}else{echo $eseCliente["Telefono"];}?>" />
                </div>   
            </div> 

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-3 control-label" for="Contrasena">Contraseña: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-3">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="password" name="Contrasena" id="NombreEmpleado" value="<?php if ($error){echo $ContrasenaV;}else{echo $eseCliente["Contrasena"];}?>" />
                </div>   
            </div> 
            
            <div id="cajaErrores">
                <?php echo isset($mensajeDni) ? "<p class='pError'>$mensajeDni</p>":""; ?>
                <?php echo isset($mensaje30) ? "<p class='pError'>$mensaje30</p>":""; ?>
                <?php echo isset($mensajeTelefono) ? "<p class='pError'>$mensajeTelefono</p>":""; ?>
            </div>
            
            <input class="btn btn-danger" type="submit" value="Modificar"/>

        </fieldset>
    </form>
    <br/>
</center>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cCliente/fCliente/Clientes')?>"><span class="glyphicon glyphicon-hand-left"> Cancelar y volver</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>