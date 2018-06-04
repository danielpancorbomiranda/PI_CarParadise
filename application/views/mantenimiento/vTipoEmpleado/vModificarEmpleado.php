<?php

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
        $this->mTipoEmpleado->fModificarEmpleado($eseEmpleado["ApodoEmpleado"]); // ESENCIAL EL ID PARA MODIFICAR EN EL WHERE DEL UPDATE
        echo "<script> alert ('Entrada modificada con éxito. Redireccionando...') </script>";
        redirect ('cTipoEmpleado/fEmpleado/Empleados/'.$eseEmpleado['IdTipo'], 'location');    // REDIRIJO DESPUES DE HACER EL UPDATE AL LISTADO EN MANTENIMIENTO DE EMPRESAS
    }
}
?>
<center>
    <form class="form-horizontal mantenimiento" action='' method='POST'>
        <fieldset>
            <legend>Empleado a modificar: <?php echo $eseEmpleado['NombreEmpleado'] ?> </legend>

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="ApodoEmpleado">Apodo: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="ApodoEmpleado" id="ApodoEmpleado" value="<?php if ($error){echo $ApodoEmpleadoV;}else{echo $eseEmpleado["ApodoEmpleado"];}?>" />
                </div>                                                                                                                    <!--tb sirve esto ->    ($error)   -->
            </div> 

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="NombreEmpleado">Nombre: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="text" name="NombreEmpleado" id="NombreEmpleado" value="<?php if ($error){echo $NombreEmpleadoV;}else{echo $eseEmpleado["NombreEmpleado"];}?>" />
                </div>   
            </div>

            <div class="<?php echo isset($mensaje30) ? 'has-error' : 'has-success' ?>" >
                <label class="col-xs-6 col-sm-4 col-md-2 control-label" for="Contrasena">Contraseña: </label> <!--for busca el primer id-->
                <div class="col-xs-6 col-sm-8 col-md-10">
                    <input class="form-control" class="<?php echo isset($mensaje30) ? 'inputError' : '' ?>" type="password" name="Contrasena" id="NombreEmpleado" value="<?php if ($error){echo $ContrasenaV;}else{echo $eseEmpleado["Contrasena"];}?>" />
                </div>   
            </div> 
            
            <div id="cajaErrores">
                <?php echo isset($mensaje30) ? "<p class='pError'>$mensaje30</p>":""; ?>
            </div>

            <input class="btn btn-danger" type="submit" value="Modificar"/>

        </fieldset>
    </form>
    <br/>
</center>
<div class="enlacesInferiores">
    <a href="<?php echo site_url ('cTipoEmpleado/fEmpleado/Empleados/'.$eseEmpleado['IdTipo']) ?>"><span class="glyphicon glyphicon-hand-left"> Cancelar y volver<span></a>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>