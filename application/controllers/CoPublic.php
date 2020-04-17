<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."controllers/PublicDash.php");

class CoPublic extends PublicDash {

	public function __construct()
	{
		parent::__construct();
		// pagination library
		$this->load->library('pagination');
	}
    
	public function index()
	{
		$data = array(
				'_JS' => generate_js(array(
				)
			),
			'titleWeb' 	=> 'Welcome To Mr. Design',
			
		);
		$data['gallery'] = $this->Mod_crud->getData('result','a.*,b.*','tbl_galleries a',8,null,array('tbl_images b'=>'a.id_gallery = b.id_gallery'),null,array('b.id DESC'));
		$data['video'] = $this->Mod_crud->getData('result','*','tbl_video',2,null,null,null,null,array('id_video DESC'));
		$data['services'] = $this->Mod_crud->getData('result','*','tbl_services');
		$this->render('dash_public', 'public/dashboard', $data);
	}

	public function about()
	{
		$data = array(
				'_JS' => generate_js(array(
				)
			),
			'titleWeb' 			=> 'About Us',
			'company_profile'   => $this->Mod_crud->getData('row','*','tbl_company_profiles'),
			'experts' 			=> $this->Mod_crud->getData('result','*','tbl_experts',null,null,null,null,null,array('FIELD(id_position,"D07") DESC')),			
		);
		$this->render('dash_public', 'public/about', $data);
	}

	public function service()
	{
		$data = array(
				'_JS' => generate_js(array(
				)
			),
			'titleWeb' 			=> 'Our Services',
			'service'    		=> $this->Mod_crud->getData('result','*','tbl_services'),		
		);
		$this->render('dash_public', 'public/services', $data);
	}

	public function images()
	{
		$data = array(
				'_JS' => generate_js(array(
				)
			),
			'titleWeb' 			=> 'Our Gallery Images',	
		);
		// set the pagination config
		$config['base_url']   = site_url('copublic/images');
		$config['total_rows'] = $this->Mod_crud->getCount('tbl_images');
		$config['per_page']   = 8;
		// initialize pagination
		$this->pagination->initialize($config);

		// set output data for search
		$data['page']   = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['data_image'] = $this->Mod_crud->get_data_list($config['per_page'], $data['page'], 'tbl_images');
		$data['thn_image'] = $this->Mod_crud->getData('result','COUNT(*) as total, DATE_FORMAT(upload_on , "%Y") as tahun','tbl_images',null,null,null,null,array('DATE_FORMAT(upload_on , "%Y")'));

		$this->render('dash_public', 'public/images', $data);
	}

	public function images_in($thn = null)
	{
		$data = array(
				'_JS' => generate_js(array(
				)
			),
			'titleWeb' 			=> 'Our Gallery Images',	
		);
		// set the pagination config
		$config['base_url']   = site_url('copublic/images_in/'.$thn);
		$config['total_rows'] = $this->Mod_crud->getCount_byID('tbl_images',array('year(upload_on)'=>$thn));
		$config['per_page']   = 8;
		// initialize pagination
		$this->pagination->initialize($config);

		// set output data for search
		$data['page']   = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['data_image'] = $this->Mod_crud->get_data_list($config['per_page'], $data['page'], 'tbl_images',array('year(upload_on)'=>$thn));
		$data['thn_image'] = $this->Mod_crud->getData('result','COUNT(*) as total, DATE_FORMAT(upload_on , "%Y") as tahun','tbl_images',null,null,null,null,array('DATE_FORMAT(upload_on , "%Y")'));

		$this->render('dash_public', 'public/images', $data);
	}

	public function videos()
	{
		$data = array(
				'_JS' => generate_js(array(
				)
			),
			'titleWeb' 			=> 'Our Gallery Videos',	
		);
		// set the pagination config
		$config['base_url']   = site_url('copublic/videos');
		$config['total_rows'] = $this->Mod_crud->getCount('tbl_video');
		$config['per_page']   = 4;
		// initialize pagination
		$this->pagination->initialize($config);

		// set output data for search
		$data['page']   = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['data_videos'] = $this->Mod_crud->get_data_list($config['per_page'], $data['page'], 'tbl_video');

		$this->render('dash_public', 'public/videos', $data);
	}

	public function order()
	{
		$data = array(
				'_JS' => generate_js(array(
				)
			),
			'titleWeb' 			=> 'Order Page',
			'service'    		=> $this->Mod_crud->getData('result','*','tbl_services'),		
		);
		$this->render('dash_public', 'public/order_page', $data);
	}
}
