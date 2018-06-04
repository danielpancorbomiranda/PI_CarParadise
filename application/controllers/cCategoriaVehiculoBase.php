<?php 
/*
 * CLASE DEL CONTROLADOR DE CATEGORIA VEHICULO BASE CON SUS MODELOS PARA 
 * EJECUTAR LOS METODOS SEGUN CASO
 */
class cCategoriaVehiculoBase extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mCategoriaVehiculoBase');    // CARGO EL MODELO NECESARIO
        $this->load->model('mAlquilerBono');             // CARGO EL MODELO NECESARIO
        $this->load->library('pagination');     // CARGO LA LIBRERIA PAGINACION
    }
    public function fCategoria($tituloPagina)
    {
        $data["titulo"]=$tituloPagina;
        $data2['categorias'] = $this->mCategoriaVehiculoBase->fCargarCategorias(); // UTILIZO EL MODELO
        $this->load->view('mantenimiento/vCabecera', $data);  
        $this->load->view('mantenimiento/vCategoriaVehiculoBase/vMantenimientoCategorias',$data2);         
    }
    public function fBase($tituloPagina)
    {
        $data["titulo"]=$tituloPagina;
        $data2['bases'] = $this->mCategoriaVehiculoBase->fCargarBases(); // UTILIZO EL MODELO
        $this->load->view('mantenimiento/vCabecera', $data);  
        $this->load->view('mantenimiento/vCategoriaVehiculoBase/vMantenimientoBases',$data2);         
    }
    public function fVehiculoCompacto()
    {
        $config['base_url']=base_url().'index.php/cCategoriaVehiculoBase/fVehiculoCompacto';
        $config['total_rows']=$this->mCategoriaVehiculoBase->fCantidadVehiculos();
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

        // LOS DOS AHORA LOS LLAMO DESDE LA VISTA PARA RESUMEN DE VEHICULOS CON UN FOREACH Y LOS RECORRO
        $data2 = array ('vehiculos'=>$this->mCategoriaVehiculoBase->fCargarVehiculosCompactos($config['per_page']), 
                        'bloquepaginacion'=> $this->pagination->create_links());
        $this->load->view('mantenimiento/vCabecera');  
        $this->load->view('mantenimiento/vCategoriaVehiculoBase/vMantenimientoVehiculos',$data2);        
    }
    public function fVehiculoBC($tituloPagina, $queesdeBC, $identificador) // BC es Base o Categoria, segun su id por eso mismo buscamos en el where
    {
        $data["titulo"]=$tituloPagina;
        $data["queesdeBBC"]=$queesdeBC;
        $data["identificador"]=$identificador;
        $data2['vehiculos'] = $this->mCategoriaVehiculoBase->fCargarVehiculosBC($queesdeBC, $identificador); // UTILIZO EL MODELO
        $this->load->view('mantenimiento/vCabecera', $data);  
        $this->load->view('mantenimiento/vCategoriaVehiculoBase/vMantenimientoVehiculos',$data2);         
    }
    public function fBorrarBase($codigoBasePasar) 
    {
        $this->mCategoriaVehiculoBase->fBorrarBase($codigoBasePasar);
        redirect ('cCategoriaVehiculoBase/fBase/Bases', 'location');
    }
    public function fBorrarCategoria($grupoCategoriaPasar) 
    {
        $this->mCategoriaVehiculoBase->fBorrarCategoria($grupoCategoriaPasar);
        redirect ('cCategoriaVehiculoBase/fCategoria/Categorias', 'location');
    }
    public function fBorrarVehiculo($matriculaPasar) 
    {
        $this->mCategoriaVehiculoBase->fBorrarVehiculo($matriculaPasar);
        redirect ('cCategoriaVehiculoBase/fVehiculoCompacto', 'location');
    }
    public function fModificarBase($tituloPagina, $codigoBasePasar)
    {
        $data["titulo"]=$tituloPagina;
        $data2['esaBase'] = $this->mCategoriaVehiculoBase->fCargarEsaBase($codigoBasePasar);
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vCategoriaVehiculoBase/vModificarBase', $data2); 
    }
    public function fModificarCategoria($tituloPagina, $idCategoriaPasar)
    {
        $data["titulo"]=$tituloPagina;
        $data2['esaCategoria'] = $this->mCategoriaVehiculoBase->fCargarEsaCategoria($idCategoriaPasar);
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vCategoriaVehiculoBase/vModificarCategoria', $data2); 
    }
    public function fModificarVehiculo($tituloPagina, $matriculaPasar)
    {
        $data["titulo"]=$tituloPagina;
        $data2['bonos'] = $this->mAlquilerBono->fCargarBonos();          // UTILIZO EL MODELO
        $data2['bases'] = $this->mCategoriaVehiculoBase->fCargarBases(); // UTILIZO EL MODELO
        $data2['categorias'] = $this->mCategoriaVehiculoBase->fCargarCategorias(); // UTILIZO EL MODELO
        $data2['eseVehiculo'] = $this->mCategoriaVehiculoBase->fCargarEseVehiculo($matriculaPasar);
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vCategoriaVehiculoBase/vModificarVehiculo', $data2); 
    }
    public function fCrearBase($tituloPagina)
    {
        $data["titulo"]=$tituloPagina;
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vCategoriaVehiculoBase/vCrearBase'); 
    }
    public function fCrearCategoria($tituloPagina)
    {
        $data["titulo"]=$tituloPagina;
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vCategoriaVehiculoBase/vCrearCategoria'); 
    }
    public function fCrearVehiculo($tituloPagina)
    {
        $data["titulo"]=$tituloPagina;
        $data2['bases'] = $this->mCategoriaVehiculoBase->fCargarBases(); // UTILIZO EL MODELO
        $data2['categorias'] = $this->mCategoriaVehiculoBase->fCargarCategorias(); // UTILIZO EL MODELO
        $this->load->view('mantenimiento/vCabecera', $data); 
        $this->load->view('mantenimiento/vCategoriaVehiculoBase/vCrearVehiculo', $data2); 
    }
}