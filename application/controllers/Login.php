<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('crud_model');
    }
    public function index() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('user_login_access') == 1)
            redirect(base_url() . 'crud');
        $data                  = array();
        $data['settingsvalue'] = $this->crud_model->GetSettingsValue();
        $this->load->view('backend/login', $data);
    }
    
    public function signIn() {
        
        $response = array();
        
        //Recieving post input of email, password from request
        $email    = $this->input->post('email');
        $password = sha1($this->input->post('password'));
        $remember = $this->input->post('remember');
        
        #Login input validation\
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('email', 'User Email', 'trim|xss_clean|required|min_length[7]');
        $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[6]');
        $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'callback_google_captcha');

        $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required|callback_validate_captcha');
        
        if ($this->form_validation->run() == FALSE) {
            $data['message'] = 'Credentials not valid.';
            $this->load->view('backend/login', $data);

        } else {
            //Validating login
            $login_status = $this->validate_login($email, $password);
            $response['login_status'] = $login_status;
            if ($login_status == 'success') {
                if ($remember) {
                    setcookie('email', $email, time() + (86400 * 30));
                    setcookie('password', $this->input->post('password'), time() + (86400 * 30));
                    redirect(base_url() . 'login', 'refresh');
                    
                } else {
                    if (isset($_COOKIE['email'])) {
                        setcookie('email', '');
                    }
                    if (isset($_COOKIE['password'])) {
                        setcookie('password', '');
                    }
                    redirect(base_url() . 'login', 'refresh');
                }
                
            } else {
                $data['message'] = 'Email or password is invalid.';
                $this->load->view('backend/login', $data);
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
    //Validating login from request
    function validate_login($email = '', $password = '') {
        $credential = array(
            'email' => $email,
            'password' => $password,
            'status' => 'ACTIVE'
        );
        // Checking login credential for admin
        $query = $this->login_model->getUser($credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('user_login_access', '1');
            $this->session->set_userdata('user_login_id', $row->user_id);
            $this->session->set_userdata('name', $row->full_name);
            $this->session->set_userdata('email', $row->email);
            $this->session->set_userdata('user_image', $row->image);
            $this->session->set_userdata('user_type', $row->user_type);
            return 'success';
        }
    }
    /*Logout method*/
    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('feedback', 'logged_out');
        redirect(base_url(), 'refresh');
    }
    /*User signup*/
    public function viewSignUp() {
        $data                  = array();
        $data['settingsvalue'] = $this->crud_model->GetSettingsValue();
        $this->load->view('backend/signup', $data);
    }
    /*Validating user signup form request*/
    public function user_SignUP() {
        $userid    = 'U' . rand(0, 499);
        /* Generate Random user id*/
        $name      = $this->input->post('name');
        $email     = $this->input->post('email');
        $password  = $this->input->post('password');
        $confirm   = $this->input->post('confirm_password');
        $ipaddress = $this->input->ip_address();
        $date      = date("m/d/Y");
        $randcode  = rand();
        if ($password == $confirm) {
            /*validating name field*/
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
            /*Validating email field*/
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[7]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
            /*validating pasword field*/
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $data['message'] = validation_errors();
                $this->load->view('backend/signup', $data);
            } else {
                if ($this->login_model->Does_email_exists($email)) {
                    $this->session->set_flashdata('feedback', 'Email already exits');
                    redirect('login/viewSignUp');
                } else {
                    $data     = array();
                    $data     = array(
                        'user_id' => $userid,
                        'full_name' => $name,
                        'email' => $email,
                        'password' => sha1($password),
                        'seen_password' => $password,
                        'ip_address' => $ipaddress,
                        'status' => 'INACTIVE',
                        'confirm_code' => $randcode,
                        'user_type' => 'User',
                        'created_on' => $date
                    );
                    $success  = $this->login_model->insertUser($data);
                    $inserted = $this->db->insert_id();
                    if ($inserted) {
                        $this->confirm_mail_send($email, $randcode);
                        $this->session->set_flashdata('feedback', 'Kindly check your email To confirm your account');
                        $this->load->view('backend/login');
                    } else {
                        $this->session->set_flashdata('feedback', 'Something went wrong. Please try again');
                        $this->load->view('backend/signup');
                    }
                }
            }
        } else {
            $data['message'] = "Passwords did not match!!";
            $this->load->view('backend/signup', $data);
        }
    }
    public function confirm_mail_send($email, $randcode) {
        $config     = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'midaspurnama@gmail.com',
            'smtp_pass' => 'midaspurnama123456789',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );
        $from_email = "midaspurnama@gmail.com";
        $to_email   = $email;
        
        $message = "Confirm Your Account";
        $message .= "Click Here : " . base_url() . "login/verification_confirm?C=" . $randcode . '</br>';

        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user']);
        $this->email->to($email);
        $this->email->subject('Confirm Your Account');
        $this->email->message($message);
        
        //Send mail 
        if ($this->email->send()) {
            $this->session->set_flashdata('feedback', 'Kindly check your email To reset your password');
        } else {
            $this->session->set_flashdata("feedback", "Error in sending Email.");
        }
    }
    public function verification_confirm() {
        $verifycode = $this->input->get('C');
        $userinfo   = $this->login_model->GetuserInfoBycode($verifycode);
        if ($userinfo) {
            $data = array();
            $data = array(
                'status' => 'ACTIVE',
                'confirm_code' => 0
            );
            $this->login_model->UpdateStatus($verifycode, $data);
            if ($this->db->affected_rows()) {
                $this->session->set_flashdata('feedback', 'Your Account has been confirmed!! now login');
                $this->load->view('backend/login');
            }
        } else {
            $this->session->set_flashdata('feedback', 'Sorry your account has not been varified');
            $this->load->view('backend/login');
        }
    }
    public function forgotten_page() {
        $data                  = array();
        $data['settingsvalue'] = $this->crud_model->GetSettingsValue();
        $this->load->view('backend/forgot_password', $data);
    }
    public function forgot_password() {
        $email      = $this->input->post('email');
        $checkemail = $this->login_model->Does_email_exists($email);
        if ($checkemail) {
            $randcode     = md5(uniqid());
            $data         = array();
            $data         = array(
                'forgotten_code' => $randcode
            );
            $updatedata   = $this->login_model->UpdateKey($data, $email);
            $updateaffect = $this->db->affected_rows();
            $email        = $this->input->post('email');
            $this->send_mail($email, $randcode);
            $this->session->set_flashdata('feedback', 'Kindly check your email' . ' ' . $email . 'To reset your password');
            redirect('login/forgotten_page');
            
        } else {
            $this->session->set_flashdata('feedback', 'Please enter a valid email address!');
            redirect('login/forgotten_page');
        }
    }
    public function send_mail($email, $randcode) {
        $config     = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'midaspurnama@gmail.com',
            'smtp_pass' => 'midaspurnama123456789',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );

        $message .= "Your or someone request to reset your password" . "<br />";
        $message .= "Click  Here : " . base_url() . "login/Reset_View?p=" . $randcode . "<br />";
        
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user']);
        $this->email->to($email);
        $this->email->subject('Forgot Password');
        $this->email->message($message);
        
        var_dump($this->email->send());
        //Send mail 
        if ($this->email->send()) {
            $this->session->set_flashdata('feedback', 'Kindly check your email To reset your password');
        } else {
            $this->session->set_flashdata("feedback", "Error in sending Email.");
        }
    }
    public function Reset_View() {
        $this->load->helper('form');
        $reset_key = $this->input->get('p');
        if ($this->login_model->Does_Key_exists($reset_key)) {
            $data['key'] = $reset_key;
            $this->load->view('backend/reset_page', $data);
        } else {
            $this->session->set_flashdata('feedback', 'Please enter a valid email address!');
            redirect('login/forgotten_page');
        }
    }
    public function resetPasswordValidation() {
        $password = $this->input->post('password');
        $confirm  = $this->input->post('confirm');
        $key      = $this->input->post('reset_key');
        $userinfo = $this->login_model->GetUserInfo($key);
        
        if ($password == $confirm) {
            if ($userinfo->password != sha1($password)) {
                $data   = array();
                $data   = array(
                    'forgotten_code' => 0,
                    'password' => sha1($password),
                    'seen_password' => $password
                );
                $update = $this->login_model->UpdatePassword($key, $data);
                if ($this->db->affected_rows()) {
                    $data['message'] = 'Successfully Updated your password!!';
                    $this->load->view('backend/login', $data);
                }
            } else {
                $this->session->set_flashdata('feedback', 'You enter your old password.Please enter new password');
                redirect('login/Reset_View?p=' . $key);
            }
        } else {
            $this->session->set_flashdata('feedback', 'Password does not match');
            redirect('login/Reset_View?p=' . $key);
        }
    }
    
}