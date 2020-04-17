<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Mod_crud');
		$this->load->model('Mod_common');
	}
	public function index()
	{
		 echo "Disabled Access!";
	}
    public function login() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('user_login_access') == TRUE)
            redirect(base_url('dashboard/index'));

        $data = array(
            'titleWeb' => 'Login Administrator',
            'titlePage' => 'Administrator | Login',
		);
		$this->template->load('login', null, $data);
    }
    
    public function do_login() {
        
        $response = array();
        
        // Recieving post input of email, password from request
        $email    = $this->input->post('email');
        $password = sha1($this->input->post('password'));
        $remember = $this->input->post('remember');
        
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('email', 'User Email', 'trim|xss_clean|required|min_length[7]');
        $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[6]');
        
        // $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'callback_google_captcha');
        // $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required|callback_validate_captcha');
        
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'titleWeb' => 'Login Administrator',
                'titlePage' => 'Administrator | Login',
            );
            $data['message'] = 'Credentials not valid.';
			$this->template->load('login', null, $data);

        } else {
            // Validating login
            $login_status = $this->validate_login($email, $password);
            $response['login_status'] = $login_status;
            if ($login_status == 'success') {
                if ($remember) {
                    setcookie('email', $email, time() + (86400 * 30));
                    setcookie('password', $this->input->post('password'), time() + (86400 * 30));
                    redirect(base_url() . 'auth/login', 'refresh');
                    
                } else {
                    if (isset($_COOKIE['email'])) {
                        setcookie('email', '');
                    }
                    if (isset($_COOKIE['password'])) {
                        setcookie('password', '');
                    }
                    redirect(base_url() . 'auth/login', 'refresh');
                }
                
            } else {
                $data = array(
                    'titleWeb' => 'Login Administrator',
                    'titlePage' => 'Administrator | Login',
                );
                $data['message'] = 'Email or password is invalid';
                $this->template->load('login', null, $data);
            }
        }
    }

    // Validate google reCaptcha
    function validate_captcha() {
        $captchaResponse = $this->input->post('g-recaptcha-response');
        $captchaUrl      = 'https://www.google.com/recaptcha/api/siteverify';
        $secretSitekey   = '6Lep8j8UAAAAAJkV0OGSqNtIS5C_q_MUKrg1eI4Y';
        $captchaResponse = file_get_contents($captchaUrl . "?secret=" . $secretSitekey . "&response=" . $captchaResponse . "&remoteip=" . $_SERVER["REMOTE_ADDR"]);
        $captchaData = json_decode($captchaResponse, true);
        if($captchaData['success'] == TRUE) {
            return TRUE;             
        } else {
            $this->form_validation->set_message('validate_captcha', 'Forgot to check the reCaptcha?');
            return FALSE;
        }
    }
    // Validating login from request
	function validate_login($email = null, $password = null) 
	{
		$query = $this->Mod_crud->getData('row','*','tbl_users',null,null,null,array('email = "'.$email.'"','password = "'.$password.'"','status = "ACTIVE"'));
        if ($query == TRUE) {
            $this->session->set_userdata('user_login_access', TRUE);
            $this->session->set_userdata('user_login_id', $query->id_user);
            $this->session->set_userdata('name', $query->full_name);
            $this->session->set_userdata('email', $query->email);
            $this->session->set_userdata('user_image', $query->image);
            $this->session->set_userdata('user_role', $query->role);
            return 'success';
        }
    }
    /*Logout method*/
    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('feedback', 'logged_out');
        redirect(base_url('auth/login'), 'refresh');
	}
    // Forgot Password
    public function forgotten_page() {
        $data = array(
            'titleWeb' => 'Forgot Password',
            'titlePage' => 'Administrator | Forgotten Page',
		);
		$this->template->load('forgot_password', null, $data);
    }
    public function forgot_password() {
        $email      = $this->input->post('email');
        $checkemail = $this->Mod_common->checkData('email','tbl_users',array('email = "'.$email.'"'));
        if ($checkemail) {
            $randcode     = md5(uniqid());
            $updatedata   = $this->Mod_crud->updateData('tbl_users',array(
                'forgotten_code' => $randcode
            ), array('email' => $email));

            $email        = $this->input->post('email');
            $this->send_mail($email, $randcode);
            $this->session->set_flashdata('feedback', 'Kindly check your email' . ' ' . $email . 'To reset your password');
            redirect('auth/forgotten_page');
            
        } else {
            $this->session->set_flashdata('feedback', 'Please enter a valid email address!');
            redirect('auth/forgotten_page');
        }
    }
    public function send_mail($email, $randcode) {
        $config     = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'myemail@gmail.com',//ganti ke email kamu
            'smtp_pass' => 'password123',//ganti ke password email kamu
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );

        $message .= "Your or someone request to reset your password" . "<br />";
        $message .= "Click  Here : " . base_url() . "auth/Reset_View?p=" . $randcode . "<br />";
        
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user']);
        $this->email->to($email);
        $this->email->subject('Forgot Password');
        $this->email->message($message);
        
        // var_dump($this->email->send());
        // Send mail 
        if ($this->email->send()) {
            $this->session->set_flashdata('feedback', 'Kindly check your email To reset your password');
        } else {
            $this->session->set_flashdata("feedback", "Error in sending Email.");
        }
    }

    // Reset Password
    public function Reset_View() {
        $this->load->helper('form');
        $reset_key = $this->input->get('p');
        if ($this->Mod_common->checkData('forgotten_code','tbl_users',array('forgotten_code = "'.$reset_key.'"'))) {
            $data = array(
                'titleWeb' => 'Reset Password',
                'titlePage' => 'Administrator | Reset Page',
                'key' => $reset_key
            );
            $this->template->load('reset_password', null, $data);
        } else {
            $this->session->set_flashdata('feedback', 'Please enter a valid email address!');
            redirect('auth/forgotten_page');
        }
    }

    public function resetPasswordValidation() {
        $password = $this->input->post('password');
        $confirm  = $this->input->post('confirm');
        $key      = $this->input->post('reset_key');
        $userinfo = $this->Mod_crud->getData('row','password','tbl_users',null,null,null,array('forgotten_code = "'.$key.'"'));
        
        if ($password == $confirm) {
            if ($userinfo->password != sha1($password)) {
                $data   = array();
                $data   = array(
                    
                );
                $update_password = $this->Mod_crud->updateData('tbl_users',array(
                    'forgotten_code' => 0,
                    'password' => sha1($password),
                    'seen_password' => $password
                ), array('forgotten_code' => $key));

                if ($update_password) {
                    $data = array(
                        'titleWeb' => 'Reset Password',
                        'titlePage' => 'Administrator | Reset Page',
                    );
                    $data['message'] = 'Successfully Updated your password!!';
                    $this->template->load('login', null, $data);
                }
            } else {
                $this->session->set_flashdata('feedback', 'You enter your old password.Please enter new password');
                redirect('auth/Reset_View?p=' . $key);
            }
        } else {
            $this->session->set_flashdata('feedback', 'Password does not match');
            redirect('auth/Reset_View?p=' . $key);
        }
    }


    /* signup*/
    public function viewSignUp() {
        $data = array(
            'titleWeb' => 'Sign Up',
            'titlePage' => 'Administrator | Sign Up Page',
        );
        $this->template->load('signup', null, $data);
    }
    
}