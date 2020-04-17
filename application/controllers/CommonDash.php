<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommonDash extends CI_Controller {

	public $data = array();
	public $sess = null;

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_login_access') != 1) :
			redirect(base_url('auth/login')) ; 
		endif;
		$this->load->database();
		$this->load->model('Mod_crud');
		$this->load->model('Mod_common');
		$this->sess = $this->session->userdata();
		
		 
	}

	public function render($template, $view, $dt)
	{
		$id = $this->sess['user_login_id'];
		$data = array_merge($dt, array(
				'sesi' => $this->sess,
				'profilevalue' 	=> $this->Mod_crud->getData('row','*','tbl_users',null,null,null,array('id_user = "'.$id.'"')),
				'query_user' 	=> $this->Mod_crud->notifications_user($id),
				'settingsvalue' => $this->Mod_crud->getData('row','*','tbl_settings'),
				'todolist' => $this->Mod_crud->getData('result','*','to_do_list',null,null,null,array('id_user = "'.$id.'"'),null,array('id DESC'))
				)
		);
		
		$this->template->load($template, $view, $data);
	}
}

/* End of file CommonDash.php */
/* Location: ./application/controllers/CommonDash.php */