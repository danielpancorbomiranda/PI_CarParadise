<?php 
/*
 * CLASE DEL CONTROLADOR DE OTRAS PAGINAS CON SUS MODELOS PARA 
 * EJECUTAR LOS METODOS SEGUN CASO
 */
class cOtrasPaginas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mCategoriaVehiculoBase'); // LO CARGO
        $this->load->model('mCliente');  // LO CARGO
        $this->load->model('mAlquilerBono');  // LO CARGO
    }
    public function fBuscaTuVehiculo () 
    {
        // $data['clientes'] = $this->mCliente->fCargarClientes(); // UTILIZO EL MODELO
        $data2['bases'] = $this->mCategoriaVehiculoBase->fCargarBases(); // UTILIZO EL MODELO
        $data2['categorias'] = $this->mCategoriaVehiculoBase->fCargarCategorias(); // UTILIZO EL MODELO
        $this->load->view('index/vCabecera'/*, $data*/);   
        $this->load->view('otrasPaginas/vBuscaTuVehiculo', $data2);         // DATA2 PARA BUSCAR ES DECIR PARA CARGARLO EN SU OPTIONS
        $this->load->view('index/vPie');    
    }
    public function fPinchaCategoria ($grupoCategoriaPasar) 
    {
        // $data['clientes'] = $this->mCliente->fCargarClientes(); // UTILIZO EL MODELO
        $data['vehiculos2NovedadesDeCategoria'] = $this->mCategoriaVehiculoBase->fCargarVehiculos2NovedadesDeCategoria($grupoCategoriaPasar); // UTILIZO EL MODELO
        $data['vehiculos12DisponiblesDeCategoria'] = $this->mCategoriaVehiculoBase->fCargarVehiculos12DisponiblesDeCategoria($grupoCategoriaPasar); // UTILIZO EL MODELO
        $data['categoriasMenu'] = $this->mCategoriaVehiculoBase->fCargarCategorias(); // UTILIZO EL MODELO
        $this->load->view('index/vCabecera'/*, $data*/);   
        $this->load->view('otrasPaginas/vPinchaCategoria', $data);         // DATA PARA PASAR LO QUE NECESITO
        $this->load->view('index/vPie');          
    }
    public function fTopCarParadise ()
    {
        // $data2['clientes'] = $this->mCliente->fCargarClientes(); // UTILIZO EL MODELO
        $data['topMarcas'] = $this->mCategoriaVehiculoBase->fCargarTopMarcas(); // UTILIZO EL MODELO
        $data['topModelos'] = $this->mCategoriaVehiculoBase->fCargarTopModelos(); // UTILIZO EL MODELO
        $data['topClientes'] = $this->mCliente->fCargarTopClientes(); // UTILIZO EL MODELO
        $data['topBases'] = $this->mCategoriaVehiculoBase->fCargarTopBases(); // UTILIZO EL MODELO
        $data['topBonos'] = $this->mAlquilerBono->fCargarTopBonos(); // UTILIZO EL MODELO
        $this->load->view('index/vCabecera'/*, $data2*/);   
        $this->load->view('otrasPaginas/vTopCarParadise', $data);         // DATA PARA PASAR LO QUE NECESITO
        $this->load->view('index/vPie'); 
    }
    public function fReserva ($matriculaPasar)
    {   
        // $data2['clientes'] = $this->mCliente->fCargarClientes(); // UTILIZO EL MODELO
        $data['matriculaPasada']=$matriculaPasar;
        $data['eseVehiculoReservable'] = $this->mCategoriaVehiculoBase->fCargarEseVehiculoReservable($matriculaPasar);
        $this->load->view('index/vCabecera'/*, $data2*/);   
        $this->load->view('otrasPaginas/vReserva', $data);         
        $this->load->view('index/vPie'); 
    }
    public function fMiHistorial ($dniSesionPasar)
    {   
        $data['misVehiculos'] = $this->mAlquilerBono->fCargarMiHistorialAlquiler($dniSesionPasar);
        $this->load->view('index/vCabecera');   
        $this->load->view('otrasPaginas/vMiHistorial', $data);         
        $this->load->view('index/vPie'); 
    }    
}