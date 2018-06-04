<?php
class mTipoEmpleado extends CI_Model 
{ 
    public function __construct()
    {
        $this->load->database();
    }
    public function CargarEmpleadosParaEntrar() // CARGO TODOS LOS EMPLEADOS QUE HAYA EN MI BASE DE DATOS PARA VER SI ENTRO O NO
    {
        $query = $this->db->query("SELECT Empleado.*, Tipo.* FROM Empleado, Tipo WHERE Empleado.IdTipo = Tipo.IdTipo"); 
        $empleados=$query->result_array();
        return $empleados;
    }
    public function fCargarTipos()    
    {
        $query = $this->db->query ("SELECT * FROM Tipo ORDER BY NombreTipo");
        $tipos=$query->result_array();
        return $tipos;
    }
    public function fCargarEmpleados($idTipoPasar)    
    {
        $query = $this->db->order_by('NombreEmpleado')->get_where('Empleado', array('IdTipo' => $idTipoPasar));
        $empleados=$query->result_array();
        return $empleados;
    }
    public function fBorrarTipo ($idTipoPasar)
    { 
        $this->db->delete('Tipo', array ('IdTipo' => $idTipoPasar));
    }
    public function fBorrarEmpleado ($apodoEmpleadoPasar)
    { 
        $this->db->delete('Empleado', array ('ApodoEmpleado' => $apodoEmpleadoPasar));
    }
    public function fCrearTipo ()
    { 
        $data = array ("NombreTipo"=>$this->input->post("NombreTipo")
                    );
        $this->db->insert('Tipo', $data);
    }
    public function fCrearEmpleado ($idTipoPasar)
    { 
        $consultaSiExiste = $this->db->get_where('Empleado', array ('ApodoEmpleado' => $this->input->post("ApodoEmpleado")));
        if ($consultaSiExiste->num_rows() > 0)
        {
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-danger'>Upps!! Ya existe dicho apodo de empleado denominado < ".$this->input->post("ApodoEmpleado")." >. Prueba con otro distinto.<span class='x'>X</span></div>";
        }
        else
        {
            $data = array ("ApodoEmpleado"=>$this->input->post("ApodoEmpleado"),
                        "NombreEmpleado"=>$this->input->post("NombreEmpleado"),
                        "Contrasena"=>$this->input->post("Contrasena"),
                        "IdTipo"=>$idTipoPasar,
                        );
            $this->db->insert('Empleado', $data);
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-success'>Entrada añadida con éxito. Siga añadiendo si lo desea o vuelva.<span class='x'>X</span></div>";     
        }
    }
    public function fModificarTipo ($idTipoPasar)
    { 
        $data = array ('NombreTipo' => $this->input->post("NombreTipo")
                       );
        $this->db->where('IdTipo', $idTipoPasar);
        $this->db->update('Tipo', $data);
    }
    public function fCargarEseTipo ($idTipoPasar) 
    {
        $query = $this->db->get_where('Tipo', array ('IdTipo' => $idTipoPasar));
        $eseTipo=$query->row_array();
        return $eseTipo;
    }
    public function fModificarEmpleado ($ApodoEmpleadoPasar)
    { 
        $consultaSiExiste = $this->db->get_where('Empleado', array ('ApodoEmpleado' => $this->input->post("ApodoEmpleado")));
        if ($consultaSiExiste->num_rows() > 0)
        {
            echo "<div id='cajaCabecera' class='entradaAnadida alert alert-danger'>Upps!! Ya existe dicho apodo de empleado denominado < ".$this->input->post("ApodoEmpleado")." >. Prueba con otro distinto.<span class='x'>X</span></div>";
        }
        else
        {
            $data = array ('ApodoEmpleado' => $this->input->post("ApodoEmpleado"),
                        'NombreEmpleado' => $this->input->post("NombreEmpleado"),
                        'Contrasena' => $this->input->post("Contrasena")
                        );
            $this->db->where('ApodoEmpleado', $ApodoEmpleadoPasar);
            $this->db->update('Empleado', $data);
        }
    }
    public function fCargarEseEmpleado ($ApodoEmpleadoPasar) 
    {
        $query = $this->db->get_where('Empleado', array ('ApodoEmpleado' => $ApodoEmpleadoPasar));
        $eseEmpleado=$query->row_array();
        return $eseEmpleado;
    }
}