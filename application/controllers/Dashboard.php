<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."controllers/CommonDash.php");

class Dashboard extends CommonDash {

	public function __construct()
	{
		parent::__construct();
	}
    
	public function index()
	{
		// if(!empty($this->session->userdata('user_login_id'))){

		// }
		$data = array(
				'_JS' => generate_js(array(
					"js/chart.js",
					"js/vmap.js",
					"js/todo.js"
				)
			),
			'titleWeb' 	=> 'Home Administrator',
			
		);
		$this->render('dash_admin', 'root/dashboard', $data);
	}

	public function Add_Reset_password(){
		$id          = $this->session->userdata('user_login_id');
		$oldpass     = sha1($this->input->post('oldpass'));
		$newpass     = $this->input->post('newpass');
		$confirmpass = $this->input->post('confirmpass');
		$userdata    = $this->Mod_crud->getData('row','*','tbl_users',null,null,null,array('id_user = "'.$id.'"'));
		if ($userdata->password == $oldpass) {
			if ($newpass != $confirmpass) {
				$response['status']  = 'error';
				$response['message'] = "New password and confirm password, not same!";
				$this->output->set_output(json_encode($response));
			}else{
				if (!empty($id)) {
					$update              = $this->Mod_crud->updateData('tbl_users', array(
						'password' => sha1($newpass),
						'seen_password' => $newpass,
						'updated_on' => date('Y-m-d h:i:sa')
					), array('id_user'=>$id));
					$response['status']  = 'success';
					$response['message'] = "Successfully Updated Your  password";
					$this->output->set_output(json_encode($response));
				}
			}
		} else {
			$response['status']  = 'error';
			$response['message'] = "Please enter Valid password";
			$this->output->set_output(json_encode($response));
		}
	}
	
	public function addTodoData(){            
		$userid   = $this->input->post('iduser');
		$tododata = $this->input->post('todo_data');
		$date     = date("Y-m-d h:i:sa");
		
		$this->load->library('form_validation');
		
		//validating to do list data
		$this->form_validation->set_rules('userid', 'user Id', 'trim|xss_clean');
		$this->form_validation->set_rules('todo_data', 'To-do Data', 'trim|required|min_length[3]|max_length[150]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {			
			$success    = $this->Mod_crud->insertData('to_do_list',array(
				'id_user' => $userid,
				'to_dodata' => $tododata,
				'value' => '1',
				'date' => $date
			));
			$todoLastId = $this->db->insert_id();
			
			if ($success) {
				
				$todoHtml = "<li class='todo-item'>";
				$todoHtml .= "<div class='checkbox checkbox-default'>";
				$todoHtml .= "<input class='to-do' data-id='" . $todoLastId . "' data-value='0' type='checkbox' id='" . $todoLastId . "'>";
				$todoHtml .= "<label for='" . $todoLastId . "'>" . $tododata . "</label>";
				$todoHtml .= "</div>";
				$todoHtml .= "</li>";
				$todoHtml .= "<li><hr class='light-grey-hr'></li>";
				
				$response['status']   = 'success';
				$response['todoHtml'] = $todoHtml;
				$response['message']  = "Successfully Added";
				$this->output->set_output(json_encode($response));
			}
		}
	}
	
	public function updateTododata(){
		$id    = $this->input->post('toid');
		$value = $this->input->post('tovalue'); // initially 0 when not completed
		
		$data   = array();
		$data   = array(
			'value' => $value
		);
		$update = $this->Mod_crud->updateData('to_do_list',array(
			'value' => $value
		), array('id'=>$id));
		
		$response['status']  = 'success';
		$response['value']   = $value;
		$response['message'] = "Successfully updated";
		$this->output->set_output(json_encode($response));
    }
}
