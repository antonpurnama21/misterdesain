<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PublicDash extends CI_Controller {

	public $data = array();

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Mod_crud');
		$this->load->model('Mod_common');
		
		 
	}

	public function render($template, $view, $dt)
	{
		$data = array_merge($dt, array(
                'settingsvalue' 	=> $this->Mod_crud->getData('row','*','tbl_settings'),
				'social'    		=> $this->Mod_crud->getData('result','*','tbl_social_link'),
				'partner_client'   	=> $this->Mod_crud->getData('result','*','tbl_partner_client'),
				)
		);
		
		$this->template->load($template, $view, $data);
	}
}

/* End of file CommonDash.php */
/* Location: ./application/controllers/CommonDash.php */