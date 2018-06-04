<?php 
/*
 * CLASE DEL CONTROLADOR DE ALQUILER Y BONOS DE OFERtAS CON SUS MODELOS PARA 
 * EJECUTAR LOS METODOS SEGUN CASO
 */
class cAlquilerBono extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mAlquilerBono');    // CARGO EL MODELO NECESARIO
        $this->load->model('mCategoriaVehiculoBase');    // IMPORTANTE: NECESARIO PARA CAMBIAR EL ESTADO DEL VEHICULO CUANDO SE REALIZA EL ALQUILER EN SU VISTA CREAR
        $this->load->model('mCliente');         // CARGO EL MODELO NECESARIO
        $this->load->library('pagination');     // CARGO LA LIBRERIA PAGINACION
    }
    public function fBono($tituloPagina)
    {
        $data["titulo"]=$tituloPagina;
        $data2['bonos'] = $this->mAlquilerBono->fCargarBonos(); // UTILIZO EL MODELO
        $this->load->view('mantenimiento/vCabecera', $data);  
        $this->load->view('mantenimiento/vAlquilerBono/vMantenimientoBonos',$data2);         
    }
    public function fAlquilerCompacto()
    {
        $config['base_url']=base_url().'index.php/cAlquilerBono/fAlquilerCompacto';
        $config['total_rows']=$this->mAlquilerBono->fCantidadAlquileres();
        $config['per_page']=8;
        $config['num_links']=10;
        $config['first_link']="PRIMERO";
        $config['last_link']="ÚLTIMO";
        $config['next_link']="Siguiente > >";
        $config['prev_link']="< <    Anterior";

        $config['cur_tag_open']='<b class="actual">'; // PARA ESTILOS
        $config['cur_tag_close']='</b>';

        $config['full_tag_open']='<div id="paginacion">';  // PARA ESTILOS
        $config['full_tag_close']='</div>';

        $this->pagination->initialize($config);

        // LOS DOS AHORA LOS LLAMO DESDE LA VISTA PARA RESUMEN DE ALQUILERES CON UN FOREACH Y LOS RECORRO
        $data2 = array ('alquileres'=>$this->mAlquilerBono->fCargarAlquileresCompactos($config['per_page']), 
                        'bloquepaginacion'=> $this->pagination->create_links());
        $data2['clientes'] = $this->mCliente->fCargarClientes(); // UTILIZO EL MODELO
        $data2['bonos'] = $this->mAlquilerBono->fCargarBonos();  // UTILIZO EL MODELO
        $this->load->view('mantenimiento/vCabecera');  
        $this->load->view('mantenimiento/vAlquilerBono/vMantenimientoAlquileres',$data2);        
    }
    public function fAlquilerB($tituloPagina, $queesdeB, $identificador) // fAlquilerB es de Bono, segun su id por eso mismo buscamos en el where
    {
        $data["titulo"]=$tituloPagina;
        $data["identificador"]=$identificador;
        $data["queesdeBBC"]=$queesdeB;
        $data2['alquileres'] = $this->mAlquilerBono->fCargarAlquileresB($identificador); // UTILIZO EL MODELO
        $data2['clientes'] = $this->mCliente->fCargarClientes(); // UTILIZO EL MODELO
        $data2['bonos'] = $this->mAlquilerBono->fCargarBonos(); // UTILIZO EL MODELO
        $this->load->view('mantenimiento/vCabecera', $data);  
        $this->load->view('mantenimiento/vAlquilerBono/vMantenimientoAlquileres',$data2);         
    }
    public function fMinimaAutorizacion() 
    {
        $config['base_url']=base_url().'index.php/cAlquilerBono/fMinimaAutorizacion';
        $config['total_rows']=$this->mAlquilerBono->fCantidadAlquileres();
        $config['per_page']=8;
        $config['num_links']=10;
        $config['first_link']="PRIMERO";
        $config['last_link']="ÚLTIMO";
        $config['next_link']="Siguiente > >";
        $config['prev_link']="< <    Anterior";

        $config['cur_tag_open']='<b class="actual">'; // PARA ESTILOS
        $config['cur_tag_close']='</b>';

        $config['full_tag_open']='<div id="paginacion">';  // PARA ESTILOS
        $config['full_tag_close']='</div>';

        $this->pagination->initialize($config);

        // LOS DOS AHORA LOS LLAMO DESDE LA VISTA PARA RESUMEN DE ALQUILERES CON UN FOREACH Y LOS RECORRO
        $data2 = array ('alquileres'=>$this->mAlquilerBono->fCargarAlquileresCompactos($config['per_page']), 
                        'bloquepaginacion'=> $this->pagination->create_links());
        $data2['clientes'] = $this->mCliente->fCargarClientes(); // UTILIZO EL MODELO
        $data2['bonos'] = $this->mAlquilerBono->fCargarBonos(); // UTILIZO EL MODELO
        $this->load->view('mantenimiento/vCabecera');  
        $this->load->view('mantenimiento/vAlquilerBono/vMinimaAutorizacion',$data2);    
    }
    public function fBorrarBono($idBonoPasar) 
    {
        $this->mAlquilerBono->fBorrarBono($idBonoPasar);
        redirect ('cAlquilerBono/fBono/Bonos', 'location');
    }
    public function fModificarBono($tituloPagina, $idBonoPasar)
    {
        $data["titulo"]=$tituloPagina;
        $data2['eseBono'] = $this->mAlquilerBono->fCargarEseBono($idBonoPasar);
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vAlquilerBono/vModificarBono', $data2); 
    }
    public function fCrearBono($tituloPagina)
    {
        $data["titulo"]=$tituloPagina;
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vAlquilerBono/vCrearBono'); 
    }
    public function fCrearAlquiler($tituloPagina, $matriculaPasar)
    {
        $data["titulo"]=$tituloPagina;
        $data2['clientes'] = $this->mCliente->fCargarClientes(); // UTILIZO EL MODELO
        $data2["matriculaPasada"]=$matriculaPasar;
        $data2['bonos'] = $this->mAlquilerBono->fCargarBonos(); // UTILIZO EL MODELO
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vAlquilerBono/vCrearAlquiler', $data2); 
    }
    public function fBorrarAlquiler($matriculaPasar, $dniPasar, $fechaInicioPasar, $fechaFinPasar) 
    {
        $this->mAlquilerBono->fBorrarAlquiler($matriculaPasar, $dniPasar, $fechaInicioPasar, $fechaFinPasar);
        redirect ('cAlquilerBono/fAlquilerCompacto', 'location');
    }
    
}