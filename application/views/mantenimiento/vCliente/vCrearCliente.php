<?php 
$DniV=""; 
$NombreClienteV="";
$Apellido1ClienteV="";
$Apellido2ClienteV="";
$TelefonoV="";
$ContrasenaV="";

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
    if ( ($NombreClienteV=="" || strlen($NombreClienteV)>30) || ($Apellido1ClienteV=="" || strlen($Apellido1ClienteV)>30) || ($Apellido2ClienteV=="" || strlen($Apellido2ClienteV)>30) || ($ContrasenaV=="" || strlen($ContrasenaV)>30) )
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
        $this->mCliente->fCrearCliente();
        echo "<div id='cajaCabecera' class='entradaAnadida alert alert-success'>Entrada añadida con éxito. Siga añadiendo si lo desea o vuelva.<span class='x'>X</span></div>";
        // echo "<script> alert ('Entrada añadida con éxito. Siga introduciendo si lo desea.') </script>";
        $DniV="";  $NombreClienteV="";    $Apellido1ClienteV="";  $Apellido2ClienteV="";    $ContrasenaV="";      $TelefonoV=""; // LAS PONGO A "" PARA INTRODUCIR MÁS
    }
}
?>
<center>
    <form class="form-horizontal mantenimiento" action='' method='POST'>
        <fieldset>
            <legend>Nuevo cliente</legend>

            <div class="<?php echo isset($mensajeDni) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-1 control-label" for="Dni">DNI: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-5">
                    <input maxLength=9 class="form-control" class="<?php echo isset($mensajeDni) ? 'inputError' : '' ?>" type="text" name="Dni" id="Dni" value='<?php echo $DniV ?>' />
                </div>    
            </div> 

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-1 control-label" for="NombreCliente">Nombre: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-5">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="NombreCliente" id="NombreCliente" value='<?php echo $NombreClienteV ?>' />
                </div>   
            </div>

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-3 control-label" for="Apellido1Cliente">Primer Apellido: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-3">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="Apellido1Cliente" id="Apellido1Cliente" value='<?php echo $Apellido1ClienteV ?>' />
                </div>   
            </div> 

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-3 control-label" for="Apellido2Cliente">Segundo Apellido: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-3">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="Apellido2Cliente" id="Apellido2Cliente" value='<?php echo $Apellido2ClienteV ?>' />
                </div>   
            </div> 

            <div class="<?php echo isset($mensajeTelefono) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-3 control-label" for="Telefono">Teléfono de contacto: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-3">
                    <input class="form-control" class="<?php echo isset($mensajeTelefono) ? 'inputError' : '' ?>" type="tel" name="Telefono" id="Telefono" value='<?php echo $TelefonoV ?>' />
                </div>   
            </div> 

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-3 control-label" for="Contrasena">Contraseña: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-3">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="password" name="Contrasena" id="Contrasena" value='<?php echo $ContrasenaV ?>' />
                </div>   
            </div> 
                
            </div>
            
            <div id="cajaErrores">
                <?php echo isset($mensajeDni) ? "<p class='pError'>$mensajeDni</p>":""; ?>
                <?php echo isset($mensaje30) ? "<p class='pError'>$mensaje30</p>":""; ?>
                <?php echo isset($mensajeTelefono) ? "<p class='pError'>$mensajeTelefono</p>":""; ?>
            </div>
            
            <input class="btn btn-danger" type="submit" value="Añadir"/>

        </fieldset>
    </form>
    <br/>
</center>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cCliente/fCliente/Clientes')?>"><span class="glyphicon glyphicon-hand-left"> Volver</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>