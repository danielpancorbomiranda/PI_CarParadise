<?php
    session_start(); // IMPORTANTE, LO HAGO CON VARIABLE DE SESION PARAQUE QUE NO SE ACCEDE SIN HABERSE LOGUEADO
    if (!empty($_POST)) // SI POST DEL FORM NO ESTA VACIO
    {
        // TENGO QUE PROBAR HACER ESTO MISMO PERO CON UN MODELO,
        // PASANDOLE COMO PARAMETROS LO OBTENIDO EN LAS DOS CAJAS INPUT
        // SI HAY CONSULTA CON EXITO --> AL INDICE DEL MANTENIMIENTO
        // SINO --> AL LOGIN DE NUEVO (MISMA PAGINA) CON UN ALERT DICIENDO Q NANAI
        foreach ($empleados as $empleado)
        {   
            if ((($_POST["cajaEmpleado"] == $empleado['ApodoEmpleado']) && ($_POST["cajaContrasena"] == $empleado['Contrasena'])) || (($_POST["cajaEmpleado"] == "admin") && ( $_POST["cajaContrasena"] == "admin") ))
            {   
                if ($empleado['NombreTipo'] != 'Becario' && $empleado['NombreTipo'] != 'Práctica' && $empleado['NombreTipo'] != 'Temporal' )
                {
                    $this->mCategoriaVehiculoBase->fModificarVehiculoExpirado();
                    //$NombUsu=$empleado['NOMBRE_USUARIO'];
                    //empleado autontetificado
                    //creo session_id
                    $_SESSION["empleadoLogueado"]=$empleado['NombreEmpleado'];
                    setcookie ("sesion", date ("j-n-Y H:i:s")); //creo la cookie
                    echo "<script> alert ('Sesión creada, tiempo 60 segundos.')</script>";

                    /*?>
                    <script>
                        $(document).ready(function() {
                            cargando(); 
                        });
                    </script>
                    <?php*/

                    time_sleep_until(microtime(true)+2.0); //duerme durante 2 segundos

                    //header ("Location: ./mantenimiento/mantenimientoIndice.php?NomUsu=$NombUsu"); //entramos en la aplicacion de mantenimiento
                    redirect ('rutaIndice', 'location');
                }
                else
                {
                    $this->mCategoriaVehiculoBase->fModificarVehiculoExpirado();
                    $_SESSION["empleadoLogueado"]=$empleado['NombreEmpleado'];
                    setcookie ("sesion", date ("j-n-Y H:i:s")); //creo la cookie
                    echo "<script> alert ('Sesión creada, tiempo 60 segundos.')</script>";
                    time_sleep_until(microtime(true)+2.0); //duerme durante 2 segundos
                    //header ("Location: ./mantenimiento/mantenimientoIndice.php?NomUsu=$NombUsu"); //entramos en la aplicacion de mantenimiento
                    redirect ('cAlquilerBono/fMinimaAutorizacion', 'location');
                }
            } 
        }   
        //echo "<script> alert ('No puede entrar: empleado o contraseña incorrecta, no coincide con la de la base de datos.')</script>";
        echo "<center><div class='alert alert-danger'>No puede entrar. Apodo o contraseña incorrecta, pruebe con cualquiera de las dos opciones.<br/>1. Máxima autorización - > Apodo: dpancorbo | Contraseña: dpm<br/>2. Mínima autorización - > Apodo: spancorbo | Contraseña: spm</div></center>";

    }
$this->abrir_cerrar_html->Abrir("Mant. Car Paradise"); //OJO, esto es solo para ponerle la caja que desaparece, ya que esolo en esto cargo js y jquery
?>
<div id="contenedorLoguin" class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 logoLoguin">
        <img title="Car Paradise Loguin" src="<?php echo base_url ('application/_imagenesCSS/logoPalmeraGrande.jpg') ?>" alt="logoCarParadise" />
    </div>
    <h3>- Área privada <span class="letrasMagneto">Car Paradise</span> para empleados -</h3>
    <div id="cajaCentralLoguin" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form class="form-horizontal" action='' method="POST">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 from-control">
                <!--<label class="col-lg-3 control-label" for="cajaEmpleado">Usuario: </label>-->
                <input placeholder="Apodo de empleado" class="form-control" type="text" name="cajaEmpleado" value='' id="empleado" />
            </div>    
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 from-control">
                <!--<label class="col-lg-3 control-label" for="cajaContrasena">Contraseña: </label>-->
                <input placeholder="Clave de acceso" class="form-control" type="password" name="cajaContrasena" value='' id="contrasena"/>
            </div>   
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-control">
                <input class="botonesIndex conectando" name="Conecta" type="submit" value="Conecta"/>
            </div>
                  <!--lo escondo de inicio AHORA ME HE HECHO UNO MEJOR CON JQUERY -->
                  <!--<div class="progress progress-striped active">
                        <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemax="100" style="width: 70%">
                            
                        </div>
                    </div>-->
        </form>
    </div>
    <div style="text-align:center; margin-top: 2%;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 from-control cajaSalirAreaPrivada ">
        <a class="btn btn-primary" href="<?php echo site_url ('')?>">Salir de área privada</a>
    </div>
</div>
<?php
    $this->abrir_cerrar_html->Cerrar (); // AQUI CIERRO EL HTML ABIERTO ARRIBA, ESTO NO LO COMENTO MÁS
?>