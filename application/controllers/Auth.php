<?php

//session_start();


class Auth extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    // security helper
    $this->load->helper('security');
    // Load form helper library
    $this->load->helper('form');
    //load url helper
    $this->load->helper('url');
    // Load form validation library
    $this->load->library('form_validation');
    // Load session library
    $this->load->library('session');
    // Load database
    $this->load->model('users_model');
  }
  // Show registration page
  public function register($data = array()) {

    $data['title'] = ucfirst('Register');

    $this->load->view('templates/header', $data);
    $this->load->view('register');
    $this->load->view('templates/footer');
  }

  // Show login page
  public function login($data = array()) {
    $data['title'] = ucfirst('Login');

    $this->load->view('templates/header', $data);
    $this->load->view('login');
    $this->load->view('templates/footer');
  }

  // Validate and store registration data in database
  public function new_user_registration() {

    // Check validation for user input in SignUp form
    $this->form_validation->set_rules('student_id', 'Student ID', 'trim|required|xss_clean');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[12]|required|xss_clean');
    $data = array(
      'student_id' => $this->input->post('student_id'),
      'email' => $this->input->post('email'),
      'password' => $this->input->post('password')
    );
    if ($this->form_validation->run() == FALSE) {
        $this->register();
    } else {
      $result = $this->users_model->registration_insert($data);
      if ($result == TRUE) {
        $data['message_display'] = 'Registration Successfully !';
        $this->login($data);
      } else {
        $data['message_display'] = 'Email already exist!';
        $this->register($data);
      }
    }
  }

  // Check for user login
  public function handle_user_login() {

    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

    if ($this->form_validation->run() == FALSE) {
      if(isset($this->session->userdata['logged_in'])){
        redirect('secure/dashboard', 'refresh');
      }else{
        $this->login();
      }
    } else {
      $data = array(
        'email' => $this->input->post('email'),
        'password' => $this->input->post('password')
      );
      $result = $this->users_model->login($data);
      if ($result == TRUE) {
        $email = $this->input->post('email');
        $result = $this->users_model->read_user_information($email);
        if ($result != false) {
          $session_data = array(
            'email' => $result[0]->email,
            'student_id' => $result[0]->student_id,
          );
          // Add user data in session
          $this->session->set_userdata('logged_in', $session_data);
          if (isset($this->session->userdata['logged_in'])) {
            redirect('secure/dashboard', 'refresh');
          }
        }
      } else {
        $data = array(
          'error_message' => 'Invalid Username or Password'
        );
        $this->login($data);
      }
    }
  }

  public function logout() {
    // Removing session data
    $sess_array = array(
      'email' => '',
      'student_id' => ''
    );
    $this->session->unset_userdata('logged_in', $sess_array);
    $data['message_display'] = 'Successfully Logout';
    $this->login($data);
  }
}

?>
