<?php
/*
IMPORTANTE: Ya que me han enseñado a no poner ids a diestro y siniestro y sí tener claves 
            primarias especificas o 4 claves primarias si hiciera falta ( por ejemplo, tabla ALQUILER ) 
            he resuelto el tema de "ON DELETE CASCADE ON UPDATE CASCADE" con dobles ataques a la base de datos:
                1º -> modificando la tabla concreta que deseo
                2º -> modificando la tabla refecenciada a la que deseo
CONCLUSIÓN: De esta manera no se pierden datos si cambias la clave primera de una tabla que referencian a otra, 
            así de forma manual en vez de automática. Con esto realizo un update de la 
            tabla a la que referencia asignandole la nueva clave primaria.
*/
class mCategoriaVehiculoBase extends CI_Model 
{ 
    public function __construct()
    {
        $this->load->database();
    }
    public function fCargarBases ()    
    {
        $query = $this->db->query ("SELECT * FROM Base ORDER BY Localidad, NombreBase, CodigoBase");
        $bases=$query->result_array ();
        return $bases;
    }
    public function fCargarCategorias ()    
    {
        $query = $this->db->query ("SELECT * FROM Categoria ORDER BY NombreCategoria, GrupoCategoria");
        $categorias=$query->result_array ();
        return $categorias;
    }
    public function fCargarVehiculos ()   
    {
        $query = $this->db->query ("SELECT * FROM Vehiculo ORDER BY Marca, Modelo, Combustible, Estado, Matricula");
        $vehiculos=$query->result_array ();
        return $vehiculos;
    }
    public function fCargarVehiculosBC ($queesdeBC, $identificador)    
    {
        if ($queesdeBC == "base")
        {
            $query = $this->db->query ("SELECT * FROM Vehiculo WHERE CodigoBase = $identificador ORDER BY Marca, Modelo, Combustible, Estado, Matricula");
        }
        else if ($queesdeBC == "categoria")  
        {
            $query = $this->db->query ("SELECT * FROM Vehiculo WHERE GrupoCategoria = '$identificador' ORDER BY Marca, Modelo, Combustible, Estado, Matricula");
        } 
        $vehiculosBC=$query->result_array ();
        return $vehiculosBC;
    }
    public function fCantidadVehiculos()  // DEVUELVO NUMERO DE TUPLAS DE LA TABLA A LA QUE LLAMO
    {
        return $this->db->get('Vehiculo')->num_rows();
    }
    public function fCargarVehiculosCompactos($per_page) // RECOJO LOS VEHICULOS EN ORDEN PARA HACER QUE RETORNEN
    {
        $datos = $this->db->order_by('Marca, Modelo, Combustible, Estado, Matricula')->get('Vehiculo', $per_page, $this->uri->segment(3));
        return $datos->result_array();
    }
    public function fCargarVehiculos12Disponibles ()    
    {
        $query = $this->db->query ("SELECT Vehiculo.*, Base.NombreBase, Base.Localidad
                                    FROM Vehiculo, Base 
                                    WHERE ( Vehiculo.CodigoBase = Base.CodigoBase ) AND ( Vehiculo.Estado = 'Disponible' ) 
                                    ORDER BY RAND ()
                                    LIMIT 0, 12
                                    ");
        $vehiculos8Disponibles=$query->result_array ();
        return $vehiculos8Disponibles;
    }
    public function fCargarVehiculos2Novedades ()    
    {
        $query = $this->db->query ("SELECT Vehiculo.*, Base.NombreBase, Base.Localidad
                                    FROM Vehiculo, Base 
                                    WHERE ( Vehiculo.CodigoBase = Base.CodigoBase ) AND ( Vehiculo.Estado = 'Reservado' OR Vehiculo.Estado = 'Disponible' OR Vehiculo.Estado = 'Alquilado') 
                                    ORDER BY Vehiculo.FechaExpiracion DESC, Vehiculo.Potencia DESC, Vehiculo.Km ASC
                                    LIMIT 0, 2
                                    ");
        $vehiculos2Novedades=$query->result_array ();
        return $vehiculos2Novedades;
    }
    public function fCargarVehiculos12DisponiblesDeCategoria ($grupoCategoriaPasar)    
    {
        $query = $this->db->query ("SELECT Vehiculo.*, Base.NombreBase, Base.Localidad, Categoria.*
                                    FROM Vehiculo, Base, Categoria 
                                    WHERE ( ( Vehiculo.CodigoBase = Base.CodigoBase ) AND ( Vehiculo.GrupoCategoria = Categoria.GrupoCategoria ) ) AND ( Vehiculo.Estado = 'Disponible' AND Vehiculo.GrupoCategoria = '$grupoCategoriaPasar' )
                                    ORDER BY RAND ()
                                    LIMIT 0, 12
                                    ");
        $vehiculos8DisponiblesDeCategoria=$query->result_array ($grupoCategoriaPasar);
        return $vehiculos8DisponiblesDeCategoria;
    }
    public function fCargarVehiculos2NovedadesDeCategoria ($grupoCategoriaPasar)    
    {
        $query = $this->db->query ("SELECT Vehiculo.*, Base.NombreBase, Base.Localidad, Categoria.*
                                    FROM Vehiculo, Base, Categoria
                                    WHERE ( ( Vehiculo.CodigoBase = Base.CodigoBase ) AND ( Vehiculo.GrupoCategoria = Categoria.GrupoCategoria ) ) AND ( ( Vehiculo.GrupoCategoria = '$grupoCategoriaPasar' ) AND ( Vehiculo.Estado = 'Reservado' OR Vehiculo.Estado = 'Disponible' OR Vehiculo.Estado = 'Alquilado' ) ) 
                                    ORDER BY Vehiculo.FechaExpiracion DESC, Vehiculo.Potencia DESC, Vehiculo.Km ASC
                                    LIMIT 0, 2
                                    ");
        $vehiculos2NovedadesDeCategoria=$query->result_array ();
        return $vehiculos2NovedadesDeCategoria;
    }
    public function fCargarEseVehiculoReservable ($matriculaPasar)
    {
        $query = $this->db->query ("SELECT Vehiculo.*, Base.*
                                    FROM Base, Vehiculo  
                                    WHERE (Vehiculo.CodigoBase = Base.CodigoBase) AND Vehiculo.Matricula = '$matriculaPasar'
                                    ");
        $eseVehiculoReservable=$query->row_array ();
        return $eseVehiculoReservable;
    }
    public function fCargarTopMarcas ()
    {
        $query = $this->db->query ("SELECT Vehiculo.Marca, COUNT(Vehiculo.Marca) 
                                    FROM Alquiler, Vehiculo 
                                    WHERE Vehiculo.Matricula = Alquiler.Matricula 
                                    GROUP BY Vehiculo.Marca 
                                    ORDER BY COUNT(vehiculo.Marca) DESC, Vehiculo.Marca ASC
                                    LIMIT 0, 10
                                    ");
        $topMarcas=$query->result_array ();
        return $topMarcas;
    }
    public function fCargarTopModelos ()
    {
        $query = $this->db->query ("SELECT Vehiculo.Modelo, COUNT(Vehiculo.Modelo) 
                                    FROM Alquiler, Vehiculo 
                                    WHERE Vehiculo.Matricula = Alquiler.Matricula 
                                    GROUP BY Vehiculo.Modelo 
                                    ORDER BY COUNT(Vehiculo.Modelo) DESC, Vehiculo.Modelo ASC
                                    LIMIT 0, 10
                                    ");
        $topModelos=$query->result_array ();
        return $topModelos;
    }
    public function fCargarTopBases ()
    {
        $query = $this->db->query ("SELECT Base.NombreBase, Base.Localidad, COUNT(Base.Localidad) 
                                    FROM Alquiler, Base, Vehiculo 
                                    WHERE Base.CodigoBase = Vehiculo.CodigoBase and Vehiculo.Matricula = Alquiler.Matricula 
                                    GROUP BY Base.Localidad, Base.NombreBase 
                                    ORDER BY COUNT(Base.Localidad) DESC, Base.NombreBase ASC
                                    LIMIT 0, 10
                                    ");
        $topBases=$query->result_array ();
        return $topBases;
    }
    public function fBorrarCategoria ($grupoCategoriaPasar)
    { 
        $this->db->delete('Categoria', array ('GrupoCategoria' => $grupoCategoriaPasar));
    }
    public function fBorrarVehiculo ($matriculaPasar)
    { 
        $this->db->delete('Vehiculo', array ('Matricula' => $matriculaPasar));
    }
    public function fBorrarBase ($codigoBasePasar)
    { 
        $this->db->delete('Base', array ('CodigoBase' => $codigoBasePasar));
    }
    public function fCrearCategoria ()
    { 
        $consultaSiExiste = $this->db->get_where('Categoria', array ('GrupoCategoria' => $this->input->post("GrupoCategoria")));
        if ($consultaSiExiste->num_rows() > 0)
        {
            // echo "<script>alert('Upps!! Ya existe dicho grupo de categoria < ".$this->input->post("GrupoCategoria")." >. Prueba con otra distinta.')</script>";
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-danger'>Upps!! Ya existe dicho grupo de categoria < ".$this->input->post("GrupoCategoria")." >. Prueba con otra distinta.<span class='x'>X</span></div>";
        }
        else
        {
            $data = array ("GrupoCategoria"=>$this->input->post("GrupoCategoria"),
                        "NombreCategoria"=>$this->input->post("NombreCategoria")
                        );
            $this->db->insert('Categoria', $data);   
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-success'>Entrada añadida con éxito. Siga añadiendo si lo desea o vuelva.<span class='x'>X</span></div>";     
        }
    }
    public function fCrearVehiculo ($imagenPasar)
    { 
        $consultaSiExiste = $this->db->get_where('Vehiculo', array ('Matricula' => $this->input->post("Matricula")));
        if ($consultaSiExiste->num_rows() > 0)
        {
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-danger'>Upps!! Ya existe dicho vehículo con matrícula < ".$this->input->post("Matricula")." >. Prueba con otra distinta.<span class='x'>X</span></div>";
        }
        else
        {
            if ($imagenPasar['image_type'] == "") // esto se lo he puesto para q no salte el error cnd no quiera meter foto todavia
            {
                $insertarImagen="";        
            }
            else 
            { 
                $insertarImagen=file_get_contents($imagenPasar['full_path']); // AHORA SÍ, LA IMAGEN EN SI PARA DARLA AL INSERT
            }

            $data=array("Matricula"=>$this->input->post("Matricula"), 
                        "Marca"=>$this->input->post("Marca"),
                        "Modelo"=>$this->input->post("Modelo"),
                        "Km"=>$this->input->post("Km"),
                        "Combustible"=>$this->input->post("Combustible"),
                        "Potencia"=>$this->input->post("Potencia"),
                        "Imagen"=>$insertarImagen,            // OJO!!! NO INPUT, YA QUE YA ESTÁ EN LA VARIABLE
                        "FechaExpiracion"=>date("Y-m-d", strtotime("+2 years")), // para que sume siempre dos años a la fecha actual, el alquiler expira en 2 años de inicio
                                                        // date_add(sysdate(), INTERVAL 2 year) // la buena es la de arriba
                                                        // sysdate() + interval '2' year        // la buena es la de arriba
                        "Estado"=>"Disponible",
                        "Color"=>$this->input->post("Color"),
                        "CodigoBase"=>$this->input->post("CodigoBase"),
                        "GrupoCategoria"=>$this->input->post("GrupoCategoria")
                        );
            $this->db->insert('Vehiculo', $data);
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-success'>Entrada añadida con éxito. Siga añadiendo si lo desea o vuelva.<span class='x'>X</span></div>";     
        }
    }
    public function fCrearBase ()
    { 
        $consultaSiExiste = $this->db->get_where('Base', array ('CodigoBase' => $this->input->post("CodigoBase")));
        if ($consultaSiExiste->num_rows() > 0)
        {
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-danger'>Upps!! Ya existe dicha base con código < ".$this->input->post("CodigoBase")." >. Prueba con otro código distinto.<span class='x'>X</span></div>";
        }
        else
        {
            $data = array ("CodigoBase"=>$this->input->post("CodigoBase"),
                        "NombreBase"=>$this->input->post("NombreBase"),
                        "Localidad"=>$this->input->post("Localidad")
                        );
            $this->db->insert('Base', $data);
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-success'>Entrada añadida con éxito. Siga añadiendo si lo desea o vuelva.<span class='x'>X</span></div>";     
        }
    }
    public function fModificarBase ($codigoBasePasar)
    { 
        $consultaSiExiste = $this->db->get_where('Base', array ('CodigoBase' => $this->input->post("CodigoBase")));
        if ($consultaSiExiste->num_rows() > 0 && $codigoBasePasar != $this->input->post("CodigoBase"))
        {
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-danger'>Upps!! Ya existe dicha base con código < ".$this->input->post("CodigoBase")." >. Prueba con otro código distinto.<span class='x'>X</span></div>";
        }
        else
        {
            $data = array ('CodigoBase' => $this->input->post("CodigoBase"),
                        'NombreBase' => $this->input->post("NombreBase"),
                        'Localidad' => $this->input->post("Localidad")
                        );
            $this->db->where('CodigoBase', $codigoBasePasar);
            $this->db->update('Base', $data);

            if ($codigoBasePasar != $this->input->post("CodigoBase"))
            {
                $data2 = array ('CodigoBase' => $this->input->post("CodigoBase"));
                $this->db->where('CodigoBase', $codigoBasePasar);
                $this->db->update('Vehiculo', $data2);
            }
        }
    }
    public function fCargarEsaBase ($codigoBasePasar) 
    {
        $query = $this->db->get_where('Base', array ('CodigoBase' => $codigoBasePasar));
        $esaBase=$query->row_array();
        return $esaBase;
    }
    public function fModificarCategoria ($grupoCategoriaPasar)
    { 
        $consultaSiExiste = $this->db->get_where('Categoria', array ('GrupoCategoria' => $this->input->post("GrupoCategoria")));
        if ($consultaSiExiste->num_rows() > 0 && $grupoCategoriaPasar != $this->input->post("GrupoCategoria"))
        {
            echo "<script>alert('Upps!! Ya existe dicho grupo de categoria < ".$this->input->post("GrupoCategoria")." >. Prueba con otra distinta.')</script>";
            // echo "<div id='cajaCabecera' class='entradaAnadida alert alert-danger'>Upps!! Ya existe dicho grupo de categoria < ".$this->input->post("GrupoCategoria")." >. Prueba con otra distinta.<span class='x'>X</span></div>";
        }
        else
        {
            $data = array ('GrupoCategoria' => $this->input->post("GrupoCategoria"),
                        'NombreCategoria' => $this->input->post("NombreCategoria")
                        );
            $this->db->where('GrupoCategoria', $grupoCategoriaPasar);
            $this->db->update('Categoria', $data);

            if ($grupoCategoriaPasar != $this->input->post("GrupoCategoria"))
            {
                $data2 = array ('GrupoCategoria' => $this->input->post("GrupoCategoria"));
                $this->db->where('GrupoCategoria', $grupoCategoriaPasar);
                $this->db->update('Vehiculo', $data2);
            }
        }
    }
    public function fCargarEsaCategoria ($GrupoCategoriaPasar) 
    {
        $query = $this->db->get_where('Categoria', array ('GrupoCategoria' => $GrupoCategoriaPasar));
        $esaCategoria=$query->row_array();
        return $esaCategoria;
    }
    // EL NUEVO, por lo d la foto
    public function fModificarVehiculo($imagenPasar, $matriculaPasar)
    {
        $consultaSiExiste = $this->db->get_where('Vehiculo', array ('Matricula' => $this->input->post("Matricula")));
        if ($consultaSiExiste->num_rows() > 0 && $matriculaPasar != $this->input->post("Matricula"))
        {
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-danger'>Upps!! Ya existe dicho vehículo con matrícula < ".$this->input->post("Matricula")." >. Prueba con otra distinta.<span class='x'>X</span></div>";
        }
        else
        {
            if ($imagenPasar['image_type'] == "")
            {
                $data=array("Matricula"=>$this->input->post("Matricula"), 
                            "Marca"=>$this->input->post("Marca"),
                            "Modelo"=>$this->input->post("Modelo"),
                            "Km"=>$this->input->post("Km"),
                            "Combustible"=>$this->input->post("Combustible"),
                            "Potencia"=>$this->input->post("Potencia"),
                            // COMO VEMOS, AQUI NO PONGO VEHICULO A MODIFICAR LA IMAGEN
                            "FechaExpiracion"=>$this->input->post("FechaExpiracion"),
                            "Estado"=>$this->input->post("Estado"),
                            "CodigoBase"=>$this->input->post("CodigoBase"),
                            "GrupoCategoria"=>$this->input->post("GrupoCategoria")
                            );
                $this->db->where('Matricula', $matriculaPasar);  // ELEMENTAL PARA SABER QUE vehículo CONCRETO SE MODIFICA
                $this->db->update('Vehiculo', $data);      

                if ($matriculaPasar != $this->input->post("Matricula"))
                {   
                    $data2=array ("Matricula"=>$this->input->post("Matricula"));
                    $this->db->where('Matricula', $matriculaPasar);  // ELEMENTAL PARA SABER QUE PRODUCTO CONCRETO SE MODIFICA
                    $this->db->update('Alquiler', $data2);
                }
            }
            else 
            { 
                $insertarImagen=file_get_contents($imagenPasar['full_path']); // AHORA SÍ, LA IMAGEN EN SI PARA DARLA AL INSERT   
                $data=array("Matricula"=>$this->input->post("Matricula"), 
                                "Marca"=>$this->input->post("Marca"),
                                "Modelo"=>$this->input->post("Modelo"),
                                "Km"=>$this->input->post("Km"),
                                "Combustible"=>$this->input->post("Combustible"),
                                "Potencia"=>$this->input->post("Potencia"),
                                "Imagen"=>$insertarImagen,            // OJO!!! NO INPUT, YA QUE YA ESTÁ EN LA VARIABLE
                                "FechaExpiracion"=>$this->input->post("FechaExpiracion"),
                                "Estado"=>$this->input->post("Estado"),
                                "CodigoBase"=>$this->input->post("CodigoBase"),
                                "GrupoCategoria"=>$this->input->post("GrupoCategoria")
                                );
                $this->db->where('Matricula', $matriculaPasar);  // ELEMENTAL PARA SABER QUE PRODUCTO CONCRETO SE MODIFICA
                $this->db->update('Vehiculo', $data);

                if ($matriculaPasar != $this->input->post("Matricula"))
                {   
                    $data2=array ("Matricula"=>$this->input->post("Matricula"));
                    $this->db->where('Matricula', $matriculaPasar);  // ELEMENTAL PARA SABER QUE PRODUCTO CONCRETO SE MODIFICA
                    $this->db->update('Alquiler', $data2);
                }
            }
        }
    }
    public function fCargarEseVehiculo ($matriculaPasar) 
    {
        $query = $this->db->get_where('Vehiculo', array ('Matricula' => $matriculaPasar));
        $eseVehiculo=$query->row_array();
        return $eseVehiculo;
    }
    public function fModificarVehiculoEstado($matriculaPasar, $nuevoEstado)
    {       
        $data=array("Estado"=>$nuevoEstado);
        $this->db->where('Matricula', $matriculaPasar);  // ELEMENTAL PARA SABER QUE vehículo CONCRETO SE MODIFICA
        $this->db->update('Vehiculo', $data);
    }
    public function fModificarVehiculoExpirado () // importante ! me cepillo los vehiculos caducados, es decir lo pongo en estado 'expirado'
    {
        $data=array("Estado"=>"Expirado");
        $this->db->where('FechaExpiracion <', (date("Y-m-d")));  // ELEMENTAL PARA SABER QUE PRODUCTO CONCRETO SE MODIFICA
        $this->db->update('Vehiculo', $data);
    }
}