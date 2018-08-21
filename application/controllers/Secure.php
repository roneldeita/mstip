<?php

//session_start();

class Secure extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //load url helper
    $this->load->helper('url_helper');
    // Load session library
    $this->load->library('session');
    // Load database
    $this->load->model('users_model');

  }
  // Show registration page
  public function dashboard() {

    $data['title'] = ucfirst('Dashboard');

    $this->load->view('templates/header', $data);
    $this->load->view('protected/dashboard');
    $this->load->view('templates/footer');
  }
}

?>
