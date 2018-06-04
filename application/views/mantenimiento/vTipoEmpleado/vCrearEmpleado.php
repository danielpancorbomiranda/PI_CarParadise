<?php
$ApodoEmpleadoV=""; 
$NombreEmpleadoV="";
$ContrasenaV="";

$error=FALSE;
if (count($_POST)!=0)
{
    // RECOJO DATOS FORM
    $ApodoEmpleadoV=$_POST["ApodoEmpleado"]; 
    $NombreEmpleadoV=$_POST["NombreEmpleado"];
    $ContrasenaV=$_POST["Contrasena"];

    // VALIDACIONES
    if ( ($ApodoEmpleadoV=="" || strlen($ApodoEmpleadoV)>30) || ($NombreEmpleadoV=="" || strlen($NombreEmpleadoV)>30) || ($ContrasenaV=="" || strlen($ContrasenaV)>30)  )
    {
        $mensaje30=" De 1 a 30 caracteres en apodo, nombre y contraseña.";
        $error=TRUE;
    }
    if(!$error)
    {
        $this->mTipoEmpleado->fCrearEmpleado($idTipoPasado);
        // echo "<div id='cajaCabecera' class='entradaAnadida alert alert-success'>Entrada añadida con éxito. Siga añadiendo si lo desea o vuelva.<span class='x'>X</span></div>";
        // echo "<script> alert ('Entrada añadida con éxito. Siga introduciendo si lo desea.') </script>";
        $ApodoEmpleadoV="";    $NombreEmpleadoV="";   $ContrasenaV="";    
    }
}
?>
<center>
    <form class="form-horizontal mantenimiento" action='' method='POST'>
        <fieldset>
            <legend>Nuevo empleado</legend>

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="ApodoEmpleado">Apodo: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="ApodoEmpleado" id="ApodoEmpleado" value='<?php echo $ApodoEmpleadoV ?>' />
                </div>                                                                                                                    <!--tb sirve esto ->    ($error)   -->
            </div> 

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="NombreEmpleado">Nombre: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="NombreEmpleado" id="NombreEmpleado" value='<?php echo $NombreEmpleadoV ?>' />
                </div>   
            </div>

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="Contrasena">Contraseña: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="password" name="Contrasena" id="Contrasena" value='<?php echo $ContrasenaV ?>' />
                </div>   
            </div> 
            
            <div id="cajaErrores">
                <?php echo isset($mensaje30) ? "<p class='pError'>$mensaje30</p>":""; ?>
            </div>

            <input class="btn btn-danger" type="submit" value="Añadir"/>

        </fieldset>
    </form>
    <br/>
</center>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cTipoEmpleado/fEmpleado/Empleados/'.$idTipoPasado)?>"><span class="glyphicon glyphicon-hand-left"> Volver</span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>