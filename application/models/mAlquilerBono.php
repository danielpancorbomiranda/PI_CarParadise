<?php
class mAlquilerBono extends CI_Model 
{ 
    public function __construct()
    {
        $this->load->database();
    }

    public function fCargarBonos ()    
    {                                                            // ojo !! -- el 15 es el id del descuento online
        $query = $this->db->query ("SELECT * FROM Bono WHERE IdBono <> 15 ORDER BY Descuento ASC, Descripcion ASC");
        $bonos=$query->result_array ();
        return $bonos;
    }
    public function fCargarAlquileresB ($identificador)    
    {
        $query = $this->db->query ("SELECT * 
                                    FROM Alquiler 
                                    WHERE IdBono = $identificador 
                                    ORDER BY FechaInicio DESC, Matricula, Dni");
        $alquileresB=$query->result_array ();
        return $alquileresB;
    }
    public function fCantidadAlquileres() // DEVUELVO NUMERO DE TUPLAS DE LA TABLA A LA QUE LLAMO
    {
        return $this->db->get('Alquiler')->num_rows();
    }
    public function fCargarAlquileresCompactos($per_page) 
    {
        $datos = $this->db->order_by('FechaInicio DESC, Matricula, Dni')->get('Alquiler', $per_page, $this->uri->segment(3));
        return $datos->result_array();
    }
    public function fCargarTopBonos ()
    {
        $query = $this->db->query ("SELECT Bono.Descripcion, COUNT(Bono.Descripcion) 
                                    FROM Alquiler, Bono 
                                    WHERE Bono.IdBono = Alquiler.IdBono 
                                    GROUP BY Bono.Descripcion 
                                    ORDER BY COUNT(Bono.Descripcion) DESC, Bono.Descripcion ASC
                                    LIMIT 0, 10
                                    ");
        $topBonos=$query->result_array ();
        return $topBonos;
    }
    public function fBorrarBono ($idBonoPasar)
    { 
        $this->db->delete('Bono', array ('IdBono' => $idBonoPasar));
    }
    public function fCrearBono ()
    { 
        $data = array ("Descuento"=>$this->input->post("Descuento"),
                    "Descripcion"=>$this->input->post("Descripcion")
                    );
        $this->db->insert('Bono', $data);
    }
    public function fCrearAlquiler ($matriculaPasar)
    { 
        $data = array ("Matricula"=>$matriculaPasar, // Nota: son claves primarias-> Matricula, Dni, FechaFin y FechaInicio
                    "Dni"=>$this->input->post("Dni"),
                    "PrecioAlquiler"=>$this->input->post("PrecioAlquiler"),
                    "FechaInicio"=>$this->input->post("FechaInicio"),
                    "FechaFin"=>$this->input->post("FechaFin"),
                    "IdBono"=>$this->input->post("IdBono")
                    );
        $this->db->insert('Alquiler', $data);
    }
    public function fModificarBono ($idBonoPasar)
    { 
        $data = array ('Descuento' => $this->input->post("Descuento"),
                      'Descripcion' => $this->input->post("Descripcion")
                       );
        $this->db->where('IdBono', $idBonoPasar);
        $this->db->update('Bono', $data);
    }
    public function fCargarEseBono ($idBonoPasar) 
    {
        $query = $this->db->get_where('Bono', array ('IdBono' => $idBonoPasar));
        $eseBono=$query->row_array();
        return $eseBono;
    }
    public function fBorrarAlquiler ($matriculaPasar, $dniPasar, $fechaInicioPasar, $fechaFinPasar)
    {                               // Importante: 4 claves primarias para de alquiler para borrar.
        $this->db->delete('Alquiler', array (
                                                'Matricula' => $matriculaPasar,
                                                'Dni' => $dniPasar,
                                                'FechaInicio' => $fechaInicioPasar,
                                                'FechaFin' => $fechaFinPasar
                                            )
                        );
    }
    public function fCargarMiHistorialAlquiler ($dniSesionPasar)    
    {                                                           
        $query = $this->db->query ("SELECT Alquiler.*, Vehiculo.Marca, Vehiculo.Modelo, Vehiculo.Imagen 
                                    FROM Alquiler, Vehiculo
                                    WHERE Alquiler.Matricula = Vehiculo.Matricula AND Alquiler.Dni = '$dniSesionPasar' 
                                    ORDER BY Alquiler.FechaInicio DESC, Alquiler.Matricula ASC");
        $misAlquileres=$query->result_array ();
        return $misAlquileres;
    }
}