<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// error_reporting(0);
class WelcomeForntend extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('form_validation','Excel_reader','ValidationTypes','email','pagination'));
		$this->load->helper(array('form','html','Util'));
		$this->load->database();
		$this->load->model('User');
		$this->load->model('Userdetails_model'); 
		$this->load->model('Project_model');
		$this->load->model('Gallery_model');
		$this->load->model('GalleryType_model'); 
		$this->load->model('Job_model');
		$this->load->model('Service_model');
		$this->load->model('ServiceContent_model');
		$this->load->model('Banner_model');
		$this->load->model('ClientLogo_model');
		$this->load->model('BuyNowimg_model');
		$this->load->model('Menu_model');
		$this->load->model('CountList_model');
		log_custom_message("Welcome Controller Constructor Called");
	}

	// == front end pages  start===  //
    public function index()
	{  
        $id=1;
        $last = $this->uri->total_segments();
        if(empty($last)) {
              $metaid="Home";
        }else{
        	 $metaid = $this->uri->segment($last);
        }
        $data['metalinks'] =$this->Menu_model->MenusgetForMetaDataToForntView($metaid);

		$data['banner'] =$this->Banner_model->bannerForFontView($id); 
	    $data['ourprojects'] =$this->Project_model->OurProjectForHome(); 
	    $data['clientprojects'] =$this->Project_model->ClientProjectForHome(); 
	    $data['services'] =$this->Service_model->serviceForForntView(); 
	    $data['clientlogos'] =$this->ClientLogo_model->OurClientLogoForFontView();  
	    $data['buynowimg'] =$this->BuyNowimg_model->BuyNowimgForFontviewHome(); 
	    $data['servicestype'] =$this->Service_model->getServiceType();
	    // print_r($data['servicestype']);
		$this->load->view('home',$data);
	}

    public function aboutusView()
	{   
		 
	    $id=2;
		$data['banner'] =$this->Banner_model->bannerForFontView($id); 
		$data['clientlogos'] =$this->ClientLogo_model->OurClientLogoForFontView();

		$last = $this->uri->total_segments();
        if(empty($last)) {
              $metaid="Home";
        }else{
        	 $metaid = $this->uri->segment($last);
        }
        $data['metalinks'] =$this->Menu_model->MenusgetForMetaDataToForntView($metaid);
        $data['servicestype'] =$this->Service_model->getServiceType();
        $data['countlist'] =$this->CountList_model->CountListForFrontViewAbout();
        // print_r($data['countlist']);
		$this->load->view('aboutus',$data);
	}

	public function ServiceFullView()
	{   
		// $id=$this->uri->segment(3);
		 $servicetypeid=$this->uri->segment(1);
         $servicetypeid=Service_model::Where('service_url','=',$servicetypeid)->get(['id']);
         json_encode(array('data'=>$servicetypeid)); 
		 $id= $servicetypeid[0]['id'];
		 $data['servicecontent'] =$this->ServiceContent_model->serviceContentForFullPage($id);
		 $data['clientlogos'] =$this->ClientLogo_model->OurClientLogoForFontView();
		
		$last = $this->uri->total_segments();
        if(empty($last)) {
              $metaid="Home";
        }else{
        	 $metaid = $this->uri->segment($last);
        }
        $data['metalinks'] =$this->Menu_model->MenusgetForMetaDataToForntView($metaid);
       
        $data['servicestype'] =$this->Service_model->getServiceType();
		$this->load->view('services',$data);
	}
    
	

	public function galleryView()
	{    
		$id=6;
		$data['banner'] =$this->Banner_model->bannerForFontView($id);

	    $data['gallerytype'] = $this->GalleryType_model->GalleryTypesForForntView();
	    $data["gallery"] = $this->Gallery_model->gallerydataForForntView();
        // $config = array();
        // $config["base_url"] = "/".base_url()."Welcome/galleryView";
        // $config["total_rows"] = $this->Gallery_model->record_count();
        // $config["per_page"] =6;
        // $config["uri_segment"] = 3;
        // $this->pagination->initialize($config);
        // $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // $data["gallery"] = $this->Gallery_model->gallerydataForForntView($config["per_page"],$page);
        //  $data["links"] = $this->pagination->create_links();
        $data['clientlogos'] =$this->ClientLogo_model->OurClientLogoForFontView();
      
		$last = $this->uri->total_segments();
        if(empty($last)) {
              $metaid="Home";
        }else{
        	 $metaid = $this->uri->segment($last);
        }

        $data['metalinks'] =$this->Menu_model->MenusgetForMetaDataToForntView($metaid);
        $data['servicestype'] =$this->Service_model->getServiceType();
		$this->load->view('gallery',$data);
	}
    
    public function careerView()
	{   
		$id=7;
		$data['banner'] =$this->Banner_model->bannerForFontView($id);
		$data['jobdata'] = $this->Job_model->jobdataForForntView();
		$data['clientlogos'] =$this->ClientLogo_model->OurClientLogoForFontView();
		$last = $this->uri->total_segments();
        if(empty($last)) {
              $metaid="Home";
        }else{
        	 $metaid = $this->uri->segment($last);
        }
		$data['servicestype'] =$this->Service_model->getServiceType();
		$this->load->view('career',$data);
	}

	public function contactView()
	{   
		
		$id=9;
		$data['banner'] =$this->Banner_model->bannerForFontView($id);
		$data['clientlogos'] =$this->ClientLogo_model->OurClientLogoForFontView();
		$last = $this->uri->total_segments();
        if(empty($last)) {
              $metaid="Home";
        }else{
        	 $metaid = $this->uri->segment($last);
        }
        $data['metalinks'] =$this->Menu_model->MenusgetForMetaDataToForntView($metaid);
        $data['servicestype'] =$this->Service_model->getServiceType();
		$this->load->view('contact',$data);
	}

	public function ourproductsView()
	{   
		$id=3;
		$data['banner'] =$this->Banner_model->bannerForFontView($id);
		$data['clientlogos'] =$this->ClientLogo_model->OurClientLogoForFontView();
		
		$last = $this->uri->total_segments();
        if(empty($last)) {
              $metaid="Home";
        }else{
        	 $metaid = $this->uri->segment($last);
        }
        $data['metalinks'] =$this->Menu_model->MenusgetForMetaDataToForntView($metaid);
        $data['servicestype'] =$this->Service_model->getServiceType();
		$this->load->view('ourproducts',$data);
	}
    
    public function ourprojectsView()
	{   $id=4;
		$data['banner'] =$this->Banner_model->bannerForFontView($id);
		$data['clientlogos'] =$this->ClientLogo_model->OurClientLogoForFontView();
	
		$last = $this->uri->total_segments();
        if(empty($last)) {
              $metaid="Home";
        }else{
        	 $metaid = $this->uri->segment($last);
        }
        $data['metalinks'] =$this->Menu_model->MenusgetForMetaDataToForntView($metaid);
        $data['servicestype'] =$this->Service_model->getServiceType();
		$this->load->view('ourprojects',$data);
	}



 public function privacypolicyView()
	{   
		$data['clientlogos'] =$this->ClientLogo_model->OurClientLogoForFontView();
	
		$last = $this->uri->total_segments();
        if(empty($last)) {
              $metaid="Home";
        }else{
        	 $metaid = $this->uri->segment($last);
        }
        $data['metalinks'] =$this->Menu_model->MenusgetForMetaDataToForntView($metaid);
        $data['servicestype'] =$this->Service_model->getServiceType();
		$this->load->view('privacypolicy',$data);
	}


	// == front end pages end===  //
	
	
    

}
?>