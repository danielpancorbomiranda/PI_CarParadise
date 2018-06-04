<?php 
/*
 * CLASE DEL CONTROLADOR DE TIPO DE EMPLEADO Y EMPLEADOS CON SUS MODELOS PARA 
 * EJECUTAR LOS METODOS SEGUN CASO
 */
class cTipoEmpleado extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mTipoEmpleado');   
    }
    public function fTipo($tituloPagina)
    {
        $data["titulo"]=$tituloPagina;
        $data2['tipos'] = $this->mTipoEmpleado->fCargarTipos(); // UTILIZO EL MODELO
        $this->load->view('mantenimiento/vCabecera', $data);  
        $this->load->view('mantenimiento/vTipoEmpleado/vMantenimientoTipos',$data2);           
    }
    public function fEmpleado($tituloPagina, $idTipoPasar)
    {
        $data["titulo"]=$tituloPagina;
        $data2["idTipoPasado"]=$idTipoPasar;
        $data2['empleados'] = $this->mTipoEmpleado->fCargarEmpleados($idTipoPasar); // UTILIZO EL MODELO
        $this->load->view('mantenimiento/vCabecera', $data);  
        $this->load->view('mantenimiento/vTipoEmpleado/vMantenimientoEmpleados',$data2);           
    }
    public function fBorrarTipo($idTipoPasar) 
    {
        $this->mTipoEmpleado->fBorrarTipo($idTipoPasar);
        redirect ('cTipoEmpleado/fTipo/Tipos', 'location');
    }
    public function fBorrarEmpleado($apodoEmpleado, $idTipoPasar) 
    {
        $this->mTipoEmpleado->fBorrarEmpleado($apodoEmpleado);
        redirect ('cTipoEmpleado/fEmpleado/Empleados/'.$idTipoPasar, 'location');
    }
    public function fModificarTipo($tituloPagina, $idTipoPasar)
    {
        $data["titulo"]=$tituloPagina;
        $data2['eseTipo'] = $this->mTipoEmpleado->fCargarEseTipo($idTipoPasar);
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vTipoEmpleado/vModificarTipo', $data2); 
    }
    public function fModificarEmpleado($tituloPagina, $apodoEmpleadoPasar)
    {
        $data["titulo"]=$tituloPagina;
        $data2['eseEmpleado'] = $this->mTipoEmpleado->fCargarEseEmpleado($apodoEmpleadoPasar);
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vTipoEmpleado/vModificarEmpleado', $data2); 
    }
    public function fCrearTipo($tituloPagina)
    {
        $data["titulo"]=$tituloPagina;
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vTipoEmpleado/vCrearTipo'); 
    }
    public function fCrearEmpleado($tituloPagina, $idTipoPasar)
    {
        $data["titulo"]=$tituloPagina;
        $data2["idTipoPasado"]=$idTipoPasar;
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vTipoEmpleado/vCrearEmpleado', $data2); 
    }
}