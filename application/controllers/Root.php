<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."controllers/CommonDash.php");

class Root extends CommonDash {

	public function __construct()
	{
		parent::__construct();
	}
    
	public function index()
	{
		
	}

	/*to-do note validation*/
    public function addTodoData(){
        if ($this->session->userdata('user_login_access') != False) {
            
            $userid   = $this->input->post('iduser');
            $tododata = $this->input->post('todo_data');
            $date     = date("Y-m-d h:i:sa");
            
            $this->load->library('form_validation');
            
            //validating to do list data
            $this->form_validation->set_rules('iduser', 'User Id', 'trim|xss_clean');
            $this->form_validation->set_rules('todo_data', 'To-do Data', 'trim|required|min_length[3]|max_length[150]|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                $response['status']  = 'error';
                $response['message'] = validation_errors();
                $this->output->set_output(json_encode($response));
            } else {
                $data = array();
                $data = array(
                    'id_user' => $userid,
                    'to_dodata' => $tododata,
                    'value' => '1',
                    'date' => $date
                );
                
                $success    = $this->Mod_crud->insertData('to_do_list',$data);
                $todoLastId = $this->db->insert_id();
                
                if ($success) {
                    
                    $todoHtml = "<li class='todo-item'>";
                    $todoHtml .= "<div class='checkbox checkbox-default'>";
                    $todoHtml .= "<input class='to-do' data-id='" . $todoLastId . "' data-value='0' type='checkbox' id='" . $todoLastId . "'>";
                    $todoHtml .= "<label for='" . $todoLastId . "'>" . $tododata . "</label>";
                    $todoHtml .= "</div>";
                    $todoHtml .= "</li>";
                    
                    $response['status']   = 'success';
                    $response['todoHtml'] = $todoHtml;
                    $response['message']  = "Successfully Added";
                    $this->output->set_output(json_encode($response));
                }
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    /*Todo Data Update*/
    public function updateTododata(){
        
        if ($this->session->userdata('user_login_access') != False) {
            $id    = $this->input->post('toid');
            $value = $this->input->post('tovalue'); // initially 0 when not completed
            
            $data   = array();
            $data   = array(
                'value' => $value
            );
            $update = $this->Mod_crud->updateData('to_do_list', $data, array('id'=>$id));
            
            $response['status']  = 'success';
            $response['value']   = $value;
            $response['message'] = "Successfully updated";
            $this->output->set_output(json_encode($response));
        }
        
        else {
            redirect(base_url(), 'refresh');
        }
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/*Tab Users */
	public function list_user()
	{	
		
		$data = array(
		'titleWeb' 	=> 'User List',
		'titlePage' => 'User List Page',
		);
		$data['userlist'] = $this->Mod_crud->getData('result','*','tbl_users');
		$this->render('dash_admin', 'root/user_list', $data);
	}

	/*Select user information By user ID*/
	public function viewUserDataBYID()
	{
		$id                = base64_decode($this->input->get('id'));
		$data['uservalue'] = $this->Mod_crud->getData('row','*','tbl_users',null,null,null,array('id_user = "'.$id.'"'));
		echo json_encode($data);
	}

	/*Add user Form View*/
	public function Add_User()
	{
		$data = array(
			'titleWeb' 	=> 'User Create',
			'titlePage' => 'User Create Page',
			);
		$this->render('dash_admin', 'root/user_add', $data);
	}

	/*user information validation*/
    public function addUserInfo(){
        /*Custom Random password generator*/
		function rand_password($length) {
			$str   = "";
			$chars = "abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$size  = strlen($chars);
			for ($i = 0; $i < $length; $i++) {
				$str .= $chars[rand(0, $size - 1)];
			}
			return $str;
		}
		/*Set password length*/
		$password_def = rand_password(7);

		$pass_hash = sha1($password_def);
		$userid    = 'U' . rand(500, 1000);

		$username  = $this->input->post('name');
		$email     = $this->input->post('email');
		$contact   = $this->input->post('contact');
		$role      = $this->input->post('role');
		$date      = date('Y-m-d h:i:sa');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();
		// Validating Name Field
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[60]|xss_clean');
		/*validating email field*/
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[7]|max_length[100]|xss_clean');
		/*validating contact field*/
		$this->form_validation->set_rules('contact', 'Contact', 'trim|xss_clean');
		/*validating role field*/
		$this->form_validation->set_rules('role', 'Role', 'trim|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('email','tbl_users',array('email = "'.$email.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'Email already exits';
				$this->output->set_output(json_encode($response));
			} else {

				if ($_FILES['user_image']['name']) {
					$t = explode(".", $_FILES['user_image']['name']);
					$ext = end($t);
					$cfgFile= array(
							'file_name' 	=> $userid.'.'.$ext,
							'upload_path' 	=> 'assets/img/user/',
							'allowed_types' => 'jpg|png|jpeg',
							'max_size'   	=> 1024,
							// 'max_height' 	=> "600",
							// 'max_width' 	=> "600"
						);
	
					$this->load->library('Upload', $cfgFile);
					$this->upload->initialize($cfgFile);
					if (!$this->upload->do_upload('user_image')) {
						$response['status']  = 'error';
						$response['message'] = $this->upload->display_errors();
						$this->output->set_output(json_encode($response));
					}else{
						$gbr 	= $this->upload->data();
						$config['image_library'] 	= 'gd2';
						$config['source_image'] 	= 'assets/img/user/' . $gbr['file_name'];
						$config['create_thumb'] 	= FALSE;
						$config['maintain_ratio'] 	= FALSE;
						$config['quality'] 			= '50%';
						$config['width']         	= 200;
						$config['height']       	= 200;
						$config['new_image']	 	= 'assets/img/user/' . $gbr['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
					}
					$img_url = 'assets/img/user/' . $gbr['file_name'];
				} else {
					$img_url = '';
				}
	
				$success  = $this->Mod_crud->insertData('tbl_users',array(
					'id_user'		=> $userid,
					'full_name' 	=> $username,
					'email' 		=> $email,
					'password' 		=> $pass_hash,
					'seen_password' => $password_def,
					'image' 		=> $img_url,
					'contact' 		=> $contact,
					'status' 		=> 'ACTIVE',
					'role' 			=> $role,
					'created_on' 	=> $date
					)
				);

				$response['status']  = 'success';
				$response['message'] = "Successfully Insert";
				$this->output->set_output(json_encode($response));
				#$this->session->set_flashdata('feedback','Successfully Updated');
			}
		}
    }

	/*user information update validation*/
    public function updateValue(){
		$id       = $this->input->post('iduser');
		$username = $this->input->post('name');
		$email    = $this->input->post('email');
		$contact  = $this->input->post('contact');
		$role     = $this->input->post('role');
		$date 	  = date('Y-m-d h:i:sa');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();
		// Validating Name Field
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[60]|xss_clean');
		/*validating email field*/
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[7]|max_length[100]|xss_clean');
		/*validating contact field*/
		$this->form_validation->set_rules('contact', 'Contact', 'trim|xss_clean');
		/*validating role field*/
		$this->form_validation->set_rules('role', 'Role', 'trim|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('email','tbl_users',array('email = "'.$email.'"','id_user != "'.$id.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'Email already exits';
				$this->output->set_output(json_encode($response));
			} else {
				$profile       = $this->Mod_crud->getData('row','*','tbl_users',null,null,null,array('id_user = "'.$id.'"'));
				
				if ($_FILES['user_image']['name']) {
					$t = explode(".", $_FILES['user_image']['name']);
					$ext = end($t);
					$cfgFile= array(
							'file_name' 	=> $id.'.'.$ext,
							'upload_path' 	=> 'assets/img/user/',
							'allowed_types' => 'jpg|png|jpeg',
							'max_size'   	=> 1024,
							// 'max_height' 	=> "600",
							// 'max_width' 	=> "600"
						);

					$this->load->library('Upload', $cfgFile);
					$this->upload->initialize($cfgFile);
					if (!$this->upload->do_upload('user_image')) {
						$response['status']  = 'error';
						$response['message'] = $this->upload->display_errors();
						$this->output->set_output(json_encode($response));
					}else{
						$gbr 	= $this->upload->data();
						$config['image_library'] 	= 'gd2';
						$config['source_image'] 	= 'assets/img/user/' . $gbr['file_name'];
						$config['create_thumb'] 	= FALSE;
						$config['maintain_ratio'] 	= FALSE;
						$config['quality'] 			= '50%';
						$config['width']         	= 200;
						$config['height']       	= 200;
						$config['new_image']	 	= 'assets/img/user/' . $gbr['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();

						if (file_exists($profile->image)) {
							unlink($profile->image);
						}
					}

					$img_url = 'assets/img/user/' . $gbr['file_name'];
				} else {
					$img_url = $profile->image;
				}

				$success  = $this->Mod_crud->updateData('tbl_users',array(
					'full_name' => $username,
					'email' 	=> $email,
					'image' 	=> $img_url,
					'contact' 	=> $contact,
					'role' 		=> $role,
					'updated_on'=> $date
				), array('id_user' => $id));

				$response['status']  = 'success';
				$response['message'] = "Successfully Updated";
				$this->output->set_output(json_encode($response));
				#$this->session->set_flashdata('feedback','Successfully Updated'); 
			}
		}
	}

	/*user profile*/
	public function View_profile()
	{
		$userid = base64_decode($this->input->get('U'));
		$data = array(
			'titleWeb' 	=> 'User Profile',
			'titlePage' => 'Profile Page',
			);
		$data['profile']  	= $this->Mod_crud->getData('row','*','tbl_users',null,null,null,array('id_user = "'.$userid.'"'));
		$data['usernote']	= $this->Mod_crud->getData('result','n.*,u.full_name,u.image','tbl_notes n',null,null,array('tbl_users u'=>'u.id_user = n.comment_id'),array('n.id_user = "'.$userid.'"'));
		$this->render('dash_admin', 'root/user_profile', $data);
	}
	// Download file image
	public function Download_image(){
		// Get parameters
		$file     = $this->input->get('image');
		$filepath = "./" . $file;
		// Process download
		if (file_exists($filepath)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filepath));
			flush(); // Flush system output buffer
			readfile($filepath);
			exit();
		}
	}

	// user delete
	public function delete(){
		$id = base64_decode($this->input->post('id'));
		$get_image 	= $this->Mod_crud->getData('row','image','tbl_users',null,null,null,array('id_user = "'.$id.'"'));
		$delete_user= $this->Mod_crud->deleteData('tbl_users', array('id_user' => $id));
		if ($delete_user){
			if (!empty($get_image)){
			unlink(FCPATH . $get_image->image);
			}
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}	
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/* tab Note */
	/*Note validation*/
	public function noteValidation()
	{
		$userid      = base64_decode($this->input->post('iduser'));
		$commentid   = base64_decode($this->input->post('commentid'));
		$description = $this->input->post('description');
		$date        = date("Y-m-d h:i:sa");
		$this->load->library('form_validation');
		// Validating group name Field
		$this->form_validation->set_rules('iduser', 'User Id', 'required|xss_clean');
		$this->form_validation->set_rules('commentid', 'Comment ID', 'required|trim|xss_clean');
		$this->form_validation->set_rules('description', 'description', 'required|trim|min_length[10]|max_length[1024]|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($_FILES['note_file']['name']) {
				$file_name = $_FILES['note_file']['name'];
				$fileSize  = $_FILES["note_file"]["size"] / 1024;
				$fileType  = $_FILES["note_file"]["type"];
				
				$config = array(
					'upload_path' => "./assets/img/note",
					'allowed_types' => "gif|jpg|png|jpeg|pdf",
					'overwrite' => False,
					'max_size' => "40480000", // Can be set to particular file size , here it is 4 MB(2048 Kb)
					'max_height' => "2100",
					'max_width' => "2100"
				);
				
				$this->load->library('Upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('note_file')) {
					$response['status']  = 'success';
					$response['message'] = $this->upload->display_errors();
					$this->output->set_output(json_encode($response));
				} else {
					$path                = $this->upload->data();
					$img_url             = 'assets/img/note/'.$path['file_name'];
					$success  = $this->Mod_crud->insertData('tbl_notes',array(
						'id_user' 		=> $userid,
						'comment_id' 	=> $commentid,
						'description' 	=> $description,
						'note_image' 	=> $img_url,
						'datetime' 		=> $date
						)
					);
					$response['status']  = 'success';
					$response['message'] = "Successfully Added";
					$this->output->set_output(json_encode($response));
				}
			} else {
				$success  = $this->Mod_crud->insertData('tbl_notes',array(
					'id_user' 		=> $userid,
					'comment_id' 	=> $commentid,
					'description' 	=> $description,
					'datetime' 		=> $date
					)
				);
				$response['status']  = 'success';
				$response['message'] = "Successfully Added";
				$this->output->set_output(json_encode($response));
			}
		}
	}
	
	/*Notification note*/
    function set_note(){
        $id = $_POST["id"];
		$this->Mod_crud->updateData('tbl_notes',array(
			'notification_status' => 'seen'
		),array('id_user' => $id, 'notification_status' => 'unseen'));
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/* tab role */
	/*Group list for admin*/
	public function ListGroup(){
		if ($this->session->userdata('user_login_access') != False && $this->session->userdata('user_role') == 'Admin') {
			$data = array(
				'titleWeb' 	=> 'User Role',
				'titlePage' => 'User Role Page',
				);
			$data['userrole'] = $this->Mod_crud->getData('result','*','tbl_users',null,null,null,array('role = "User"'));
			$data['adminrole'] = $this->Mod_crud->getData('result','*','tbl_users',null,null,null,array('role = "Admin"'));
			$this->render('dash_admin', 'root/user_group', $data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}

	/*Select Group data by id */
	public function groupDataByID(){
		if ($this->session->userdata('user_login_access') != False && $this->session->userdata('user_role') == 'Admin') {
			$id            = base64_decode($this->input->get('id'));
			$data['value'] = $this->Mod_crud->getData('row','*','tbl_users',null,null,null,array('id_user = "'.$id.'"'));
			echo json_encode($data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}

	/*group information update*/
	public function Update_Group(){
		if ($this->session->userdata('user_login_access') != False && $this->session->userdata('user_role') == 'Admin') {
			
			$id   = $this->input->post('iduser');
			$role = $this->input->post('role');
			
			$this->load->library('form_validation');
			
			// Validating group name Field
			$this->form_validation->set_rules('groupname', 'Group name', 'trim|min_length[2]|max_length[25]|xss_clean');
			
			if ($this->form_validation->run() == FALSE) {
				
				$response['status']  = 'error';
				$response['message'] = validation_errors();
				$this->output->set_output(json_encode($response));
				
			} else {
				
				$success = $this->Mod_crud->updateData('tbl_users',array(
					'role' => $role
				),array('id_user'=>$id));
				
				if ($success) {
					$response['status']  = 'success';
					$response['message'] = "Successfully Updated";
					$this->output->set_output(json_encode($response));
				}
			}
		} else {
			redirect(base_url(), 'refresh');
		}
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/* Tab Service */
	// List service
	public function list_service()
	{
		$data = array(
			'titleWeb' 	=> 'Service List',
			'titlePage' => 'Service List Page',
			);
		$data['data'] = $this->Mod_crud->getData('result','*','tbl_services');
		$this->render('dash_admin', 'root/service_list', $data);
	}
	// form add service
	public function add_service()
	{
		$data = array(
			'titleWeb' 	=> 'Service Create',
			'titlePage' => 'Service Create Page',
			);
		$this->render('dash_admin', 'root/service_add', $data);
	}

	// add service
	public function do_addService()
	{
		$service_name	= $this->input->post('service_name');
		$description	= $this->input->post('description');
		$created_on		= date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('service_name', 'Service name', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[10]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('service_name','tbl_services',array('service_name = "'.$service_name.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'Service already exits';
				$this->output->set_output(json_encode($response));
			} else {
				$id_service = $this->Mod_common->autoNumber('id_service','tbl_services','J',2);
				$success  = $this->Mod_crud->insertData('tbl_services',array(
					'id_service'	=> $id_service,
					'service_name' 	=> $service_name,
					'description' 	=> $description,
					'created_on' 	=> $created_on
					)
				);

				$response['status']  = 'success';
				$response['message'] = "Successfully Insert";
				$this->output->set_output(json_encode($response));
				#$this->session->set_flashdata('feedback','Successfully Updated');
			}
		}
	}

	public function viewServiceDataBYID()
	{
		$id                = $this->input->get('id');
		$data['dataresult'] = $this->Mod_crud->getData('row','*','tbl_services',null,null,null,array('id_service = "'.$id.'"'));
		echo json_encode($data);
	}

	// update service
	public function do_updateService()
	{
		$id_service		= $this->input->post('id_service');
		$service_name	= $this->input->post('service_name');
		$description    = $this->input->post('description');
		$updated_on		= date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('id_service','ID','required|xss_clean');
		$this->form_validation->set_rules('service_name', 'Service Name', 'trim|required|min_length[3]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[10]|max_length[255]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('service_name','tbl_services',array('service_name = "'.$service_name.'"','id_service != "'.$id_service.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'Service already exits';
				$this->output->set_output(json_encode($response));
			} else {
				$success  = $this->Mod_crud->updateData('tbl_services',array(
					'service_name' 	=> $service_name,
					'description' 	=> $description,
					'updated_on'	=> $updated_on
				), array('id_service' => $id_service));

				$response['status']  = 'success';
				$response['message'] = "Successfully Updated";
				$this->output->set_output(json_encode($response));
				#$this->session->set_flashdata('feedback','Successfully Updated'); 
			}
		}
	}

	// delete service
	public function deleteService(){
		$delete_service= $this->Mod_crud->deleteData('tbl_services', array('id_service' => $this->input->post('id')));
		if ($delete_service){
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}	
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/* Tab Kategori */
	// List Category
	public function list_category()
	{
		$data = array(
			'titleWeb' 	=> 'Category List',
			'titlePage' => 'Category List Page',
			);
		$data['data'] = $this->Mod_crud->getData('result','*','tbl_categories');
		$this->render('dash_admin', 'root/category_list', $data);
	}
	// form add category
	public function add_category()
	{
		$data = array(
			'titleWeb' 	=> 'Category Create',
			'titlePage' => 'Category Create Page',
			);
		$this->render('dash_admin', 'root/category_add', $data);
	}

	// add category
	public function do_addCategory()
	{
		$category_name	= $this->input->post('category_name');
		$created_on		= date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('category_name', 'Nama Kategori', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('category_name','tbl_categories',array('category_name = "'.$category_name.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'Category already exits';
				$this->output->set_output(json_encode($response));
			} else {
				$id_category = $this->Mod_common->autoNumber('id_category','tbl_categories','C',2);
				$success  = $this->Mod_crud->insertData('tbl_categories',array(
					'id_category'	=> $id_category,
					'category_name' => $category_name,
					'created_on' 	=> $created_on
					)
				);

				$response['status']  = 'success';
				$response['message'] = "Successfully Insert";
				$this->output->set_output(json_encode($response));
				#$this->session->set_flashdata('feedback','Successfully Updated');
			}
		}
	}

	public function viewCategoryDataBYID()
	{
		$id                = $this->input->get('id');
		$data['dataresult'] = $this->Mod_crud->getData('row','*','tbl_categories',null,null,null,array('id_category = "'.$id.'"'));
		echo json_encode($data);
	}

	// update category
	public function do_updatecategory()
	{
		$id_category		= $this->input->post('id_category');
		$category_name	= $this->input->post('category_name');
		$description    = $this->input->post('description');
		$updated_on		= date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('id_category','ID','required|xss_clean');
		$this->form_validation->set_rules('category_name', 'Nama Kategori', 'trim|required|min_length[3]|max_length[255]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('category_name','tbl_categories',array('category_name = "'.$category_name.'"','id_category != "'.$id_category.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'Category already exits';
				$this->output->set_output(json_encode($response));
			} else {
				$success  = $this->Mod_crud->updateData('tbl_categories',array(
					'category_name' 	=> $category_name,
					'updated_on'		=> $updated_on
				), array('id_category' => $id_category));

				$response['status']  = 'success';
				$response['message'] = "Successfully Updated";
				$this->output->set_output(json_encode($response));
				#$this->session->set_flashdata('feedback','Successfully Updated'); 
			}
		}
	}

	// delete category
	public function deleteCategory(){
		$delete_category= $this->Mod_crud->deleteData('tbl_categories', array('id_category' => $this->input->post('id')));
		if ($delete_category){
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}	
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/* Tab Gallery */
	/*List Gallery*/
	public function list_gallery(){
		$data = array(
			'titleWeb' 	=> 'Gallery List',
			'titlePage' => 'Gallery List Page',
			);
		$data['data'] = $this->Mod_crud->getData('result','g.*,img.*','tbl_galleries g',null,null,array('tbl_images img'=>'g.id_gallery = img.id_gallery'),null,null,array('g.id_gallery DESC'));
		$this->render('dash_admin', 'root/gallery_list', $data);
	}

	public function add_gallery()
	{
		$data = array(
			'titleWeb' 	=> 'Galery Upload',
			'titlePage' => 'Upload Page',
			);
		$data['category'] = $this->Mod_crud->getData('result','*','tbl_categories');
		$data['service'] = $this->Mod_crud->getData('result','*','tbl_services');
		$this->render('dash_admin', 'root/gallery_add', $data);
	}

	public function do_upload()
	{
		if ($this->session->userdata('user_login_access') != False) {
			$id       		= 'G' . rand(0, 1000);
			$date			= date('Y-m-d h:i:sa');
            $category       = $this->input->post('category');
			$service        = $this->input->post('service');
			$type        	= $this->input->post('type');
            $description    = $this->input->post('description');
			$this->load->library('form_validation');
			
            $this->form_validation->set_rules('category', 'Category', 'xss_clean|required');
			$this->form_validation->set_rules('type', 'Type', 'xss_clean|required');
			$this->form_validation->set_rules('service', 'Service', 'xss_clean|required');
            $this->form_validation->set_rules('description', 'Description', 'xss_clean|required');
            
            if ($this->form_validation->run() == FALSE) {
                $response['status']  = 'error';
                $response['message'] = validation_errors();
                $this->output->set_output(json_encode($response));
            } else {
                $dataInfo = array();
                $files    = $_FILES;
                $cpt      = count($_FILES['gallery_image']['name']);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['gallery_image']['name']     = $files['gallery_image']['name'][$i];
                    $_FILES['gallery_image']['type']     = $files['gallery_image']['type'][$i];
                    $_FILES['gallery_image']['tmp_name'] = $files['gallery_image']['tmp_name'][$i];
                    $_FILES['gallery_image']['error']    = $files['gallery_image']['error'][$i];
                    $_FILES['gallery_image']['size']     = $files['gallery_image']['size'][$i];
                    $uploadPath                          = 'assets/img/gallery';
                    $config['upload_path']               = $uploadPath;
                    $config['allowed_types']             = 'gif|jpg|png';
                    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('gallery_image')) {
                        $fileData                    = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                        $data1                       = array();
                        $data1                       = array(
							'id_gallery' 	=> $id,
							'img_url' 		=> 'assets/img/gallery/'.$uploadData[$i]['file_name'],
							'upload_on' 	=> $date
                        );
                        $success            = $this->Mod_crud->insertData('tbl_images',$data1);
                    }
                }
                if (!empty($uploadData)) {
                    $data                = $this->Mod_crud->insertData('tbl_galleries',array(
                        'id_gallery' 	=> $id,
                        'id_category' 	=> $category,
                        'id_service' 	=> $service,
                        'type_gallery' 	=> $type,
						'desc_gallery' 	=> $description,
						'created_on'	=> $date,
						'created_by'	=> $this->session->userdata('user_login_id')
                    ));
                    $response['status']  = 'success';
                    $response['message'] = "Successfully Added";
                    $this->output->set_output(json_encode($response));
                }
            }
        } else {
            redirect(base_url(), 'refresh');
        }
	}

	public function update_gallery()
	{	
		$id                 = base64_decode($this->input->get('id'));
		$data = array(
			'titleWeb' 	=> 'Galery Upload',
			'titlePage' => 'Upload Page',
			);
		$data['category'] = $this->Mod_crud->getData('result','*','tbl_categories');
		$data['service'] = $this->Mod_crud->getData('result','*','tbl_services');
		$data['gallery'] = $this->Mod_crud->getData('row','*','tbl_galleries',null,null,null,array('id_gallery = "'.$id.'"'));
		$data['image'] = $this->Mod_crud->getData('result','*','tbl_images',null,null,null,array('id_gallery = "'.$id.'"'));
		$this->render('dash_admin', 'root/gallery_update', $data);
	}

	public function unlink_image()
	{
		$id       = $this->input->get('UN');
		$imgvalue = $this->Mod_crud->getData('row','id, img_url','tbl_images',null,null,null,array('id = "'.$id.'"'));
		if (!empty($imgvalue->id)) {
			unlink($imgvalue->img_url);
			$delet               = $this->Mod_crud->deleteData('tbl_images',array('id'=>$id));
			$response['status']  = 'success';
			$response['message'] = "Successfully Deleted";
			$this->output->set_output(json_encode($response));
		}
	}

	/*Gallery update*/
    public function do_updateUpload(){
        if ($this->session->userdata('user_login_access') != False) {
            $id          = $this->input->post('id');
			$date		 = date('Y-m-d h:i:sa');
            $category    = $this->input->post('category');
			$service     = $this->input->post('service');
			$type        = $this->input->post('type');
			$description = $this->input->post('description');
			
			$this->load->library('form_validation');
			
            $this->form_validation->set_rules('category', 'Category', 'xss_clean|required');
			$this->form_validation->set_rules('type', 'Type', 'xss_clean|required');
			$this->form_validation->set_rules('service', 'Service', 'xss_clean|required');
            $this->form_validation->set_rules('description', 'Description', 'xss_clean|required');
            
            if ($this->form_validation->run() == FALSE) {
                $response['status']  = 'error';
                $response['message'] = validation_errors();
                $this->output->set_output(json_encode($response));
            } else {
                $dataInfo = array();
                $files    = $_FILES;
                $cpt      = count($_FILES['gallery_image']['name']);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['gallery_image']['name']     = $files['gallery_image']['name'][$i];
                    $_FILES['gallery_image']['type']     = $files['gallery_image']['type'][$i];
                    $_FILES['gallery_image']['tmp_name'] = $files['gallery_image']['tmp_name'][$i];
                    $_FILES['gallery_image']['error']    = $files['gallery_image']['error'][$i];
                    $_FILES['gallery_image']['size']     = $files['gallery_image']['size'][$i];
                    $uploadPath                          = 'assets/img/gallery';
                    $config['upload_path']               = $uploadPath;
                    $config['allowed_types']             = 'gif|jpg|png';
                    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('gallery_image')) {
                        $fileData                    = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                        $data1                       = array();
                        $data1                       = array(
							'id_gallery' 	=> $id,
							'img_url' 		=> 'assets/img/gallery/'.$uploadData[$i]['file_name'],
							'upload_on' 	=> $date
                        );
                        $success            = $this->Mod_crud->insertData('tbl_images',$data1);
                    }
				}
				
                if (!empty($id)) {
                    $data       = array();
                    $data                = $this->Mod_crud->updateData('tbl_galleries',array(
                        'id_category' 	=> $category,
                        'id_service' 	=> $service,
                        'type_gallery' 	=> $type,
						'desc_gallery' 	=> $description,
						'updated_on'	=> $date,
						'updated_by'	=> $this->session->userdata('user_login_id')
					), array('id_gallery'=> $id));
					
                    $response['status']  = 'success';
                    $response['message'] = "Successfully Updated";
                    $this->output->set_output(json_encode($response));
                }
            }
        } else {
            redirect(base_url(), 'refresh');
        }
	}
	
	// delete Gallery
	public function deleteGallery(){
		$id = base64_decode($this->input->post('id'));
		$imgvalue = $this->Mod_crud->getData('row','img_url','tbl_images',null,null,null,array('id = "'.$id.'"'));
		$delete = $this->Mod_crud->deleteData('tbl_images',array('id'=>$id));
		if ($delete){
			if (!empty($imgvalue)){
				unlink(FCPATH . $imgvalue->img_url);
				}
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
					);
			echo json_encode($data);
		}else{
			echo '';
		}
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/* Tab Company Profile */
	// Company Profile
	public function profile_company()
	{
		$data = array(
			'titleWeb' 	=> 'Company Profile',
			'titlePage'	=> 'Company Profile Page'
		);
		$data['data_profile'] = $this->Mod_crud->getData('result','*','tbl_company_profiles');
		$this->render('dash_admin','root/company_profile', $data);
	}

	// add Company profile
	public function do_addProfile()
	{
		$about	= $this->input->post('about');
		$vision	= $this->input->post('vision');
		$mission	= $this->input->post('mission');
		$address	= $this->input->post('address');
		$telp_or_email	= $this->input->post('telp_or_email');
		$created_on		= date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('about', 'About', 'trim|required|min_length[10]|xss_clean');
		$this->form_validation->set_rules('vision', 'Vision', 'trim|required|min_length[10]|xss_clean');
		$this->form_validation->set_rules('mission', 'Mision', 'trim|required|min_length[10]|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[10]|xss_clean');
		$this->form_validation->set_rules('telp_or_email', 'Telp Or Email', 'trim|required|min_length[10]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			$success  = $this->Mod_crud->insertData('tbl_company_profiles',array(
					'about' => $about,
					'a_vision'=> $vision,
					'a_mission'=> $mission,
					'address'=> $address,
					'telp_or_email'=> $telp_or_email,
					'created_on'=> $created_on
				)
			);

			$response['status']  = 'success';
			$response['message'] = "Successfully Insert";
			$this->output->set_output(json_encode($response));
			#$this->session->set_flashdata('feedback','Successfully Updated');
		}
	}

	// update company profile
	public function do_updateProfile()
	{
		$id		= base64_decode($this->input->post('id'));
		$about	= $this->input->post('about');
		$vision	= $this->input->post('vision');
		$mission	= $this->input->post('mission');
		$address	= $this->input->post('address');
		$telp_or_email	= $this->input->post('telp_or_email');
		$updated_on		= date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('id', 'ID company', 'trim|required|xss_clean');
		$this->form_validation->set_rules('about', 'About', 'trim|required|min_length[10]|xss_clean');
		$this->form_validation->set_rules('vision', 'Vision', 'trim|required|min_length[10]|xss_clean');
		$this->form_validation->set_rules('mission', 'Mision', 'trim|required|min_length[10]|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[10]|xss_clean');
		$this->form_validation->set_rules('telp_or_email', 'Telp Or Email', 'trim|required|min_length[10]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			$success  = $this->Mod_crud->updateData('tbl_company_profiles',array(
					'about' => $about,
					'a_vision'=> $vision,
					'a_mission'=> $mission,
					'address'=> $address,
					'telp_or_email'=> $telp_or_email,
					'updated_on'=> $updated_on
				), array('id' => $id));

			$response['status']  = 'success';
			$response['message'] = "Successfully Updated";
			$this->output->set_output(json_encode($response));
			#$this->session->set_flashdata('feedback','Successfully Updated');
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/*Tab Expert */
	// expert list

	public function list_expert()
	{
		$data = array(
			'titleWeb' => 'Expert List',
			'titlePage' => 'Expert List Page'
		);
		$data['data'] = $this->Mod_crud->getData('result','*','tbl_experts',null,null,null,null,null,array('field(id_position , "D07") DESC'));
		$data['dept'] = $this->Mod_crud->getData('result','*','tbl_position');
		$this->render('dash_admin','root/expert_list',$data);
	}

	public function add_expert()
	{
		$data = array(
			'titleWeb' => 'Expert Create',
			'titlePage' => 'Expert Create Page'
		);
		$data['dept'] = $this->Mod_crud->getData('result','*','tbl_position');
		$this->render('dash_admin','root/expert_add',$data);
	}

	public function viewExpertDataBYID()
	{
		$id                = base64_decode($this->input->get('id'));
		$data['value'] = $this->Mod_crud->getData('row','*','tbl_experts',null,null,null,array('id_expert = "'.$id.'"'));
		echo json_encode($data);
	}

	public function do_addExpert(){
		$fullname  	= $this->input->post('fullname');
		$expertise 	= $this->input->post('expertise');
		$id_position	= $this->input->post('id_position');
		$date      = date('Y-m-d h:i:sa');

		$idexpert    = 'E' . rand(1000, 2000);

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('fullname', 'Name', 'trim|required|min_length[3]|max_length[60]|xss_clean');
		$this->form_validation->set_rules('id_position', 'Position', 'trim|required|min_length[3]|max_length[60]|xss_clean');
		$this->form_validation->set_rules('expertise', 'Expertise', 'trim|required|min_length[7]|max_length[255]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('full_name','tbl_experts',array('full_name = "'.$fullname.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'Experts already exits';
				$this->output->set_output(json_encode($response));
			} else {

				if ($_FILES['img_url']['name']) {
					$t = explode(".", $_FILES['img_url']['name']);
					$ext = end($t);
					$cfgFile= array(
							'file_name' 	=> $idexpert.'.'.$ext,
							'upload_path' 	=> 'assets/img/expert/',
							'allowed_types' => 'jpg|png|jpeg',
							'max_size'   	=> 2048,
						);
	
					$this->load->library('Upload', $cfgFile);
					$this->upload->initialize($cfgFile);
					if (!$this->upload->do_upload('img_url')) {
						$response['status']  = 'error';
						$response['message'] = $this->upload->display_errors();
						$this->output->set_output(json_encode($response));
					}else{
						$gbr 	= $this->upload->data();
					}
					$img_url = 'assets/img/expert/' . $gbr['file_name'];
				} else {
					$img_url = '';
				}
	
				$success  = $this->Mod_crud->insertData('tbl_experts',array(
						'id_expert' => $idexpert,
						'full_name' => $fullname,
						'id_position'	=> $id_position,
						'expertise' => $expertise,
						'photo'		=> $img_url,
						'created_on'=> $date
					)
				);

				$response['status']  = 'success';
				$response['message'] = "Successfully Insert";
				$this->output->set_output(json_encode($response));
				#$this->session->set_flashdata('feedback','Successfully Updated');
			}
		}
	}

	/* Update Experts*/
    public function do_updateExpert(){
		$id       = $this->input->post('idexpert');
		$fullname  = $this->input->post('fullname');
		$id_position	= $this->input->post('id_position');
		$expertise = $this->input->post('expertise');
		$date 	  = date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('idexpert', 'ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('fullname', 'Name', 'trim|required|min_length[3]|max_length[60]|xss_clean');
		$this->form_validation->set_rules('id_position', 'Position', 'trim|required|min_length[3]|max_length[60]|xss_clean');
		$this->form_validation->set_rules('expertise', 'Expertise', 'trim|required|min_length[7]|max_length[255]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('full_name','tbl_experts',array('full_name = "'.$fullname.'"','id_expert != "'.$id.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'Expert already exits';
				$this->output->set_output(json_encode($response));
			} else {
				$profile       = $this->Mod_crud->getData('row','*','tbl_experts',null,null,null,array('id_expert = "'.$id.'"'));
				
				if ($_FILES['img_url']['name']) {
					$t = explode(".", $_FILES['img_url']['name']);
					$ext = end($t);
					$cfgFile= array(
							'file_name' 	=> $id.'.'.$ext,
							'upload_path' 	=> 'assets/img/expert/',
							'allowed_types' => 'jpg|png|jpeg',
							'max_size'   	=> 2048,
						);

					$this->load->library('Upload', $cfgFile);
					$this->upload->initialize($cfgFile);
					if (!$this->upload->do_upload('img_url')) {
						$response['status']  = 'error';
						$response['message'] = $this->upload->display_errors();
						$this->output->set_output(json_encode($response));
					}else{
						$gbr 	= $this->upload->data();

						if (file_exists($profile->photo)) {
							unlink($profile->photo);
						}
					}

					$img_url = 'assets/img/expert/' . $gbr['file_name'];
				} else {
					$img_url = $profile->photo;
				}

				$success  = $this->Mod_crud->updateData('tbl_experts',array(
						'full_name' => $fullname,
						'id_position'	=> $id_position,
						'expertise' => $expertise,
						'photo'		=> $img_url,
						'created_on'=> $date
				), array('id_expert' => $id,));

				$response['status']  = 'success';
				$response['message'] = "Successfully Updated";
				$this->output->set_output(json_encode($response));
			}
		}
	}

	public function deleteExpert(){
		$id = base64_decode($this->input->post('id'));
		$get_image 	= $this->Mod_crud->getData('row','photo','tbl_experts',null,null,null,array('id_expert = "'.$id.'"'));
		$delete= $this->Mod_crud->deleteData('tbl_experts', array('id_expert' => $id));
		if ($delete){
			if (!empty($get_image)){
			unlink(FCPATH . $get_image->photo);
			}
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}	
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// list order book
	public function book_order()
	{
		$data = array(
			'titleWeb' => 'Book Order',
			'titlePage' => 'Book Order Page'
		);
		$data['data'] = $this->Mod_crud->getData('result','*','tbl_bookings');
		$this->render('dash_admin','root/book_order',$data);
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/* Tab video */
	// List video
	public function list_video()
	{
		$data = array(
			'titleWeb' 	=> 'Video List',
			'titlePage' => 'Video List Page',
			);
		$data['data'] = $this->Mod_crud->getData('result','*','tbl_video',null,null,null,null,array('id_video DESC'));
		$this->render('dash_admin', 'root/video_list', $data);
	}
	// form add video
	public function add_video()
	{
		$data = array(
			'titleWeb' 	=> 'Video Create',
			'titlePage' => 'Video Create Page',
			);
		$this->render('dash_admin', 'root/video_add', $data);
	}

	// add video
	public function do_addVideo()
	{
		$link_video	= $this->input->post('link_video');
		$created_on		= date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('link_video', 'Link Video', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('link_video','tbl_video',array('link_video = "'.$link_video.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'video already exits';
				$this->output->set_output(json_encode($response));
			} else {
				$success  = $this->Mod_crud->insertData('tbl_video',array(
					'link_video' => $link_video,
					'created_on' 	=> $created_on
					)
				);

				$response['status']  = 'success';
				$response['message'] = "Successfully Insert";
				$this->output->set_output(json_encode($response));
				#$this->session->set_flashdata('feedback','Successfully Updated');
			}
		}
	}

	public function viewVideoDataBYID()
	{
		$id                = $this->input->get('id');
		$data['dataresult'] = $this->Mod_crud->getData('row','*','tbl_video',null,null,null,array('id_video = "'.$id.'"'));
		echo json_encode($data);
	}

	// update video
	public function do_updateVideo()
	{
		$id_video		= $this->input->post('id_video');
		$link_video	= $this->input->post('link_video');
		$updated_on		= date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('id_video','ID','required|xss_clean');
		$this->form_validation->set_rules('link_video', 'Link Video', 'trim|required|min_length[3]|max_length[255]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('link_video','tbl_video',array('link_video = "'.$link_video.'"','id_video != "'.$id_video.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'video already exits';
				$this->output->set_output(json_encode($response));
			} else {
				$success  = $this->Mod_crud->updateData('tbl_video',array(
					'link_video' 	=> $link_video,
					'updated_on'		=> $updated_on
				), array('id_video' => $id_video));

				$response['status']  = 'success';
				$response['message'] = "Successfully Updated";
				$this->output->set_output(json_encode($response));
				#$this->session->set_flashdata('feedback','Successfully Updated'); 
			}
		}
	}

	// delete video
	public function deleteVideo(){
		$delete_video= $this->Mod_crud->deleteData('tbl_video', array('id_video' => $this->input->post('id')));
		if ($delete_video){
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}	
	}

	/// social link
	// List social
	public function list_social()
	{
		$data = array(
			'titleWeb' 	=> 'Social Media List',
			'titlePage' => 'Social Media List Page',
			);
		$data['data'] = $this->Mod_crud->getData('result','*','tbl_social_link');
		$this->render('dash_admin', 'root/social_list', $data);
	}
	// form add social
	public function add_social()
	{
		$data = array(
			'titleWeb' 	=> 'Social Media Create',
			'titlePage' => 'Social Media Create Page',
			);
		$this->render('dash_admin', 'root/social_add', $data);
	}

	// add social
	public function do_addSocial()
	{
		$social_name	= $this->input->post('social_name');
		$link 			= $this->input->post('social_link');
		$icon 			= $this->input->post('social_icon');
		$created_on		= date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('social_name', 'Social Media','trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('social_link', 'Link', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('social_icon', 'Icon', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('social_media','tbl_social_link',array('social_media = "'.$social_name.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'Socil media already exits';
				$this->output->set_output(json_encode($response));
			} else {
				$success  = $this->Mod_crud->insertData('tbl_social_link',array(
					'social_media' => $social_name,
					'link'			=> $link,
					'icon'			=> $icon,
					'created_on' 	=> $created_on
					)
				);

				$response['status']  = 'success';
				$response['message'] = "Successfully Insert";
				$this->output->set_output(json_encode($response));
			}
		}
	}

	public function viewSocialDataBYID()
	{
		$id                = $this->input->get('id');
		$data['dataresult'] = $this->Mod_crud->getData('row','*','tbl_social_link',null,null,null,array('id = "'.$id.'"'));
		echo json_encode($data);
	}

	// update social
	public function do_updateSocial()
	{
		$id_social		= $this->input->post('id_social');
		$social_name	= $this->input->post('social_name');
		$link 			= $this->input->post('social_link');
		$icon 			= $this->input->post('social_icon');
		$updated_on		= date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('social_name', 'Social Media','trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('social_link', 'Link', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('social_icon', 'Icon', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('social_media','tbl_social_link',array('social_media = "'.$social_name.'"','id != "'.$id_social.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'Social media already exits';
				$this->output->set_output(json_encode($response));
			} else {
				$success  = $this->Mod_crud->updateData('tbl_social_link',array(
					'social_media' => $social_name,
					'link'			=> $link,
					'icon'			=> $icon,
					'updated_on'		=> $updated_on
				), array('id' => $id_social));

				$response['status']  = 'success';
				$response['message'] = "Successfully Updated";
				$this->output->set_output(json_encode($response));
				#$this->session->set_flashdata('feedback','Successfully Updated'); 
			}
		}
	}

	// delete social
	public function deleteSocial(){
		$delete_social= $this->Mod_crud->deleteData('tbl_social_link', array('id' => $this->input->post('id')));
		if ($delete_social){
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}	
	}

	// Settings

	public function Site_Settings(){
        if ($this->session->userdata('user_login_access') != False && $this->session->userdata('user_role') == 'Admin') {
			$data = array(
				'titleWeb' 	=> 'Configuration',
				);
            $data['data'] = $this->Mod_crud->getData('row','*','tbl_settings');
			$this->render('dash_admin', 'root/settings', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
	}
	
	public function addSettings(){
        if ($this->session->userdata('user_login_access') != False && $this->session->userdata('user_role') == 'Admin') {
            $id          = $this->input->post('id');
            $title       = $this->input->post('title');
            $description = $this->input->post('description');
            $copyright   = $this->input->post('copyright');
            $contact     = $this->input->post('contact');
            $email       = $this->input->post('email');
            $address     = $this->input->post('address');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            // Validating Title Field
            $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[5]|max_length[60]|xss_clean');
            // Validating description Field
            $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[20]|max_length[180]|xss_clean');
            // Validating copyright Field
            $this->form_validation->set_rules('copyright', 'Copyright', 'trim|xss_clean');
            // Validating contact Field
            $this->form_validation->set_rules('contact', 'Contact', 'trim|xss_clean');
            // Validating email Field
            $this->form_validation->set_rules('email', 'Email', 'trim|xss_clean');
            // Validating address Field
            $this->form_validation->set_rules('address', 'Address', 'trim|min_length[5]|max_length[60]|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                $response['status']  = 'error';
                $response['message'] = validation_errors();
                $this->output->set_output(json_encode($response));
            } else {
                
                if ($_FILES['img_url']['name']) {
                    $settings   = $this->Mod_crud->getData('row','*','tbl_settings');
                    $file_name  = $_FILES['img_url']['name'];
                    $fileSize   = $_FILES["img_url"]["size"] / 1024;
                    $fileType   = $_FILES["img_url"]["type"];
                    /*          $new_file_name='';
                    $new_file_name .= $title;*/
                    $checkimage = "assets/img/$settings->sitelogo";
                    
                    $config = array(
                        'file_name' => $file_name,
                        'upload_path' => "assets/img",
                        'allowed_types' => "gif|jpg|png|jpeg|svg",
                        'overwrite' => False,
                        'max_size' => "13038", // Can be set to particular file size , here it is 220KB(220 Kb)
                        'max_height' => "850",
                        'max_width' => "850"
                    );
                    
                    $this->load->library('Upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('img_url')) {
                        $response['status']  = 'success';
                        $response['message'] = $this->upload->display_errors();
                        $this->output->set_output(json_encode($response));
                    } else {
                        if (file_exists($checkimage)) {
                            unlink($checkimage);
                        }
                        $path                = $this->upload->data();
                        $img_url             = $path['file_name'];
                        $data                = $this->Mod_crud->updateData('tbl_settings',array(
                            'sitelogo' => $img_url,
                            'sitetitle' => $title,
                            'description' => $description,
                            'copyright' => $copyright,
                            'contact' => $contact,
                            'system_email' => $email,
                            'address' => $address
						),array('id'=>$id));
						
                        $response['status']  = 'success';
                        $response['message'] = "Successfully Updated";
                        $this->output->set_output(json_encode($response));   
                    }
                } else {
                    $data  = $this->Mod_crud->updateData('tbl_settings', array(
                        'sitetitle' => $title,
                        'description' => $description,
                        'copyright' => $copyright,
                        'contact' => $contact,
                        'system_email' => $email,
                        'address' => $address
                    ), array('id'=>$id));
                    $response['status']  = 'success';
                    $response['message'] = "Successfully Updated";
                    $this->output->set_output(json_encode($response));
                }
            }
        } else {
            redirect(base_url(), 'refresh');
        }
	}
	
	// backup db
	public function Backup_page(){
        if ($this->session->userdata('user_login_access') != False) {
			$data = array(
				'titleWeb' 	=> 'Backup Page',
				);
            $this->render('dash_admin', 'root/backup', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    public function Backup_Database(){
        $database = 'db_mr_design';
        $username = 'root';
        $password = '';
        $hostname = 'localhost';
        $path     = 'assets/dbbackup.sql';
        if ($this->Backup_sql($database, $username, $password, $hostname, $path)) {
            $this->session->set_flashdata('feedback', 'Successfully Downloaded');
            redirect(base_url() . 'root/Backup_page');
        } else {
            $this->session->set_flashdata('feedback', 'Successfully Downloaded');
            redirect(base_url() . 'root/Backup_page');
        }
    }
    public function Backup_sql($database, $username, $password, $hostname, $path){

        //ENTER THE RELEVANT INFO BELOW
        $mysqlDatabaseName = $database;
        $mysqlUserName     = $username;
        $mysqlPassword     = $password;
        $mysqlHostName     = $hostname;
        $mysqlExportPath   = $path;
        
        //DO NOT EDIT BELOW THIS LINE
        //Export the database and output the status to the page
        $command = 'mysqldump --opt -h' . $mysqlHostName . ' -u' . $mysqlUserName . ' -p' . $mysqlPassword . ' ' . $mysqlDatabaseName . ' > ' . $mysqlExportPath;
        exec($command, $output = array(), $worked);
        switch ($worked) {
            case 0:
                echo 'Database <b>' . $mysqlDatabaseName . '</b> successfully exported to <b>' . getcwd() . '/' . $mysqlExportPath . '</b>';
                break;
            case 1:
                echo 'There was a warning during the export of <b>' . $mysqlDatabaseName . '</b> to <b>' . getcwd() . '/' . $mysqlExportPath . '</b>';
                break;
            case 2:
                echo 'There was an error during export. Please check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' . $mysqlDatabaseName . '</b></td></tr><tr><td>MySQL User Name:</td><td><b>' . $mysqlUserName . '</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' . $mysqlHostName . '</b></td></tr></table>';
                break;
                
        }
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/* Tab position */
	// List position
	public function list_position()
	{
		$data = array(
			'titleWeb' 	=> 'Position List',
			'titlePage' => 'Position List Page',
			);
		$data['data'] = $this->Mod_crud->getData('result','*','tbl_position');
		$this->render('dash_admin', 'root/position_list', $data);
	}
	// form add position
	public function add_position()
	{
		$data = array(
			'titleWeb' 	=> 'Position Create',
			'titlePage' => 'Position Create Page',
			);
		$this->render('dash_admin', 'root/position_add', $data);
	}

	// add position
	public function do_addposition()
	{
		$position	= $this->input->post('position');
		$created_on	= date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('position', 'Nama position', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('position','tbl_position',array('position = "'.$position.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'position already exits';
				$this->output->set_output(json_encode($response));
			} else {
				$id = $this->Mod_common->autoNumber('id_position','tbl_position','D',2);
				$success  = $this->Mod_crud->insertData('tbl_position',array(
					'id_position'		=> $id,
					'position' 		=> $position,
					'created_on' 	=> $created_on
					)
				);

				$response['status']  = 'success';
				$response['message'] = "Successfully Insert";
				$this->output->set_output(json_encode($response));
				#$this->session->set_flashdata('feedback','Successfully Updated');
			}
		}
	}

	public function viewpositionDataBYID()
	{
		$id                = $this->input->get('id');
		$data['dataresult'] = $this->Mod_crud->getData('row','*','tbl_position',null,null,null,array('id_position = "'.$id.'"'));
		echo json_encode($data);
	}

	// update position
	public function do_updateposition()
	{
		$id_position	= $this->input->post('id_position');
		$position     = $this->input->post('position');
		$description    = $this->input->post('description');
		$updated_on		= date('Y-m-d h:i:sa');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters();

		$this->form_validation->set_rules('id_position','ID','required|xss_clean');
		$this->form_validation->set_rules('position', 'Nama position', 'trim|required|min_length[3]|max_length[255]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$response['status']  = 'error';
			$response['message'] = validation_errors();
			$this->output->set_output(json_encode($response));
		} else {
			if ($this->Mod_common->checkData('position','tbl_position',array('position = "'.$position.'"','id_position != "'.$id_position.'"'))) {
				$response['status']  = 'error';
				$response['message'] = 'position already exits';
				$this->output->set_output(json_encode($response));
			} else {
				$success  = $this->Mod_crud->updateData('tbl_position',array(
					'position' 	=> $position,
					'updated_on'	=> $updated_on
				), array('id_position' => $id_position));

				$response['status']  = 'success';
				$response['message'] = "Successfully Updated";
				$this->output->set_output(json_encode($response));
				#$this->session->set_flashdata('feedback','Successfully Updated'); 
			}
		}
	}

	// delete position
	public function deleteposition(){
		$delete_position= $this->Mod_crud->deleteData('tbl_position', array('id_position' => $this->input->post('id')));
		if ($delete_position){
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}	
	}

}
