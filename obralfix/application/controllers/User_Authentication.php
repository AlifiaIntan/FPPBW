<?php


Class User_Authentication extends CI_Controller {

public function __construct() {
parent::__construct();

// Load form helper library
$this->load->helper('form');

// Load form validation library
$this->load->library('form_validation');

// Load session library
$this->load->library('session');

// Load database
$this->load->model('users');
$this->load->model('users_public');
}

// Show login page
public function index() {

  $this->load->view('header');
		$this->load->view('login_form');
		$this->load->view('footer');
}

// Show registration page
public function user_registration_show() {
$this->load->view('login_form');
}

// Validate and store registration data in database
public function new_user_registration() {

// Check validation for user input in SignUp form
$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
$this->form_validation->set_rules('email_value', 'Email', 'trim|required|xss_clean');
$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
if ($this->form_validation->run() == FALSE) {
$this->load->view('registration_form');
} else {
$data = array(
'user_name' => $this->input->post('username'),
'user_email' => $this->input->post('email_value'),
'user_password' => $this->input->post('password')
);
$result = $this->users->registration_insert($data);
if ($result == TRUE) {
$data['message_display'] = 'Registration Successfully !';
$this->load->view('login_form', $data);
} else {
$data['message_display'] = 'Username already exist!';
$this->load->view('registration_form', $data);
}
}
}

public function do_register()
{
  $name = $this->input->post('name');
  $uname = $this->input->post('uname');
  $phone = $this->input->post('phone');
  $pass = $this->encryption->encrypt($this->input->post('pass'));
  $mail = $this->input->post('email');
  $address = $this->input->post('address');

  $data = array(
      'Nama' => $name,
      'Username' => $uname,
      'Phone' => $phone,
      'Password' => $pass,
      'Email' => $mail,
      'Address' => $address,
  );

  $this->db->insert('users_public', $data);
  redirect('Home/Register');

}

// Check for user login process
public function user_login_process() {

$this->form_validation->set_rules('username', 'Username', 'trim|required');
$this->form_validation->set_rules('password', 'Password', 'trim|required');

if ($this->form_validation->run() == FALSE) {
if(isset($this->session->userdata['logged_in'])){
  $this->load->view('header');
  $this->load->view('user_page');
  $this->load->view('footer');
}else{
  $this->load->view('header');
	$this->load->view('login_form');
	$this->load->view('footer');
}
} else {
$data = array(
'username' => $this->input->post('username'),
'password' => $this->input->post('password')
);


$result = $this->users->login($data);
  if ($result == TRUE) {

  $username = $this->input->post('username');
  $result = $this->users->read_user_information($username);

    if ($result != false) {
      $session_data = array(
      'username' => $result->Username,
      'email' => $result->Email,
      'role' => 'user'
      );
      // Add user data in session
      $this->session->set_userdata('logged_in', $session_data);
      $this->load->view('header');
      $this->load->view('user_page');
      $this->load->view('footer');

    } else {
      $data = array(
      'error_message' => 'Invalid Username or Password'
      );
      $this->load->view('header');
        $this->load->view('login_form');
        $this->load->view('footer');
    }
  }
}
}

// Check for admin login process
public function admin_login_process() {

$this->form_validation->set_rules('username', 'Username', 'trim|required');
$this->form_validation->set_rules('password', 'Password', 'trim|required');

if ($this->form_validation->run() == FALSE) {
if(isset($this->session->userdata['logged_in'])){
  $this->load->view('header');
  $this->load->view('admin_page');
  $this->load->view('footer');
}else{
  $this->load->view('header');
	$this->load->view('admin_login_form');
	$this->load->view('footer');
}
} else {
$data = array(
'username' => $this->input->post('username'),
'password' => $this->input->post('password')
);
$result = $this->users_public->login($data);
  if ($result == TRUE) {

  $username = $this->input->post('username');
  $result = $this->users_public->read_user_information($username);

    if ($result != false) {
      $session_data = array(
      'username' => $result->Username,
      'email' => $result->Email,
      'role' =>'admin'
      );
      // Add user data in session
      $this->session->set_userdata('logged_in', $session_data);
      $this->load->view('header');
      $this->load->view('admin_page');
      $this->load->view('footer');

    } else {
      $data = array(
      'error_message' => 'Invalid Username or Password'
      );
      $this->load->view('header');
        $this->load->view('admin_login_form');
        $this->load->view('footer');
    }
  }
}
}

// Logout from
public function logout() {

// Removing session data
$sess_array = array(
'username' => ''
);
$this->session->unset_userdata('logged_in', $sess_array);
$data['message_display'] = 'Successfully Logout';
$this->load->view('header');
  $this->load->view('login_form');
  $this->load->view('footer');
}

}



?>
