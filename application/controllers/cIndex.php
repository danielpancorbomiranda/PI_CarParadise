<?php 
/**
 *  CLASE DEL CONTROLADOR DE INDEX CON SU MODELO mTipoEmpleado 
 *  Y mCategoriaVehiculoBase 
 */
class cIndex extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mTipoEmpleado');            // CARGA EL MODELO, ESENCIAL PARA BUSCAR EL EMPLEA
        $this->load->model('mCategoriaVehiculoBase');   // CARGA EL MODELO 
        $this->load->model('mCliente');   // CARGA EL MODELO 
    }
    public function fIndex ()
    {
        // session_start(); // para aceder a las variables de sesion asignadas
        // session_destroy(); // destruye todas la variable de sesion
        // $data2['clientes'] = $this->mCliente->fCargarClientes(); // UTILIZO EL MODELO
        $data['vehiculos2Novedades'] = $this->mCategoriaVehiculoBase->fCargarVehiculos2Novedades(); // UTILIZO EL MODELO
        $data['vehiculos12Disponibles'] = $this->mCategoriaVehiculoBase->fCargarVehiculos12Disponibles(); // UTILIZO EL MODELO
        $data['categoriasMenu'] = $this->mCategoriaVehiculoBase->fCargarCategorias(); // UTILIZO EL MODELO
        $this->load->view('index/vCabecera'/*, $data2*/);   
        $this->load->view('index/vIndexPrincipal', $data);          // DATA PARA NOVEDADES Y OFERTAS DE LA PAGINA INDEX
        $this->load->view('index/vPie');                            // NO NECESITA NINGUN DATO
    }
    public function fLoguin()
    {
        session_start(); // para aceder a las variables de sesion asignadas
        session_destroy(); // destruye todas la variable de sesion
        $data['empleados'] = $this->mTipoEmpleado->CargarEmpleadosParaEntrar(); // CARGO TODOS, DESPUES LOS RECORRERÉ PARA COMPROBAR
        $this->load->view('mantenimiento/vLoguin', $data);        
    }
    public function fIndice($tituloPagina) 
    {
        $data["titulo"]=$tituloPagina;
        $this->load->view('mantenimiento/vCabecera', $data);  
        $this->load->view('mantenimiento/vIndice');  
    }
    public function fCerrarSesionUsuario() 
    {
        $this->load->view('index/vCabecera', $data);  
        $this->load->view('index/vCierraSesionUsuario');  
    }
}