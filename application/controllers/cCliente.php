<?php 
/*
 * CLASE DEL CONTROLADOR DE CLIENTE CON SUS MODELOS PARA 
 * EJECUTAR LOS METODOS SEGUN CASO
 */
class cCliente extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mCliente');    // CARGO EL MODELO 
    }
    public function fCliente($tituloPagina)
    {
        $data["titulo"]=$tituloPagina;
        $data2['clientes'] = $this->mCliente->fCargarClientes(); // UTILIZO EL MODELO
        $this->load->view('mantenimiento/vCabecera', $data);  
        $this->load->view('mantenimiento/vCliente/vMantenimientoClientes',$data2);         
    }
    public function fBorrarCliente($dniPasar) 
    {
        $this->mCliente->fBorrarCliente($dniPasar);
        redirect ('cCliente/fCliente/Clientes', 'location');
    }
    public function fModificarCliente($tituloPagina, $dniPasar)
    {
        $data["titulo"]=$tituloPagina;
        $data2['eseCliente'] = $this->mCliente->fCargarEseCliente($dniPasar);
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vCliente/vModificarCliente', $data2); 
    }
    public function fCrearCliente($tituloPagina)
    {
        $data["titulo"]=$tituloPagina;
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vCliente/vCrearCliente'); 
    }
}