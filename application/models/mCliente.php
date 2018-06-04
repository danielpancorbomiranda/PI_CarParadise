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
class mCliente extends CI_Model 
{ 
    public function __construct()
    {
        $this->load->database();
    }
    public function fCargarClientes ()    
    {
        $query = $this->db->query ("SELECT * FROM Cliente ORDER BY Apellido1Cliente, Apellido2Cliente, NombreCliente");
        $clientes=$query->result_array ();
        return $clientes;
    }
    public function fCargarTopClientes ()
    {
        $query = $this->db->query ("SELECT Cliente.NombreCliente, Cliente.Apellido1Cliente, Cliente.Apellido2Cliente, COUNT(Cliente.Dni) 
                                    FROM Alquiler, Cliente 
                                    WHERE Cliente.Dni = Alquiler.Dni 
                                    GROUP BY Cliente.Dni 
                                    ORDER BY COUNT(Cliente.Dni) DESC, Cliente.NombreCliente, Cliente.Apellido1Cliente, Cliente.Apellido2Cliente ASC
                                    LIMIT 0, 10
                                    ");
        $topClientes=$query->result_array ();
        return $topClientes;
    }
    public function fBorrarCliente ($dniPasar)
    { 
        $this->db->delete('Cliente', array ('Dni' => $dniPasar));
    }
    public function fCrearCliente ()
    { 
        $consultaSiExiste = $this->db->get_where('Cliente', array ('Dni' => $this->input->post("Dni")));
        if ($consultaSiExiste->num_rows() > 0)
        {
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-danger'>Upps!! Ya existe dicho cliente con DNI < ".$this->input->post("Dni")." >. Prueba con otro distinto o revíselo.<span class='x'>X</span></div>";
        }
        else
        {
            $data = array ("Dni"=>$this->input->post("Dni"),
                        "NombreCliente"=>$this->input->post("NombreCliente"),
                        "Apellido1Cliente"=>$this->input->post("Apellido1Cliente"),
                        "Apellido2Cliente"=>$this->input->post("Apellido2Cliente"),
                        "Telefono"=>$this->input->post("Telefono"),
                        'Contrasena' => $this->input->post("Contrasena")
                        );
            $this->db->insert('Cliente', $data);
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-success'>Entrada añadida con éxito. Siga añadiendo si lo desea o vuelva.<span class='x'>X</span></div>";     
        }
    }
    public function fModificarCliente ($dniPasar)
    { 
        $consultaSiExiste = $this->db->get_where('Cliente', array ('Dni' => $this->input->post("Dni")));
        if ($consultaSiExiste->num_rows() > 0 && $dniPasar != $this->input->post("Dni"))
        {
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-danger'>Upps!! Ya existe dicho cliente con DNI < ".$this->input->post("Dni")." >. Prueba con otro distinto o revíselo.<span class='x'>X</span></div>";
        }
        else
        {
            $data = array ('Dni' => $this->input->post("Dni"),
                        'NombreCliente' => $this->input->post("NombreCliente"),
                        'Apellido1Cliente' => $this->input->post("Apellido1Cliente"),
                        'Apellido2Cliente' => $this->input->post("Apellido2Cliente"),
                        'Telefono' => $this->input->post("Telefono"),
                        'Contrasena' => $this->input->post("Contrasena")
                        );
            $this->db->where('Dni', $dniPasar);
            $this->db->update('Cliente', $data);

            if ($dniPasar != $this->input->post("Dni"))
            {
                $data2 = array ('Dni' => $this->input->post("Dni"));
                $this->db->where('Dni', $dniPasar);
                $this->db->update('Alquiler', $data2);
            }
        }
    }
    public function fCargarEseCliente ($dniPasar) 
    {
        $query = $this->db->get_where('Cliente', array ('Dni' => $dniPasar));
        $eseCliente=$query->row_array();
        return $eseCliente;
    }
}