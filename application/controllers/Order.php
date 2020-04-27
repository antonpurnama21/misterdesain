<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."controllers/PublicDash.php");

class Order extends PublicDash {
    
    function __construct() {
        parent::__construct();
	}
	public function index()
	{
		 echo "Disabled Access!";
    }
    
    public function do_order()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');
		$id_service = $this->input->post('service');
		$note = $this->input->post('note');
        $date = date('Y-m-d h:i:sa');
        
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<i>* ', '</i><br>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[60]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|valid_email|xss_clean');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[3]|max_length[13]|numeric|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('service', 'Service', 'trim|required|xss_clean');
		$this->form_validation->set_rules('note', 'Note', 'trim|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('feedback', validation_errors());
			redirect('copublic/order');
			//echo validation_errors();
		} else {
			
			$order_id    = date('ymd') . rand(500, 1000);	
			if ($_FILES['layout_file']['name']) {
				$t = explode(".", $_FILES['layout_file']['name']);
				$ext = end($t);
				$cfgFile= array(
						'file_name' 	=> $order_id.'.'.$ext,
						'upload_path' 	=> 'assets/img/order/',
						'allowed_types' => 'jpg|png|jpeg',
						'max_size'   	=> 2048,
						// 'max_height' 	=> "600",
						// 'max_width' 	=> "600"
					);

				$this->load->library('Upload', $cfgFile);
				$this->upload->initialize($cfgFile);
				if (!$this->upload->do_upload('layout_file')) {
					echo json_encode(array('code' => 404, 'message' => $this->upload->display_errors()));
				}else{
					$gbr 	= $this->upload->data();
				}
				$img_url = 'assets/img/order/' . $gbr['file_name'];
			} else {
				$img_url = '';
			}

			$success  = $this->Mod_crud->insertData('tbl_bookings',array(
				'id_booking'		=> $order_id,
				'customer_name' 	=> $name,
				'customer_address'	=> $address,
				'phone_num' 		=> $phone,
				'customer_email' 	=> $email,
				'id_service'		=> $id_service,
				'note'				=> $note,
				'layout_file_path'	=> $img_url,
				'status_booking' 	=> 'PENDING',
				'created_at'	 	=> $date
				)
			);

			$odr_id 	= $order_id; 
			redirect('order/detail_order/'.$odr_id);
		}
	}

	public function detail_order($id_order = null)
	{
        if ($id_order == null)
        redirect(base_url('copublic/order'));

		$id = $id_order;
		$cek_id = $this->Mod_common->checkData('id_booking','tbl_bookings',array('id_booking = "'.$id.'"'));
		if ($cek_id == false) {
			die('id order tidak terdaftar!!');
		}
		
		$data = array(
				'_JS' => generate_js(array(
				)
			),
			'titleWeb' 		=> 'Detail Order',
			'data'		    => $this->Mod_crud->getData('row','*','tbl_bookings',null,null,null,array('id_booking = "'.$id.'"')),			
		);
		$this->render('dash_public', 'public/order_detail', $data);
	}

	public function do_check()
	{
		$id = $this->input->post('order_id');
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<i>* ', '</i><br>');
		$this->form_validation->set_rules('order_id', 'order id', 'trim|required|min_length[2]|max_length[10]|numeric|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('feedcheck', validation_errors());
			redirect('copublic/order');
		} else {
			$cek_id = $this->Mod_common->checkData('id_booking','tbl_bookings',array('id_booking = "'.$id.'"'));
			if ($cek_id == false) {
				$message = '<p>* order id yang anda masukan tidak ada !</p>';
				$this->session->set_flashdata('feedcheck', $message);
				redirect('copublic/order');
			}
			
			$data = array(
					'_JS' => generate_js(array(
					)
				),
				'titleWeb' 		=> 'Detail Order',
				'data'		    => $this->Mod_crud->getData('row','*','tbl_bookings',null,null,null,array('id_booking = "'.$id.'"')),			
			);
			$this->render('dash_public', 'public/order_detail', $data);
		}
	}

	function download($id = null)
	{
		if ($id == null)
		redirect(base_url('root/detail_order'));

		$getFile = $this->Mod_crud->getData('row','*','tbl_bookings',null,null,null,array('id_booking = "'.$id.'"'));
		$file = $getFile->layout_file_path;
		force_download($file,NULL);
	}
    
}