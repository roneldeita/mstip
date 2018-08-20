<?php

//session_start();

Class Auth extends CI_Controller {

  public function __construct() 
  {
    parent::__construct();
    // security helper
    $this->load->helper('security');
    // Load form helper library
    $this->load->helper('form');
    //load url helper
    $this->load->helper('url_helper');
    // Load form validation library
    $this->load->library('form_validation');
    // Load session library
    $this->load->library('session');
    // Load database
    $this->load->model('users_model');
  }
  // Show registration page
  public function register() {

    $data['title'] = ucfirst('Register');

    $this->load->view('templates/header', $data);
    $this->load->view('register');
    $this->load->view('templates/footer');
  }

  // Show login page
  public function login() {
    //$data['title'] = ucfirst('Login');

    //$this->load->view('templates/header', $data)
    $this->load->view('login');
    //$this->load->view('templates/footer');
  }
  // Validate and store registration data in database
  public function new_user_registration() {

    // Check validation for user input in SignUp form
    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[12]|required|xss_clean');
    $data = array(
      'username' => $this->input->post('username'),
      'email' => $this->input->post('email'),
      'password' => $this->input->post('password')
    );
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('register', $data);
    } else {
      $result = $this->users_model->registration_insert($data);
      if ($result == TRUE) {
        $data['message_display'] = 'Registration Successfully !';
        $this->load->view('login', $data);
      } else {
        $data['message_display'] = 'Email already exist!';
        $this->load->view('register', $data);
      }
    }
  }

  // Check for user login process
  public function user_login_process() {

    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    
    if ($this->form_validation->run() == FALSE) {
      if(isset($this->session->userdata['logged_in'])){
        $this->load->view('admin_page');
      }else{
        $this->load->view('login_form');
      }
    } else {
      $data = array(
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password')
      );
      $result = $this->login_database->login($data);
      if ($result == TRUE) {
        $username = $this->input->post('username');
        $result = $this->login_database->read_user_information($username);
        if ($result != false) {
          $session_data = array(
            'username' => $result[0]->user_name,
            'email' => $result[0]->user_email,
          );
          // Add user data in session
          $this->session->set_userdata('logged_in', $session_data);
          $this->load->view('admin_page');
        }
      } else {
        $data = array(
          'error_message' => 'Invalid Username or Password'
        );
        $this->load->view('login_form', $data);
      }
    }
  }

  // Logout from admin page
  public function logout() {
    // Removing session data
    $sess_array = array(
      'username' => ''
    );
    $this->session->unset_userdata('logged_in', $sess_array);
    $data['message_display'] = 'Successfully Logout';
    $this->load->view('login_form', $data);
  }
}

?>