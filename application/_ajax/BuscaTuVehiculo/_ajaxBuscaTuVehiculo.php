<?php 
    $marcaPasada="";
    $modeloPasado="";
    $combustiblePasado="";
    $kmPasados="";
    $grupoCategoriaPasado="";
    $codigoBasePasado="";

    $conexion= new PDO("mysql:dbname=carparadise_bd;host=127.0.0.1", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") ); /// nombre de la base de datos y la ip del servidor
    // configurar conexion para lanzar PDO
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (count($_POST)!=0) 
    {   
        try
        {
            $marcaPasada=$_POST["Marca"];
            $modeloPasado=$_POST["Modelo"];
            $combustiblePasado=$_POST["Combustible"];
            $kmPasados=$_POST["Km"];
            $grupoCategoriaPasado=$_POST["Categoria"];
            $codigoBasePasado=$_POST["Base"];

            $consultaPatron = "SELECT Vehiculo.Marca, Vehiculo.Modelo, Vehiculo.Matricula, Vehiculo.Estado, Vehiculo.Km, Vehiculo.Combustible, Base.NombreBase, Base.Localidad, Categoria.NombreCategoria, Vehiculo.Color
                                FROM Vehiculo, Categoria, Base 
                                WHERE ( Vehiculo.CodigoBase = Base.CodigoBase AND Vehiculo.GrupoCategoria = Categoria.GrupoCategoria ) ";
                                if ($marcaPasada != "") {
                                    $consultaPatron .= "AND Vehiculo.Marca LIKE '%".$marcaPasada."%' ";
                                }
                                if ($modeloPasado != "") {
                                    $consultaPatron .= " AND Vehiculo.Modelo LIKE '%".$modeloPasado."%' ";
                                }
                                if ($kmPasados != "") {
                                    $consultaPatron .= " AND Vehiculo.Km < '".$kmPasados."' ";
                                }
                                if ($combustiblePasado != "") {
                                    $consultaPatron .= " AND Vehiculo.Combustible = '".$combustiblePasado."' ";
                                }
                                if ($codigoBasePasado != "") {
                                    $consultaPatron .= " AND Base.CodigoBase = '".$codigoBasePasado."' ";
                                }
                                if ($grupoCategoriaPasado != "") {
                                    $consultaPatron .= " AND Categoria.GrupoCategoria = '".$grupoCategoriaPasado."'  ";
                                }
            
            $consultaPatronCola=" ORDER BY Vehiculo.Marca, Vehiculo.Modelo, Vehiculo.Combustible, Vehiculo.Estado, Vehiculo.Matricula";
            $consultaPatronFinal = $consultaPatron.$consultaPatronCola;
            $datos=$conexion->query($consultaPatronFinal);                                                                        
        }
        catch (PDOException $e)
        {
            // controlar error
            echo $e->getMessage();
        }
    }
    function RecorrerConFetch($datos) //fila a fila
    {
        while ($vehiculos=$datos->fetch(PDO::FETCH_ASSOC)) // assoc no saca las posiciones de los indices
        {
            $vehiculosArray[] = $vehiculos; 
        }
        if (!empty($vehiculosArray)) 
        {
            echo json_encode($vehiculosArray); 
        } 
        else 
        { 
            echo "sin datos regresados";
        }
    }
    if (count($_POST)!=0) 
    {       
        RecorrerConFetch($datos); 
    }
?>